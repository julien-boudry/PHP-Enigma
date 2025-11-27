<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Enumeration of Enigma machine models.
 *
 * Defines the different historical Enigma machine variants that can be emulated.
 * Each model has its own specific set of available rotors and reflectors.
 */
enum EnigmaModel
{
    /**
     * Wehrmacht/Luftwaffe (3-rotor model).
     */
    case WMLW;

    /**
     * Kriegsmarine M3 (3-rotor model).
     */
    case KMM3;

    /**
     * Kriegsmarine M4 (4-rotor model).
     */
    case KMM4;

    /**
     * Get the expected number of rotors for this model.
     */
    public function getExpectedRotorCount(): int
    {
        return match ($this) {
            self::WMLW, self::KMM3 => 3,
            self::KMM4 => 4,
        };
    }

    /**
     * Check if this model requires a Greek rotor.
     */
    public function requiresGreekRotor(): bool
    {
        return $this === self::KMM4;
    }

    /**
     * Get the compatible reflector types for this model.
     *
     * @return array<ReflectorType>
     */
    public function getCompatibleReflectors(): array
    {
        return match ($this) {
            self::WMLW, self::KMM3 => [ReflectorType::B, ReflectorType::C],
            self::KMM4 => [ReflectorType::BTHIN, ReflectorType::CTHIN],
        };
    }

    /**
     * Check if a reflector type is compatible with this model.
     */
    public function isReflectorCompatible(ReflectorType $reflector): bool
    {
        return \in_array($reflector, $this->getCompatibleReflectors(), true);
    }
}
