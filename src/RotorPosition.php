<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Enumeration of rotor positions in the Enigma machine.
 *
 * Defines the slots where rotors can be mounted. Most Enigma models have 3 positions (P1, P2, P3),
 * while the Kriegsmarine M4 has an additional fourth "Greek" position that never rotates.
 *
 * Signal flow: Keyboard → Plugboard → P1 → P2 → P3 [→ GREEK] → Reflector → [GREEK →] P3 → P2 → P1 → Plugboard → Lampboard
 *
 * Rotation behavior:
 * - P1 (rightmost): Rotates on every keypress
 * - P2 (middle): Rotates when P1 reaches its notch, or when P3 rotates (double-stepping)
 * - P3 (leftmost): Rotates when P2 reaches its notch
 * - GREEK: Never rotates (M4 only)
 */
enum RotorPosition: int
{
    /**
     * Position 1 - Rightmost rotor, fastest rotating.
     * Rotates on every keypress.
     */
    case P1 = 0;

    /**
     * Position 2 - Middle rotor.
     * Rotates when P1 reaches its notch, or due to double-stepping when P3 rotates.
     */
    case P2 = 1;

    /**
     * Position 3 - Leftmost rotor in 3-rotor models, slowest rotating.
     * Rotates when P2 reaches its notch.
     */
    case P3 = 2;

    /**
     * Greek position - Leftmost rotor in Kriegsmarine M4 model only.
     * This rotor never rotates. Only BETA and GAMMA rotors can be mounted here.
     */
    case GREEK = 3;
}
