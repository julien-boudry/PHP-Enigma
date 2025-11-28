<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Rotor;

use JulienBoudry\EnigmaMachine\{EnigmaModel, Letter, RotorType};

/**
 * Rotor I - Available on all Enigma models.
 *
 * Notch at position Q (turnover at R).
 */
final class RotorI extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'EKMFLGDQVZNTOWYHXUSPAIBRCJ';
    }

    public static function getNotches(): array
    {
        return [Letter::Q];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4];
    }

    public function getType(): RotorType
    {
        return RotorType::I;
    }
}
