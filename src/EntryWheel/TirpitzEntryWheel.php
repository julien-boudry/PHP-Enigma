<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\EntryWheel;

/**
 * Tirpitz Entry Wheel used in the Enigma T (Tirpitz).
 *
 * The Enigma T was used for communication between Germany and Japan.
 * It uses a unique entry wheel order that is neither alphabetical nor QWERTZ:
 * K→0, Z→1, R→2, O→3, U→4, Q→5, H→6, Y→7, A→8, I→9, G→10, B→11, L→12, W→13,
 * V→14, S→15, T→16, D→17, X→18, F→19, P→20, N→21, M→22, C→23, J→24, E→25
 */
class TirpitzEntryWheel extends AbstractEntryWheel
{
    /**
     * Tirpitz entry wheel order as used in Enigma T.
     */
    public const string WIRING = 'KZROUQHYAIGBLWVSTDXFPNMCJE';

    protected function getWiringString(): string
    {
        return self::WIRING;
    }
}
