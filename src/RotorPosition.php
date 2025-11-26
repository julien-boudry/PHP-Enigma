<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Enumeration of rotor positions in the Enigma machine.
 *
 * Defines the slots where rotors can be mounted. Most Enigma models have 3 positions (P1, P2, P3),
 * while the Kriegsmarine M4 has an additional fourth "Greek" position that never rotates.
 *
 * @package Enigma
 */
enum RotorPosition: int
{
    /**
     * ID Rotorposition 1.
     */
    case P1 = 0;

    /**
     * ID Rotorposition 2.
     */
    case P2 = 1;

    /**
     * ID Rotorposition 3.
     */
    case P3 = 2;

    /**
     * ID Rotorposition 4
     * only available in model Kriegsmarine M4, also call 'Greek rotor'
     * this rotor never turns.
     */
    case GREEK = 3;

    public static function getPositionIntValue(RotorPosition $position): int
    {
        return $position->value;
    }
}
