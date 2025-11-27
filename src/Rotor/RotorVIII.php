<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\{EnigmaModel, Letter, RotorType};

/**
 * Rotor VIII - Available on Kriegsmarine M3 and M4 only.
 *
 * Double notch at positions M and Z (turnovers at N and A).
 */
final class RotorVIII extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'FKQHTLXOCBJSPDZRAMEWNIUYGV';
    }

    public static function getNotches(): array
    {
        return [Letter::M, Letter::Z];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::KMM3, EnigmaModel::KMM4];
    }

    public function getType(): RotorType
    {
        return RotorType::VIII;
    }
}
