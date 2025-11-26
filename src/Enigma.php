<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * This class represents an Enigma.
 *
 * 3 different models can be emulated with this class, each one has its own set of rotors and reflectors to be used with.
 * Depending on the model, 3 or 4 rotors are mounted, only the first three of them can be triggered by the advance mechanism.
 * A letter is encoded by sending its corresponding signal through the plugboard, rotor 1..3(4), the reflector,
 * rotor 3(4)..1 and the plugboard again.
 * After each encoded letter, the advance mechanism changes the internal setup by rotating the rotors.
 */
/**const
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 * @version 2.0
 * @package Enigma
 * @subpackage Core
 */
class Enigma
{
    /**
     * Keyboard codes.
     */
    public const KEY_A = 0;
    public const KEY_B = 1;
    public const KEY_C = 2;
    public const KEY_D = 3;
    public const KEY_E = 4;
    public const KEY_F = 5;
    public const KEY_G = 6;
    public const KEY_H = 7;
    public const KEY_I = 8;
    public const KEY_J = 9;
    public const KEY_K = 10;
    public const KEY_L = 11;
    public const KEY_M = 12;
    public const KEY_N = 13;
    public const KEY_O = 14;
    public const KEY_P = 15;
    public const KEY_Q = 16;
    public const KEY_R = 17;
    public const KEY_S = 18;
    public const KEY_T = 19;
    public const KEY_U = 20;
    public const KEY_V = 21;
    public const KEY_W = 22;
    public const KEY_X = 23;
    public const KEY_Y = 24;
    public const KEY_Z = 25;

    /**
     * converts a character into its pendant in the Enigma alphabet.
     *
     * @param $l character to convert
     *
     * @return int represention of a character in the Enigma alphabet
     */
    public static function enigma_l2p(string $l): int
    {
        $r = array_search(strtoupper($l), EnigmaAlphabet::MAP, true);

        if ($r === false) {
            throw new \RuntimeException('Invalid character for Enigma alphabet: ' . $l);
        }

        return $r;
    }

    /**
     * converts an element of the Enigma alphabet to 'our' alphabet.
     *
     * @param $p element to be converted
     *
     * @return string resulting character
     */
    public static function enigma_p2l(int $p): string
    {
        return EnigmaAlphabet::MAP[$p];
    }

    /**
     * The plugboard that connects input and output to the 1st rotor.
     *
     * @var EnigmaPlugboard
     */
    public readonly EnigmaPlugboard $plugboard;

    /**
     * The rotors used by the Enigma.
     *
     * @var array<EnigmaRotor>
     */
    public private(set) array $rotors;

    /**
     * The reflector used by the Enigma.
     */
    public private(set) EnigmaReflector $reflector;

    /**
     * The rotors available for this model of the Enigma.
     *
     * @var array<EnigmaRotor>
     */
    public private(set) array $availablerotors;

    /**
     * The reflectors available for this model of the Enigma.
     *
     * @var array<string, EnigmaReflector>
     */
    public private(set) array $availablereflectors;

    /**
     * Constructor sets up the plugboard and creates the rotors and reflectros available for the given model.
     * The initital rotors and reflectros are mounted.
     *
     * @param $model ID for the model to emulate
     * @param array<RotorType> $rotors
     * @param $reflector ID for the reflector for the initial setup
     */
    public function __construct(EnigmaModel $model, array $rotors, ReflectorType $reflector)
    {
        $this->rotors = [];
        $this->availablerotors = [];
        $this->availablereflectors = [];

        $this->plugboard = new EnigmaPlugboard;

        foreach (EnigmaRotor::getDefaultSetup() as $r) {
            if (\in_array($model, $r->used, true)) {
                $this->availablerotors[$r->reflectorType->name] = new EnigmaRotor($r->wiring, $r->notches ?? []);
            }
        }
        foreach (EnigmaReflector::getDefaultSetup() as $r) {
            if (\in_array($model, $r->used, true)) {
                $this->availablereflectors[$r->reflectorType->name] = new EnigmaReflector($r->wiring);
            }
        }

        foreach ($rotors as $key => $value) {
            $this->mountRotor(RotorPosition::from($key), $value);
        }
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
        if ($this->rotors[1]->isNotchOpen()) {
            $this->rotors[2]->advance();
            $this->rotors[1]->advance();
        }
        if ($this->rotors[0]->isNotchOpen()) {
            $this->rotors[1]->advance();
        }
        $this->rotors[0]->advance();
    }

