<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Rotor;

use JulienBoudry\EnigmaMachine\{EnigmaModel, Letter, RotorType};

/**
 * Rotor IV - Available on all Enigma models.
 *
 * Notch at position J (turnover at K).
 */
final class RotorIV extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'ESOVPZJAYQUIRHXLNFTGKDCMWB';
    }

    public static function getNotches(): array
    {
        return [Letter::J];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4];
    }

    public function getType(): RotorType
    {
        return RotorType::IV;
    }
}
