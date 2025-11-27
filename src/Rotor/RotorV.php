<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\{EnigmaModel, Letter, RotorType};

/**
 * Rotor V - Available on all Enigma models.
 *
 * Notch at position Z (turnover at A).
 */
final class RotorV extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'VZBRGITYUPSDNHLXAWMJQOFECK';
    }

    public static function getNotches(): array
    {
        return [Letter::Z];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4];
    }

    public function getType(): RotorType
    {
        return RotorType::V;
    }
}