    /**
     * Encode a single letter.
     * The letter passes the plugboard, the rotors, the reflector, the rotors in the opposite direction and again the plugboard.
     * Every encoding triggers the advancemechanism.
     *
     * @see Enigma::advance()
     *
     * @param $letter letter to encode
     *
     * @return string encoded letter
     */
    public function encodeLetter(string $letter): string
    {
        $this->advance();
        $letter = self::enigma_l2p($letter);
        $letter = $this->plugboard->processLetter($letter);
        for ($idx = 0; $idx < \count($this->rotors); $idx++) {
            $letter = $this->rotors[$idx]->processLetter1stPass($letter);
        }
        $letter = $this->reflector->processLetter($letter);
        for ($idx = (\count($this->rotors) - 1); $idx > -1; $idx--) {
            $letter = $this->rotors[$idx]->processLetter2ndPass($letter);
        }
        $letter = $this->plugboard->processLetter($letter);

        return self::enigma_p2l($letter);
    }

    /**
     * Mount a rotor into the enigma.
     * A rotor may only be used in one position at a time, so if an rotor is already in use nothing is changed.
     * The previously used rotor will be replaced.
     *
     * @param $position ID of the position to set the rotor
     * @param $rotor ID of the rotor to use
     *
     * @return void
     */
    public function mountRotor(RotorPosition $position, RotorType $rotor): void
    {
        $position = RotorPosition::getPositionIntValue($position);

        if ($this->availablerotors[$rotor->name]->inUse) {
            return;
        }
        if (isset($this->rotors[$position])) {
            $this->rotors[$position]->inUse = false;
        }
        $this->rotors[$position] = $this->availablerotors[$rotor->name];
        $this->rotors[$position]->inUse = true;
    }

    /**
     * Mount a reflector into the enigma.
     * The previously used reflector will be replaced.
     *
     * @param $reflector ID of the reflector to use
     *
     * @return void
     */
    public function mountReflector(ReflectorType $reflector): void
    {
        $this->reflector = $this->availablereflectors[$reflector->name];
    }

    /**
     * Turn a rotor to a new position.
     *
     * @param $position ID of the rotor to turn
     * @param $letter letter to turn to
     *
     * @return void
     *
     * @uses enigma_l2p
     */
    public function setPosition(RotorPosition $position, string $letter): void
    {
        $this->rotors[$position->value]->setPosition(self::enigma_l2p($letter));
    }

    /**
     * Get the current position of a rotor.
     *
     * @param $position ID of the rotor
     *
     * @return string current position
     */
    public function getPosition(RotorPosition $position): string
    {
        $position = RotorPosition::getPositionIntValue($position);

        return self::enigma_p2l($this->rotors[$position]->getPosition());
    }

    /**
     * Turn the ringstellung of a rotor to a new position.
     *
     * @param $position ID of the rotor
     * @param $letter letter to turn to
     *
     * @return void
     *
     * @uses enigma_l2p
     */
    public function setRingstellung(RotorPosition $position, string $letter): void
    {
        $position = RotorPosition::getPositionIntValue($position);

        $this->rotors[$position]->setRingstellung(self::enigma_l2p($letter));
    }

    /**
     * Connect 2 letters on the plugboard.
     * The letter are transformed to integer first.
     *
     * @param $letter1 letter 1 to connect
     * @param $letter2 letter 2 to connect
     *
     * @return void
     */
    public function plugLetters(string $letter1, string $letter2): void
    {
        $this->plugboard->plugLetters(self::enigma_l2p($letter1), self::enigma_l2p($letter2));
    }

    /**
     * Disconnects 2 letters on the plugboard.
     * Because letters are connected in pairs, we only need to know one of them.
     *
     * @param $letter 1 of the 2 letters to disconnect
     *
     * @return void
     *
     * @uses enigma_l2p
     */
    public function unplugLetters(string $letter): void
    {
        $this->plugboard->unplugLetters(self::enigma_l2p($letter));
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
     * @return string The encoded letters
     *
     * @throws \RuntimeException If the input contains invalid characters
     *
     * @see Enigma::encodeText() For encoding arbitrary text with automatic conversion
     */
    public function encodeLetters(string $letters): string
    {
        $result = '';
        $letters = strtoupper($letters);

        foreach (str_split($letters) as $char) {
            $result .= $this->encodeLetter($char);
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
        $clonedRotors = [];
        foreach ($this->rotors as $position => $rotor) {
            $clonedRotors[$position] = clone $rotor;
        }
        $this->rotors = $clonedRotors;

        // Clone the reflector
        $this->reflector = clone $this->reflector;

        // Clone all available rotors
        $clonedAvailableRotors = [];
        foreach ($this->availablerotors as $name => $rotor) {
            $clonedAvailableRotors[$name] = clone $rotor;
        }
        $this->availablerotors = $clonedAvailableRotors;

        // Clone all available reflectors
        $clonedAvailableReflectors = [];
        foreach ($this->availablereflectors as $name => $reflector) {
            $clonedAvailableReflectors[$name] = clone $reflector;
        }
        $this->availablereflectors = $clonedAvailableReflectors;
    }
}
