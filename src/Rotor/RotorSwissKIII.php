<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\{EnigmaModel, Letter, RotorType};

/**
 * Swiss-K Rotor III (Swiss Air Force wiring).
 *
 * Modified wiring used by the Swiss Army, Air Force, and Foreign Ministry.
 * The Swiss rewired the rotors after receiving the machines from Germany.
 * Notch at position V (turnover at N).
 */
final class RotorSwissKIII extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'EHRVXGAOBQUSIMZFLYNWKTPDJC';
    }

    public static function getNotches(): array
    {
        return [Letter::V];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::SWISS_K];
    }

    public function getType(): RotorType
    {
        return RotorType::SWISS_K_III;
    }
}
