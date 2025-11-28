<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

use JulienBoudry\Enigma\EntryWheel\AbstractEntryWheel;
use JulienBoudry\Enigma\Exception\EnigmaConfigurationException;
use JulienBoudry\Enigma\Reflector\AbstractReflector;
use Random\Engine;

/**
 * Represents an Enigma cipher machine.
 *
 * This class emulates the historical Enigma machine used during World War II.
 * Multiple models can be emulated:
 * - Military models (Wehrmacht/Luftwaffe, Kriegsmarine M3/M4) with plugboard
 * - Commercial models (Enigma K, Swiss-K, Railway) without plugboard
 *
 * Depending on the model, 3 or 4 rotors are mounted. Only the first three rotors can be triggered
 * by the advance mechanism. A letter is encoded by sending its corresponding signal through:
 * [plugboard →] entry wheel → rotors 1..3(4) → reflector → rotors 3(4)..1 → entry wheel [→ plugboard].
 *
 * After each encoded letter, the advance mechanism changes the internal setup by rotating the rotors.
 *
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 */
class Enigma
{
    /**
     * The plugboard that connects input and output to the entry wheel.
     *
     * Always present but empty by default on commercial models.
     * In strictMode, commercial models cannot use the plugboard.
     */
    public readonly EnigmaPlugboard $plugboard;

    /**
     * The entry wheel (Eintrittswalze) that maps keyboard to rotor contacts.
     * Uses QWERTZ order for commercial models, alphabetical for military.
     */
    public readonly AbstractEntryWheel $entryWheel;

    /**
     * The rotors used by the Enigma.
     */
    public private(set) RotorConfiguration $rotors;

    /**
     * The reflector used by the Enigma.
     */
    public private(set) AbstractReflector $reflector;

    /**
     * The model of the Enigma machine.
     */
    public readonly EnigmaModel $model;

    /**
     * Whether to enforce compatibility checks.
     *
     * When true (default), validates that rotors and reflectors are compatible
     * with the selected model. When false, bypasses all compatibility checks
     * and allows any configuration (including plugboard on commercial models).
     */
    public bool $strictMode;

    /**
     * Constructor sets up the plugboard and creates the rotors and reflectros available for the given model.
     * The initital rotors and reflectros are mounted.
     *
     * @param EnigmaModel $model ID for the model to emulate
     * @param RotorConfiguration $rotors The rotor configuration
     * @param ReflectorType $reflector ID for the reflector for the initial setup
     * @param bool $strictMode Whether to enforce compatibility checks (default: true)
     */
    public function __construct(EnigmaModel $model, RotorConfiguration $rotors, ReflectorType $reflector, bool $strictMode = true)
    {
        $this->model = $model;
        $this->strictMode = $strictMode;
        $this->rotors = $rotors;

        // Create entry wheel based on model type
        $this->entryWheel = $model->getEntryWheelType()->createEntryWheel();

        // Plugboard always exists but is empty on commercial models
        $this->plugboard = new EnigmaPlugboard;

        if ($this->strictMode) {
            $this->rotors->validateForModel($model);
        }

        $this->mountReflector($reflector);
    }

    /**
     * Create an Enigma machine with a random configuration.
     *
     * Generates cryptographically secure random settings including:
     * - Random rotor selection and order (compatible with model)
     * - Random ring settings (Ringstellung)
     * - Random initial positions (Grundstellung)
     * - Random plugboard connections (10 pairs)
     * - Random reflector (compatible with model)
     *
     * @param EnigmaModel $model The Enigma model to create
     * @param Engine|null $randomEngine Random engine for testing (null = secure random)
     *
     * @return self A fully configured Enigma machine
     */
    public static function createRandom(EnigmaModel $model, ?Engine $randomEngine = null): self
    {
        $configurator = new EnigmaRandomConfigurator($randomEngine);
        $config = $configurator->generate($model);

        return $config->createEnigma();
    }

    /**
     * Create an Enigma machine with a random configuration and return both.
     *
     * Same as createRandom() but also returns the configuration object,
     * which is useful for logging, debugging, or recreating the same setup.
     *
     * @param EnigmaModel $model The Enigma model to create
     * @param Engine|null $randomEngine Random engine for testing (null = secure random)
     *
     * @return array{Enigma, EnigmaConfiguration} The Enigma and its configuration
     */
    public static function createRandomWithConfiguration(EnigmaModel $model, ?Engine $randomEngine = null): array
    {
        $configurator = new EnigmaRandomConfigurator($randomEngine);
        $config = $configurator->generate($model);

        return [$config->createEnigma(), $config];
    }

    /**
     * Get the current configuration of this Enigma machine.
     *
     * Extracts the complete state including rotor types, ring settings,
     * current positions, reflector, and plugboard configuration.
     *
     * @return EnigmaConfiguration The current configuration
     */
    public function getConfiguration(): EnigmaConfiguration
    {
        return EnigmaConfiguration::fromEnigma($this);
    }

