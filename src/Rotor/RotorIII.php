<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Rotor;

use JulienBoudry\EnigmaMachine\{EnigmaModel, Letter, RotorType};

/**
 * Rotor III - Available on all Enigma models.
 *
 * Notch at position V (turnover at W).
 */
final class RotorIII extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'BDFHJLCPRTXVZNYEIWGAKMUSQO';
    }

    public static function getNotches(): array
    {
        return [Letter::V];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4];
    }

    public function getType(): RotorType
    {
        return RotorType::III;
    }
}
