<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\EnigmaModel;
use JulienBoudry\Enigma\Letter;
use JulienBoudry\Enigma\RotorType;

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