    /**
     * Advance the rotors.
     *
     * P1 (rightmost) advances every keypress.
     * P2 (middle) advances when P1's notch is open, or when P3 advances (double-stepping).
     * P3 (leftmost) advances when P2's notch is open.
     *
     * @return void
     */
    private function advance(): void
    {
        // Double-stepping: when P2's notch is open, both P2 and P3 advance
        if ($this->rotors->getP2()->isNotchOpen()) {
            $this->rotors->getP3()->advance();
            $this->rotors->getP2()->advance();
        }
        // Normal stepping: when P1's notch is open, P2 advances
        if ($this->rotors->getP1()->isNotchOpen()) {
            $this->rotors->getP2()->advance();
        }
        // P1 always advances
        $this->rotors->getP1()->advance();
    }

    /**
     * Encode a single letter.
     * The letter passes the plugboard (if available), entry wheel, rotors, reflector,
     * rotors in the opposite direction, entry wheel again, and plugboard (if available).
     * Every encoding triggers the advance mechanism.
     *
     * @see Enigma::advance()
     *
     * @param Letter $letter letter to encode
     *
     * @return Letter encoded letter
     */
    public function encodeLetter(Letter $letter): Letter
    {
        $this->advance();

        // Pass through plugboard (military models only - no effect if empty)
        $value = $this->plugboard->processLetter($letter);

        // Pass through entry wheel (keyboard → rotor contacts)
        $value = $this->entryWheel->processInward($value);

        // Pass through rotors (right to left)
        $rotorArray = $this->rotors->toArray();
        foreach ($rotorArray as $rotor) {
            $value = $rotor->processLetter1stPass($value);
        }

        // Pass through reflector
        $value = $this->reflector->processLetter($value);

        // Pass through rotors in reverse (left to right)
        foreach (array_reverse($rotorArray) as $rotor) {
            $value = $rotor->processLetter2ndPass($value);
        }

        // Pass through entry wheel (rotor contacts → keyboard)
        $value = $this->entryWheel->processOutward($value);

        // Pass through plugboard (military models only - no effect if empty)
        return $this->plugboard->processLetter($value);
    }

    /**
     * Mount a reflector into the enigma.
     * The previously used reflector will be replaced.
     *
     * @param ReflectorType|AbstractReflector $reflector The reflector type or instance to mount
     *
     * @throws \InvalidArgumentException If the reflector is not compatible with this model (when strictMode is enabled)
     */
    public function mountReflector(ReflectorType|AbstractReflector $reflector): void
    {
        if ($reflector instanceof ReflectorType) {
            if ($this->strictMode && !$this->model->isReflectorCompatible($reflector)) {
                throw new EnigmaConfigurationException(
                    "Reflector {$reflector->name} is not compatible with model {$this->model->name}"
                );
            }
            $this->reflector = $reflector->createReflector();
        } else {
            // For custom reflectors (like configured ReflectorDora), accept directly
            $this->reflector = $reflector;
        }
    }

    /**
     * Turn a rotor to a new position.
     *
     * @param RotorPosition $position ID of the rotor to turn
     * @param Letter $letter letter to turn to
     */
    public function setPosition(RotorPosition $position, Letter $letter): void
    {
        $this->rotors->get($position)->setPosition($letter);
    }

    /**
     * Get the current position of a rotor.
     *
     * @param RotorPosition $position ID of the rotor
     *
     * @return Letter current position
     */
    public function getPosition(RotorPosition $position): Letter
    {
        return $this->rotors->get($position)->getPosition();
    }

    /**
     * Connect 2 letters on the plugboard.
     *
     * Only available on military models (Wehrmacht, Kriegsmarine).
     * Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.
     *
     * @param Letter $letter1 letter 1 to connect
     * @param Letter $letter2 letter 2 to connect
     *
     * @throws EnigmaConfigurationException If this model does not have a plugboard
     */
    public function plugLetters(Letter $letter1, Letter $letter2): void
    {
        if ($this->strictMode && !$this->model->hasPlugboard()) {
            throw new EnigmaConfigurationException(
                "Model {$this->model->name} does not have a plugboard (disable strictMode to override)"
            );
        }
        $this->plugboard->plugLetters($letter1, $letter2);
    }

    /**
     * Connect multiple letter pairs on the plugboard.
     *
     * Only available on military models (Wehrmacht, Kriegsmarine).
     * Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.
     *
     * Accepts pairs in various formats:
     * - Space-separated string: "AV BS CG DL FU HZ IN KM OW RX"
     * - Array of pairs: ['AV', 'BS', 'CG', 'DL', 'FU', 'HZ', 'IN', 'KM', 'OW', 'RX']
     *
     * @param string|array<string> $pairs Pairs to connect
     *
     * @throws EnigmaConfigurationException If this model does not have a plugboard
     */
    public function plugLettersFromPairs(string|array $pairs): void
    {
        if ($this->strictMode && !$this->model->hasPlugboard()) {
            throw new EnigmaConfigurationException(
                "Model {$this->model->name} does not have a plugboard (disable strictMode to override)"
            );
        }
        $this->plugboard->plugLettersFromPairs($pairs);
    }

