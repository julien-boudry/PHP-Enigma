<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\{EnigmaModel, Letter, RotorType};

/**
 * Swiss-K Rotor I (Swiss Air Force wiring).
 *
 * Modified wiring used by the Swiss Army, Air Force, and Foreign Ministry.
 * The Swiss rewired the rotors after receiving the machines from Germany.
 * Notch at position G (turnover at Y).
 */
final class RotorSwissKI extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'PEZUOHXSCVFMTBGLRINQJWAYDK';
    }

    public static function getNotches(): array
    {
        return [Letter::G];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::SWISS_K];
    }

    public function getType(): RotorType
    {
        return RotorType::SWISS_K_I;
    }
}
