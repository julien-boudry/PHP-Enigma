<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\EntryWheel;

use JulienBoudry\EnigmaMachine\Letter;

/**
 * Alphabetical Entry Wheel used in military Enigma models.
 *
 * Military Enigma models (Wehrmacht, Kriegsmarine) use alphabetical order:
 * A→0, B→1, C→2, ... (identity mapping)
 *
 * This is effectively a pass-through - the letter position equals the contact position.
 */
class AlphabeticalEntryWheel extends AbstractEntryWheel
{
    /**
     * Alphabetical order (identity mapping).
     */
    public const string WIRING = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    protected function getWiringString(): string
    {
        return self::WIRING;
    }
}
