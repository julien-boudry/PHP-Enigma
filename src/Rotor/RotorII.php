<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\{EnigmaModel, Letter, RotorType};

/**
 * Rotor II - Available on all Enigma models.
 *
 * Notch at position E (turnover at F).
 */
final class RotorII extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'AJDKSIRUXBLHWTMCQGZNPYFVOE';
    }

    public static function getNotches(): array
    {
        return [Letter::E];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4];
    }

    public function getType(): RotorType
    {
        return RotorType::II;
    }
}
