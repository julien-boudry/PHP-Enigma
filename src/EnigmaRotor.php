<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * This class represents a Rotor of an Enigma.
 *
 * The Rotors are the key element of an Enigma. Each provides the monoalphabetical substitution of its wiring,
 * but unlike plugboard and reflector, rotors move, so that the substitution changes.
 *
 * <pre>
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * ||||||||||||||||||||||||||
 * EKMFLGDQVZNTOWYHXUSPAIBRCJ
 * =>
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * ||||||||||||||||||||||||||
 * JEKMFLGDQVZNTOWYHXUSPAIBRC
 * </pre>
 *
 * Notches mark the positions, where the next rotor may advance
 * The Ringstellung changes the position of the wiring relative to its notches and alphabet.
 */
/**
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 *
 * @version 2.0
 */
class EnigmaRotor
{
    /**
     * stores the setup for all available rotors.
     *
     * @var array<int, EnigmaSetup>|null
     */
    private static ?array $defaultSetup = null;

    /**
     * Get the setup for all available rotors.
     *
     * @return array<int, EnigmaSetup>
     */
    public static function getDefaultSetup(): array
    {
        if (self::$defaultSetup === null) {
            self::$defaultSetup = [
                new EnigmaSetup(RotorType::I, 'EKMFLGDQVZNTOWYHXUSPAIBRCJ', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Enigma::KEY_Q]),
                new EnigmaSetup(RotorType::II, 'AJDKSIRUXBLHWTMCQGZNPYFVOE', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Enigma::KEY_E]),
                new EnigmaSetup(RotorType::III, 'BDFHJLCPRTXVZNYEIWGAKMUSQO', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Enigma::KEY_V]),
                new EnigmaSetup(RotorType::IV, 'ESOVPZJAYQUIRHXLNFTGKDCMWB', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Enigma::KEY_J]),
                new EnigmaSetup(RotorType::V, 'VZBRGITYUPSDNHLXAWMJQOFECK', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Enigma::KEY_Z]),
                new EnigmaSetup(RotorType::VI, 'JPGVOUMFYQBENHZRDKASXLICTW', [EnigmaModel::KMM3, EnigmaModel::KMM4], [Enigma::KEY_M, Enigma::KEY_Z]),
                new EnigmaSetup(RotorType::VII, 'NZJHGRCXMYSWBOUFAIVLPEKQDT', [EnigmaModel::KMM3, EnigmaModel::KMM4], [Enigma::KEY_M, Enigma::KEY_Z]),
                new EnigmaSetup(RotorType::VIII, 'FKQHTLXOCBJSPDZRAMEWNIUYGV', [EnigmaModel::KMM3, EnigmaModel::KMM4], [Enigma::KEY_M, Enigma::KEY_Z]),
                new EnigmaSetup(RotorType::BETA, 'LEYJVCNIXWPBQMDRTAKZGFUHOS', [EnigmaModel::KMM4], []),
                new EnigmaSetup(RotorType::GAMMA, 'FSOKANUERHMBTIYCWLQPZXVGJD', [EnigmaModel::KMM4], []),
            ];
        }

        return self::$defaultSetup;
    }

    /**
     * The wiring of a rotor.
     *
     * @var EnigmaWiring
     */
    private EnigmaWiring $wiring;

    /**
     * The positions of the notches of a rotor.
     *
     * @var array<int> integer positions of the notches
     */
    private array $notches;

    /**
     * Actual position of the rotor.
     *
     * @var int actual rotorpositions
     */
    private int $position = 0;

    /**
     * Offset of the wiring.
     *
     * @var int actual positions rotor
     */
    private int $ringstellung = 0;

    /**
     * A rotor is in use or available.
     *
     * @var bool
     */
    public bool $inUse = false;

    /**
     * Constructor creates a new Wiring with the setup from $wiring and stores positions of the notches.
     *
     * @param $wiring setup for the wiring
     * @param array<int> $notches positions of the notches
     */
    public function __construct(string $wiring, array $notches)
    {
        $this->wiring = new EnigmaWiring($wiring);
        $this->notches = $notches;
    }

    /**
     * Advance the rotor by 1 step.
     * When postion reaches ENIGMA_ALPHABET_SIZE, it is reset to 0.
     *
     * @return void
     */
    public function advance(): void
    {
        $this->position = ($this->position + 1) % EnigmaAlphabet::count();
    }

    /**
     * A notch is open.
     * Returns true if the rotor is in a turnover position for the next rotor.
     *
     * @return bool turnover position reached
     */
    public function isNotchOpen(): bool
    {
        return \in_array($this->position, $this->notches, true);
    }

    /**
     * Send an letter from side A through the wiring to side B.
     * To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br>
     * + ENIGMA_ALPHABET_SIZE and % ENIGMA_ALPHABET_SIZE keep the value positive and in bounds.
     *
     * @param $letter letter to process
     *
     * @return int resulting letter
     */
    public function processLetter1stPass(int $letter): int
    {
        $letter = ($letter - $this->ringstellung + $this->position + EnigmaAlphabet::count()) % EnigmaAlphabet::count();
        $letter = $this->wiring->processLetter1stPass($letter);

        return ($letter + $this->ringstellung - $this->position + EnigmaAlphabet::count()) % EnigmaAlphabet::count();
    }

    /**
     * Send an letter from side B through the wiring to side A.
     * To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br>
     * + ENIGMA_ALPHABET_SIZE and % ENIGMA_ALPHABET_SIZE keep the value positive and in bounds.
     *
     * @param $letter letter to process
     *
     * @return int resulting letter
     */
    public function processLetter2ndPass(int $letter): int
    {
        $letter = ($letter - $this->ringstellung + $this->position + EnigmaAlphabet::count()) % EnigmaAlphabet::count();
        $letter = $this->wiring->processLetter2ndPass($letter);

        return ($letter + $this->ringstellung - $this->position + EnigmaAlphabet::count()) % EnigmaAlphabet::count();
    }

    /**
     * Set the rotor to a given position.
     *
     * @param $letter position to go to
     *
     * @return void
     */
    public function setPosition(int $letter): void
    {
        $this->position = $letter;
    }

    /**
     * Retrieve current position of the rotor.
     *
     * @return int current position
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * Sets the ringstellung to a given position.
     *
     * @param $letter position to go to
     *
     * @return void
     */
    public function setRingstellung(int $letter): void
    {
        $this->ringstellung = $letter;
    }
}
