<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

use JulienBoudry\Enigma\Reflector\AbstractReflector;
use JulienBoudry\Enigma\Reflector\ReflectorB;
use JulienBoudry\Enigma\Reflector\ReflectorBThin;
use JulienBoudry\Enigma\Reflector\ReflectorC;
use JulienBoudry\Enigma\Reflector\ReflectorCThin;

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
     * ID Reflector C Thin
     * only available in model Kriegsmarine M4.
     */
    case CTHIN;

    /**
     * Create a reflector instance for this type.
     *
     * @return AbstractReflector The reflector instance
     */
    public function createReflector(): AbstractReflector
    {
        return match ($this) {
            self::B => new ReflectorB(),
            self::C => new ReflectorC(),
            self::BTHIN => new ReflectorBThin(),
            self::CTHIN => new ReflectorCThin(),
        };
    }
}
