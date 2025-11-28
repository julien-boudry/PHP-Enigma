<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\{EnigmaModel, Letter, RotorType};

/**
 * Railway Enigma (Rocket) Rotor II.
 *
 * Rewired rotor used by the German Reichsbahn (Railway).
 * Wiring recovered in 2023 from Enigma K serial number K438.
 * Notch at position M (turnover at E).
 *
 * @see https://www.cryptomuseum.com/crypto/enigma/k/railway.htm
 */
final class RotorRailwayII extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'HXMQKGJTSCZFLBERNAWYIDOVPU';
    }

    public static function getNotches(): array
    {
        return [Letter::M];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::RAILWAY];
    }

    public function getType(): RotorType
    {
        return RotorType::RAILWAY_II;
    }
}
