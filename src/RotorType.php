<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Enumeration of available rotor types.
 *
 * Defines the different rotor variants (Walzen) available for Enigma machines.
 * Each rotor has unique internal wiring and notch positions.
 * Different Enigma models support different subsets of these rotors.
 *
 * @package Enigma
 */
enum RotorType
{
    /**
     * ID Rotor I.
     */
    case I;

    /**
     * ID Rotor II.
     */
    case II;

    /**
     * ID Rotor III.
     */
    case III;

    /**
     * ID Rotor IV.
     */
    case IV;

    /**
     * ID Rotor V.
     */
    case V;

    /**
     * ID Rotor VI
     * only available in model Kriegsmarine M3 and M4.
     */
    case VI;

    /**
     * ID Rotor VII
     * only available in model Kriegsmarine M3 and M4.
     */
    case VII;

    /**
     * ID Rotor VII
     * only available in model Kriegsmarine M3 and M4.
     */
    case VIII;

    case BETA;

    case GAMMA;
}
