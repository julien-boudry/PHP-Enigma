<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Enumeration of available reflector types.
 *
 * Defines the different reflector variants (Umkehrwalze) available for Enigma machines.
 * Different Enigma models support different reflector types.
 */
enum ReflectorType
{
    case B;

    case C;

    /**
     * ID Reflector B Thin
     * only available in model Kriegsmarine M4.
     */
    case BTHIN;

    /**
     * ID Reflector C Tthin
     * only available in model Kriegsmarine M4.
     */
    case CTHIN;
}