    /**
     * Disconnects 2 letters on the plugboard.
     * Because letters are connected in pairs, we only need to know one of them.
     *
     * Only available on military models (Wehrmacht, Kriegsmarine).
     * Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.
     *
     * @param Letter $letter 1 of the 2 letters to disconnect
     *
     * @throws EnigmaConfigurationException If this model does not have a plugboard
     */
    public function unplugLetters(Letter $letter): void
    {
        if ($this->strictMode && !$this->model->hasPlugboard()) {
            throw new EnigmaConfigurationException(
                "Model {$this->model->name} does not have a plugboard (disable strictMode to override)"
            );
        }
        $this->plugboard->unplugLetters($letter);
    }

    /**
     * Encode a sequence of letters (A-Z only).
     *
     * This method processes each character in the input through the Enigma machine.
     * The input must contain only valid Enigma alphabet characters (A-Z).
     * Use encodeText() for arbitrary text that needs conversion first.
     *
     * @param string $letters The letters to encode (A-Z only, no spaces or other characters)
     *
     * @throws \ValueError If the input contains invalid characters
     *
     * @return string The encoded letters
     *
     * @see Enigma::encodeLatinText() For encoding arbitrary text with automatic conversion
     */
    public function encodeLetters(string $letters): string
    {
        $result = '';
        $letters = strtoupper($letters);

        foreach (str_split($letters) as $char) {
            $result .= $this->encodeLetter(Letter::fromChar($char))->toChar();
        }

        return $result;
    }

    /**
     * Encode Latin text by first converting it to Enigma format.
     *
     * This method accepts Latin-based text (including numbers, accented characters,
     * punctuation, spaces, etc.) and converts it to Enigma-compatible format
     * before encoding. Non-Latin characters (Cyrillic, Chinese, etc.) will be
     * converted to X or skipped.
     *
     * Numbers are converted to German words (historical convention):
     * 0=NULL, 1=EINS, 2=ZWEI, 3=DREI, 4=VIER, 5=FUENF, 6=SECHS, 7=SIEBEN, 8=ACHT, 9=NEUN
     *
     * @param string $text The text to encode (Latin characters, numbers, accents, punctuation)
     * @param string $spaceReplacement Character(s) to replace spaces with (default: 'X')
     * @param bool $formatOutput Whether to format output in 5-letter groups (default: false)
     *
     * @return string The encoded text
     *
     * @see EnigmaTextConverter::latinToEnigmaFormat() For the conversion rules
     */
    public function encodeLatinText(
        string $text,
        string $spaceReplacement = 'X',
        bool $formatOutput = false
    ): string {
        $enigmaText = EnigmaTextConverter::latinToEnigmaFormat($text, $spaceReplacement);
        $encoded = $this->encodeLetters($enigmaText);

        if ($formatOutput) {
            return EnigmaTextConverter::formatInGroups($encoded);
        }

        return $encoded;
    }

    /**
     * Encode binary data through the Enigma machine.
     *
     * This method converts binary data to Enigma-compatible format and encodes it.
     * Useful for encoding arbitrary data that isn't text.
     *
     * @param string $binaryData Raw binary data to encode
     * @param bool $formatOutput Whether to format output in 5-letter groups (default: false)
     *
     * @return string The encoded data in Enigma format
     *
     * @see EnigmaTextConverter::binaryToEnigmaFormat() For the encoding scheme
     */
    public function encodeBinary(string $binaryData, bool $formatOutput = false): string
    {
        $enigmaText = EnigmaTextConverter::binaryToEnigmaFormat($binaryData);
        $encoded = $this->encodeLetters($enigmaText);

        if ($formatOutput) {
            return EnigmaTextConverter::formatInGroups($encoded);
        }

        return $encoded;
    }

    /**
     * Check if this model historically has a plugboard.
     *
     * Military models have plugboards, commercial models do not.
     * Note: The plugboard object always exists internally, but this method
     * indicates whether it should be used according to historical accuracy.
     */
    public function hasPlugboard(): bool
    {
        return $this->model->hasPlugboard();
    }

    /**
     * Deep clone the Enigma machine.
     *
     * This ensures all internal components (plugboard, entry wheel, rotors, reflector) are
     * properly cloned so the cloned machine operates independently.
     */
    public function __clone(): void
    {
        $reflection = new \ReflectionClass($this);

        // Clone the plugboard (readonly property requires reflection)
        $plugboardClone = clone $this->plugboard;
        $plugboardProperty = $reflection->getProperty('plugboard');
        $plugboardProperty->setValue($this, $plugboardClone);

        // Clone the entry wheel (readonly property requires reflection)
        $entryWheelClone = clone $this->entryWheel;
        $entryWheelProperty = $reflection->getProperty('entryWheel');
        $entryWheelProperty->setValue($this, $entryWheelClone);

        // Clone mounted rotors
        $this->rotors = clone $this->rotors;

        // Clone the reflector
        $this->reflector = clone $this->reflector;
    }
}
