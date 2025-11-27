<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\EnigmaModel;
use JulienBoudry\Enigma\Letter;
use JulienBoudry\Enigma\RotorType;

/**
 * Rotor Gamma - Greek rotor for Kriegsmarine M4 only.
 *
 * This rotor is placed in the leftmost (Greek) position and does not rotate.
 * No notches (never triggers turnover).
 */
final class RotorGamma extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'FSOKANUERHMBTIYCWLQPZXVGJD';
    }

    public static function getNotches(): array
    {
        return [];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::KMM4];
    }

    public function getType(): RotorType
    {
        return RotorType::GAMMA;
    }
}
