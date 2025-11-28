<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\EntryWheel;

use JulienBoudry\EnigmaMachine\{EnigmaWiring, Letter};

/**
 * Abstract base class for Entry Wheels (Eintrittswalze, ETW).
 *
 * The entry wheel is the first component the signal passes through when entering
 * the rotor assembly. It maps keyboard positions to rotor contact positions.
 *
 * Different Enigma models use different entry wheel configurations:
 * - Military models use alphabetical order (identity mapping)
 * - Commercial models use QWERTZ keyboard order
 */
abstract class AbstractEntryWheel
{
    /**
     * The wiring of the entry wheel.
     */
    protected EnigmaWiring $wiring;

    /**
     * Get the wiring string for this entry wheel.
     */
    abstract protected function getWiringString(): string;

    /**
     * Constructor creates the entry wheel wiring.
     */
    public function __construct()
    {
        $this->wiring = new EnigmaWiring($this->getWiringString());
    }

    /**
     * Process a letter entering the rotor assembly (keyboard → rotors).
     *
     * @param Letter $letter The letter from the keyboard/plugboard
     *
     * @return Letter The letter mapped to rotor contact position
     */
    public function processInward(Letter $letter): Letter
    {
        return $this->wiring->processLetter1stPass($letter);
    }

    /**
     * Process a letter exiting the rotor assembly (rotors → lamps).
     *
     * @param Letter $letter The letter from the rotor assembly
     *
     * @return Letter The letter mapped to keyboard/lamp position
     */
    public function processOutward(Letter $letter): Letter
    {
        return $this->wiring->processLetter2ndPass($letter);
    }

    /**
     * Deep clone the entry wheel.
     */
    public function __clone(): void
    {
        $this->wiring = clone $this->wiring;
    }
}
