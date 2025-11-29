<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine;

use JulienBoudry\EnigmaMachine\Rotor\{AbstractRotor, RotorBeta, RotorGamma, RotorI, RotorII, RotorIII, RotorIV, RotorV, RotorVI, RotorVII, RotorVIII};
use JulienBoudry\EnigmaMachine\Rotor\{RotorKI, RotorKII, RotorKIII, RotorSwissKI, RotorSwissKII, RotorSwissKIII, RotorRailwayI, RotorRailwayII, RotorRailwayIII};
use JulienBoudry\EnigmaMachine\Rotor\{RotorTirpitzI, RotorTirpitzII, RotorTirpitzIII, RotorTirpitzIV, RotorTirpitzV, RotorTirpitzVI, RotorTirpitzVII, RotorTirpitzVIII};

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

    // Commercial Enigma K rotors (handelsübliche Schaltung)

    /**
     * Commercial Enigma K Rotor I.
     * Notch at G (turnover at Y).
     */
    case K_I;

    /**
     * Commercial Enigma K Rotor II.
     * Notch at M (turnover at E).
     */
    case K_II;

    /**
     * Commercial Enigma K Rotor III.
     * Notch at V (turnover at N).
     */
    case K_III;

    // Swiss-K rotors (Swiss Air Force wiring)

    /**
     * Swiss-K Rotor I (Swiss Air Force wiring).
     * Notch at G (turnover at Y).
     */
    case SWISS_K_I;

    /**
     * Swiss-K Rotor II (Swiss Air Force wiring).
     * Notch at M (turnover at E).
     */
    case SWISS_K_II;

    /**
     * Swiss-K Rotor III (Swiss Air Force wiring).
     * Notch at V (turnover at N).
     */
    case SWISS_K_III;

    // Railway Enigma (Rocket) rotors

    /**
     * Railway Enigma Rotor I.
     * Notch at G (turnover at Y).
     */
    case RAILWAY_I;

    /**
     * Railway Enigma Rotor II.
     * Notch at M (turnover at E).
     */
    case RAILWAY_II;

    /**
     * Railway Enigma Rotor III.
     * Notch at V (turnover at N).
     */
    case RAILWAY_III;

    // Enigma T (Tirpitz) rotors - used for German-Japanese communications

    /**
     * Enigma T (Tirpitz) Rotor I.
     * 5 notches at E, H, K, N, Q.
     */
    case TIRPITZ_I;

    /**
     * Enigma T (Tirpitz) Rotor II.
     * 5 notches at E, H, K, N, Q.
     */
    case TIRPITZ_II;

    /**
     * Enigma T (Tirpitz) Rotor III.
     * 5 notches at E, H, K, N, Q.
     */
    case TIRPITZ_III;

    /**
     * Enigma T (Tirpitz) Rotor IV.
     * 5 notches at E, H, K, N, Q.
     */
    case TIRPITZ_IV;

    /**
     * Enigma T (Tirpitz) Rotor V.
     * 5 notches at E, H, K, N, Q.
     */
    case TIRPITZ_V;

    /**
     * Enigma T (Tirpitz) Rotor VI.
     * 5 notches at E, H, K, N, Q.
     */
    case TIRPITZ_VI;

    /**
     * Enigma T (Tirpitz) Rotor VII.
     * 5 notches at E, H, K, N, Q.
     */
    case TIRPITZ_VII;

    /**
     * Enigma T (Tirpitz) Rotor VIII.
     * 5 notches at E, H, K, N, Q.
     */
    case TIRPITZ_VIII;

    /**
     * Create a rotor instance for this type.
     *
     * @param $ringstellung The ring setting (default: A)
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
            self::K_I => new RotorKI($ringstellung),
            self::K_II => new RotorKII($ringstellung),
            self::K_III => new RotorKIII($ringstellung),
            self::SWISS_K_I => new RotorSwissKI($ringstellung),
            self::SWISS_K_II => new RotorSwissKII($ringstellung),
            self::SWISS_K_III => new RotorSwissKIII($ringstellung),
            self::RAILWAY_I => new RotorRailwayI($ringstellung),
            self::RAILWAY_II => new RotorRailwayII($ringstellung),
            self::RAILWAY_III => new RotorRailwayIII($ringstellung),
            self::TIRPITZ_I => new RotorTirpitzI($ringstellung),
            self::TIRPITZ_II => new RotorTirpitzII($ringstellung),
            self::TIRPITZ_III => new RotorTirpitzIII($ringstellung),
            self::TIRPITZ_IV => new RotorTirpitzIV($ringstellung),
            self::TIRPITZ_V => new RotorTirpitzV($ringstellung),
            self::TIRPITZ_VI => new RotorTirpitzVI($ringstellung),
            self::TIRPITZ_VII => new RotorTirpitzVII($ringstellung),
            self::TIRPITZ_VIII => new RotorTirpitzVIII($ringstellung),
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

    /**
     * Get all Greek rotor types (BETA and GAMMA).
     *
     * @return list<self>
     */
    public static function getGreekRotors(): array
    {
        return [self::BETA, self::GAMMA];
    }

    /**
     * Get all non-Greek rotor types compatible with a given Enigma model.
     *
     * This method dynamically filters rotors based on their getCompatibleModels() method,
     * excluding Greek rotors (Beta/Gamma) which have special positioning rules.
     *
     * @param $model The Enigma model to get compatible rotors for
     *
     * @return list<self> List of compatible non-Greek rotor types
     */
    public static function getCompatibleRotorsForModel(EnigmaModel $model): array
    {
        $compatible = [];

        foreach (self::cases() as $rotorType) {
            // Skip Greek rotors - they're handled separately
            if ($rotorType->isGreekRotor()) {
                continue;
            }

            $rotor = $rotorType->createRotor();
            if ($rotor->isCompatibleWithModel($model)) {
                $compatible[] = $rotorType;
            }
        }

        return $compatible;
    }
}
