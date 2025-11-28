<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine;

use JulienBoudry\EnigmaMachine\EntryWheel\{AbstractEntryWheel, AlphabeticalEntryWheel, QwertzEntryWheel, TirpitzEntryWheel};

/**
 * Types of Entry Wheels (Eintrittswalze, ETW) used in Enigma machines.
 *
 * The entry wheel is the first component the signal passes through when entering
 * the rotor assembly. Different Enigma models use different entry wheel types.
 */
enum EntryWheelType: string
{
    /**
     * Alphabetical order (A→0, B→1, C→2...) - used in military models.
     */
    case ALPHABETICAL = 'ALPHABETICAL';

    /**
     * QWERTZ keyboard order (Q→0, W→1, E→2...) - used in commercial models.
     */
    case QWERTZ = 'QWERTZ';

    /**
     * Tirpitz order (K→0, Z→1, R→2...) - used in Enigma T (Tirpitz).
     */
    case TIRPITZ = 'TIRPITZ';

    /**
     * Create the entry wheel instance for this type.
     */
    public function createEntryWheel(): AbstractEntryWheel
    {
        return match ($this) {
            self::ALPHABETICAL => new AlphabeticalEntryWheel,
            self::QWERTZ => new QwertzEntryWheel,
            self::TIRPITZ => new TirpitzEntryWheel,
        };
    }
}
