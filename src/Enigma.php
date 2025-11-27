<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Represents an Enigma cipher machine.
 *
 * This class emulates the historical Enigma machine used during World War II.
 * Three different models can be emulated (Wehrmacht/Luftwaffe, Kriegsmarine M3, and Kriegsmarine M4),
 * each with its own set of rotors and reflectors.
 *
 * Depending on the model, 3 or 4 rotors are mounted. Only the first three rotors can be triggered
 * by the advance mechanism. A letter is encoded by sending its corresponding signal through:
 * plugboard → rotors 1..3(4) → reflector → rotors 3(4)..1 → plugboard.
 *
 * After each encoded letter, the advance mechanism changes the internal setup by rotating the rotors.
 *
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 */
class Enigma
{
    /**
     * The plugboard that connects input and output to the 1st rotor.
     *
     * @var EnigmaPlugboard
     */
    public readonly EnigmaPlugboard $plugboard;

    /**
     * The rotors used by the Enigma.
     */
    public private(set) RotorConfiguration $rotors;

    /**
     * The reflector used by the Enigma.
     */
    public private(set) EnigmaReflector $reflector;

    /**
     * The model of the Enigma machine.
     */
    public readonly EnigmaModel $model;

    /**
     * Constructor sets up the plugboard and creates the rotors and reflectros available for the given model.
     * The initital rotors and reflectros are mounted.
     *
     * @param EnigmaModel $model ID for the model to emulate
     * @param RotorConfiguration $rotors The rotor configuration
     * @param ReflectorType $reflector ID for the reflector for the initial setup
     */
    public function __construct(EnigmaModel $model, RotorConfiguration $rotors, ReflectorType $reflector)
    {
        $this->model = $model;
        $this->rotors = $rotors;
        $this->plugboard = new EnigmaPlugboard;

        $this->mountReflector($reflector);
    }

    /**
     * Advance the rotors.
     * Rotor 1 advances every time, rotor 2 when a notch on rotor 1 is open and when rotor 3 advances, rotor 3 when a notch on rotor 2 is open.
     *
     * @return void
     */
    private function advance(): void
    {
        if ($this->rotors->getMiddle()->isNotchOpen()) {
            $this->rotors->getLeft()->advance();
            $this->rotors->getMiddle()->advance();
        }
        if ($this->rotors->getRight()->isNotchOpen()) {
            $this->rotors->getMiddle()->advance();
        }
        $this->rotors->getRight()->advance();
    }

    /**
     * Encode a single letter.
     * The letter passes the plugboard, the rotors, the reflector, the rotors in the opposite direction and again the plugboard.
     * Every encoding triggers the advancemechanism.
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
        $value = $this->plugboard->processLetter($letter);

        $rotorArray = $this->rotors->toArray();
        foreach ($rotorArray as $rotor) {
            $value = $rotor->processLetter1stPass($value);
        }

        $value = $this->reflector->processLetter($value);

        foreach (array_reverse($rotorArray) as $rotor) {
            $value = $rotor->processLetter2ndPass($value);
        }

        return $this->plugboard->processLetter($value);
    }

    /**
     * Mount a reflector into the enigma.
     * The previously used reflector will be replaced.
     *
     * @param ReflectorType $reflector The reflector type to mount
     *
     * @throws \InvalidArgumentException If the reflector is not compatible with this model
     */
    public function mountReflector(ReflectorType $reflector): void
    {
        if (!$this->model->isReflectorCompatible($reflector)) {
            throw new \InvalidArgumentException(
                "Reflector {$reflector->name} is not compatible with model {$this->model->name}"
            );
        }

        $this->reflector = EnigmaReflector::fromType($reflector);
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
     * @param Letter $letter1 letter 1 to connect
     * @param Letter $letter2 letter 2 to connect
     */
    public function plugLetters(Letter $letter1, Letter $letter2): void
    {
        $this->plugboard->plugLetters($letter1, $letter2);
    }

    /**
     * Disconnects 2 letters on the plugboard.
     * Because letters are connected in pairs, we only need to know one of them.
     *
     * @param Letter $letter 1 of the 2 letters to disconnect
     */
    public function unplugLetters(Letter $letter): void
    {
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
     * Deep clone the Enigma machine.
     *
     * This ensures all internal components (plugboard, rotors, reflector) are
     * properly cloned so the cloned machine operates independently.
     */
    public function __clone(): void
    {
        // Clone the plugboard (readonly property requires reflection)
        $plugboardClone = clone $this->plugboard;
        $reflection = new \ReflectionClass($this);
        $plugboardProperty = $reflection->getProperty('plugboard');
        $plugboardProperty->setValue($this, $plugboardClone);

        // Clone mounted rotors
        $this->rotors = clone $this->rotors;

        // Clone the reflector
        $this->reflector = clone $this->reflector;
    }
}
