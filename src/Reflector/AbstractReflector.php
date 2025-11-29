<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Reflector;

use JulienBoudry\EnigmaMachine\{EnigmaWiring, Letter, ReflectorType};

/**
 * Abstract base class for Enigma Reflectors (Umkehrwalze).
 *
 * After passing through the plugboard and all rotors, the reflector redirects the signal
 * back through the rotors in reverse order. Because no letter connects to itself,
 * the signal always takes a different return path.
 *
 * This reciprocal property enables the Enigma to work for both encryption and decryption
 * using the same settings—encoding the same message twice returns the original text.
 *
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 */
abstract class AbstractReflector
{
    /**
     * The wiring of the reflector.
     * Pins are connected in pairs, that means, if 'D' on side A connects to 'H'
     * on side B, 'H' on side A connects to 'D' on side B. No letter must connect to itself!
     */
    private EnigmaWiring $wiring;

    /**
     * Get the wiring configuration for this reflector type.
     *
     * @return string The 26-character wiring string
     */
    abstract protected function getWiring(): string;

    /**
     * Get the reflector type.
     */
    abstract public function getType(): ReflectorType;

    /**
     * Constructor creates a new Wiring with the setup from the concrete class.
     */
    public function __construct()
    {
        $this->wiring = new EnigmaWiring($this->getWiring());
    }

    /**
     * Send a letter through the wiring.
     * Because pins are connected in pairs, there is no difference if
     * processLetter1stPass() or processLetter2ndPass() is used.
     *
     * @param $letter letter to process
     *
     * @return Letter resulting letter
     */
    public function processLetter(Letter $letter): Letter
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
