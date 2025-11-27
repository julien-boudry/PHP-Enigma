<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

use JulienBoudry\Enigma\Reflector\{AbstractReflector, ReflectorB, ReflectorBThin, ReflectorC, ReflectorCThin, ReflectorDora};

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
     * UKW-D (Umkehrwalze Dora) - Rewirable reflector.
     * Only available in Wehrmacht/Luftwaffe model.
     * Use createDoraReflector() to create with custom wiring.
     */
    case DORA;

    /**
     * Create a reflector instance for this type.
     *
     * For DORA reflector, this creates an instance with default wiring.
     * Use createDoraReflector() for custom wiring configurations.
     *
     * @return AbstractReflector The reflector instance
     */
    public function createReflector(): AbstractReflector
    {
        return match ($this) {
            self::B => new ReflectorB,
            self::C => new ReflectorC,
            self::BTHIN => new ReflectorBThin,
            self::CTHIN => new ReflectorCThin,
            self::DORA => ReflectorDora::withDefaultWiring(),
        };
    }

    /**
     * Create a UKW-D (Dora) reflector with custom wiring.
     *
     * @param array<string, string> $pairs Array of 12 letter pairs, e.g., ['A' => 'B', 'C' => 'D', ...]
     *                                      The J↔Y pair is fixed and added automatically.
     *
     * @return ReflectorDora The configured reflector
     */
    public static function createDoraReflector(array $pairs): ReflectorDora
    {
        return new ReflectorDora($pairs);
    }

    /**
     * Create a UKW-D (Dora) reflector from a pairs string.
     *
     * @param string $pairsString 12 pairs as a string, e.g., "AB CD EF GH IK LM NO PQ RS TU VW XZ"
     *                            (J↔Y is added automatically)
     *
     * @return ReflectorDora The configured reflector
     */
    public static function createDoraReflectorFromString(string $pairsString): ReflectorDora
    {
        return ReflectorDora::fromString($pairsString);
    }
}
