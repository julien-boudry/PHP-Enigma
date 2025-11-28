<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\EntryWheel;

/**
 * QWERTZ Entry Wheel used in commercial Enigma models.
 *
 * Commercial models (Enigma K, Swiss-K, Railway) use QWERTZ keyboard order:
 * Q→0, W→1, E→2, R→3, T→4, Z→5, U→6, I→7, O→8, A→9, S→10, D→11, F→12, G→13,
 * H→14, J→15, K→16, P→17, Y→18, X→19, C→20, V→21, B→22, N→23, M→24, L→25
 *
 * This maps the German QWERTZ keyboard layout to sequential rotor contact positions.
 */
class QwertzEntryWheel extends AbstractEntryWheel
{
    /**
     * QWERTZ keyboard order as used in commercial Enigma models.
     */
    public const string WIRING = 'QWERTZUIOASDFGHJKPYXCVBNML';

    protected function getWiringString(): string
    {
        return self::WIRING;
    }
}
