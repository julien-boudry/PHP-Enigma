<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Represents a Reflector (Umkehrwalze) of an Enigma machine.
 *
 * After passing through the plugboard and all rotors, the reflector redirects the signal
 * back through the rotors in reverse order. Because no letter connects to itself,
 * the signal always takes a different return path.
 *
 * This reciprocal property enables the Enigma to work for both encryption and decryption
 * using the same settings—encoding the same message twice returns the original text.
 *
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 * @version 2.0
 * @package Enigma
 */
class EnigmaReflector
{
    /**
     * stores the setup for all available reflectors.
     *
     * @var array<int, EnigmaSetup>|null
     */
    private static ?array $defaultSetup = null;

    /**
     * Get the setup for all available reflectors.
     *
     * @return array<int, EnigmaSetup>
     */
    public static function getDefaultSetup(): array
    {
        if (self::$defaultSetup === null) {
            self::$defaultSetup = [
                new EnigmaSetup(ReflectorType::B, 'YRUHQSLDPXNGOKMIEBFZCWVJAT', [EnigmaModel::WMLW, EnigmaModel::KMM3]),
                new EnigmaSetup(ReflectorType::C, 'FVPJIAOYEDRZXWGCTKUQSBNMHL', [EnigmaModel::WMLW, EnigmaModel::KMM3]),
                new EnigmaSetup(ReflectorType::BTHIN, 'ENKQAUYWJICOPBLMDXZVFTHRGS', [EnigmaModel::KMM4]),
                new EnigmaSetup(ReflectorType::CTHIN, 'RDOBJNTKVEHMLFCWZAXGYIPSUQ', [EnigmaModel::KMM4]),
            ];
        }

        return self::$defaultSetup;
    }

    /**
     * The wiring of the reflector.
     * Pins are connected in pairs, that means, if 'D' on side A connects to 'H'
     * on side B, 'H' on side A connects to 'D' on side B. No letter must connect to itself!
     *
     * @var EnigmaWiring
     */
    private EnigmaWiring $wiring;

    /**
     * Constructor creates a new Wiring with the setup from $wiring.
     *
     * @uses EnigmaWiring
     *
     * @param string $wiring setup for the wiring
     */
    public function __construct(string $wiring)
    {
        $this->wiring = new EnigmaWiring($wiring);
    }

    /**
     * Send a letter through the wiring.
     * Because pins are connected in pairs, there is no difference if
     * processLetter1stPass() or processLetter2ndPass() is used.
     *
     * @param $letter letter to process
     *
     * @return int resulting letter
     */
    public function processLetter(int $letter): int
    {
        return $this->wiring->processLetter1stPass($letter);
    }

    /**
     * Deep clone the reflector.
     */
    public function __clone(): void
    {
        $this->wiring = clone $this->wiring;
    }
}
