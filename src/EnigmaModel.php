<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine;

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
     * Enigma K Commercial (A27) - 3-rotor model without plugboard.
     *
     * The commercial Enigma K was sold to various customers from 1927-1944.
     * Features QWERTZ entry wheel and settable reflector.
     */
    case ENIGMA_K;

    /**
     * Swiss Enigma K - 3-rotor model without plugboard.
     *
     * Modified version of Enigma K used by the Swiss Army, Air Force, and Foreign Ministry.
     * Rotors were rewired by the Swiss for additional security.
     */
    case SWISS_K;

    /**
     * Railway Enigma (Rocket) - 3-rotor model without plugboard.
     *
     * Special variant of Enigma K used by the German Reichsbahn (Railway).
     * Features rewired rotors and reflector.
     */
    case RAILWAY;

    /**
     * Enigma T (Tirpitz) - 3-rotor model without plugboard.
     *
     * Used for communications between Germany and Japan during WW2.
     * Features a unique entry wheel, 8 rotors with 5 notches each, and unique reflector.
     */
    case TIRPITZ;

    /**
     * Get the expected number of rotors for this model.
     */
    public function getExpectedRotorCount(): int
    {
        return match ($this) {
            self::WMLW, self::KMM3, self::ENIGMA_K, self::SWISS_K, self::RAILWAY, self::TIRPITZ => 3,
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
     * Check if this model has a plugboard.
     *
     * Military Enigma models (Wehrmacht, Kriegsmarine) have plugboards.
     * Commercial models (Enigma K, Swiss-K, Railway) and Enigma T do not.
     */
    public function hasPlugboard(): bool
    {
        return match ($this) {
            self::WMLW, self::KMM3, self::KMM4 => true,
            self::ENIGMA_K, self::SWISS_K, self::RAILWAY, self::TIRPITZ => false,
        };
    }

    /**
     * Get the entry wheel type for this model.
     *
     * Commercial models use QWERTZ keyboard order for the entry wheel.
     * Enigma T uses its own unique entry wheel order.
     * Military models use alphabetical (ABCDEF...) order.
     */
    public function getEntryWheelType(): EntryWheelType
    {
        return match ($this) {
            self::ENIGMA_K, self::SWISS_K, self::RAILWAY => EntryWheelType::QWERTZ,
            self::TIRPITZ => EntryWheelType::TIRPITZ,
            self::WMLW, self::KMM3, self::KMM4 => EntryWheelType::ALPHABETICAL,
        };
    }

    /**
     * Get the compatible reflector types for this model.
     *
     * @return array<ReflectorType>
     */
    public function getCompatibleReflectors(): array
    {
        return match ($this) {
            self::WMLW => [ReflectorType::B, ReflectorType::C, ReflectorType::DORA],
            self::KMM3 => [ReflectorType::B, ReflectorType::C],
            self::KMM4 => [ReflectorType::BTHIN, ReflectorType::CTHIN],
            self::ENIGMA_K => [ReflectorType::K],
            self::SWISS_K => [ReflectorType::SWISS_K],
            self::RAILWAY => [ReflectorType::RAILWAY],
            self::TIRPITZ => [ReflectorType::TIRPITZ],
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
