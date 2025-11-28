<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Rotor;

use JulienBoudry\EnigmaMachine\{EnigmaModel, Letter, RotorType};

/**
 * Rotor VIII for Enigma T (Tirpitz).
 *
 * Used for German-Japanese military communications during WW2.
 * Has 5 notches at positions E, H, K, N, Q.
 */
final class RotorTirpitzVIII extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'YMTPNZHWKODAJXELUQVGCBISFR';
    }

    public static function getNotches(): array
    {
        return [Letter::E, Letter::H, Letter::K, Letter::N, Letter::Q];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::TIRPITZ];
    }

    public function getType(): RotorType
    {
        return RotorType::TIRPITZ_VIII;
    }
}
