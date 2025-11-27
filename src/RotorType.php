<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

use JulienBoudry\Enigma\Rotor\AbstractRotor;
use JulienBoudry\Enigma\Rotor\RotorBeta;
use JulienBoudry\Enigma\Rotor\RotorGamma;
use JulienBoudry\Enigma\Rotor\RotorI;
use JulienBoudry\Enigma\Rotor\RotorII;
use JulienBoudry\Enigma\Rotor\RotorIII;
use JulienBoudry\Enigma\Rotor\RotorIV;
use JulienBoudry\Enigma\Rotor\RotorV;
use JulienBoudry\Enigma\Rotor\RotorVI;
use JulienBoudry\Enigma\Rotor\RotorVII;
use JulienBoudry\Enigma\Rotor\RotorVIII;

/**
 * Enumeration of available rotor types.
 *
 * Defines the different rotor variants (Walzen) available for Enigma machines.
 * Each rotor has unique internal wiring and notch positions.
 * Different Enigma models support different subsets of these rotors.
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

    /**
     * Create a rotor instance for this type.
     *
     * @param Letter $ringstellung The ring setting (default: A)
     *
     * @return AbstractRotor The rotor instance
     */
    public function createRotor(Letter $ringstellung = Letter::A): AbstractRotor
    {
        return match ($this) {
            self::I => new RotorI($ringstellung),
            self::II => new RotorII($ringstellung),
            self::III => new RotorIII($ringstellung),
            self::IV => new RotorIV($ringstellung),
            self::V => new RotorV($ringstellung),
            self::VI => new RotorVI($ringstellung),
            self::VII => new RotorVII($ringstellung),
            self::VIII => new RotorVIII($ringstellung),
            self::BETA => new RotorBeta($ringstellung),
            self::GAMMA => new RotorGamma($ringstellung),
        };
    }

    /**
     * Check if this rotor type is a Greek rotor (BETA or GAMMA).
     *
     * @return bool True if this is a Greek rotor type
     */
    public function isGreekRotor(): bool
    {
        return $this === self::BETA || $this === self::GAMMA;
    }
}
