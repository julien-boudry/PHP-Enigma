<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Rotor;

use JulienBoudry\EnigmaMachine\{EnigmaModel, Letter, RotorType};

/**
 * Railway Enigma (Rocket) Rotor I.
 *
 * Rewired rotor used by the German Reichsbahn (Railway).
 * Wiring recovered in 2023 from Enigma K serial number K438.
 * Notch at position G (turnover at Y).
 *
 * @see https://www.cryptomuseum.com/crypto/enigma/k/railway.htm
 */
final class RotorRailwayI extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'EVLPKUDJHTGSZFRABWYICOXNMQ';
    }

    public static function getNotches(): array
    {
        return [Letter::G];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::RAILWAY];
    }

    public function getType(): RotorType
    {
        return RotorType::RAILWAY_I;
    }
}
