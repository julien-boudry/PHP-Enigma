<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * This class represents a Reflector of an Enigma.
 *
 * After its way through plugboard and all rotors, the reflector leads the signal all the way back.
 * Because no letter must connect to itself, its provided that the signal takes a different route.
 * This enables the Enigma to work both for encryption and decryption without any further setup
 */
/**
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 *
 * @version 2.0
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
