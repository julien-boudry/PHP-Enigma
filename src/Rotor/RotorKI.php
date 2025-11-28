<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Rotor;

use JulienBoudry\EnigmaMachine\{EnigmaModel, Letter, RotorType};

/**
 * Commercial Enigma K Rotor I.
 *
 * Standard commercial wiring (handelsübliche Schaltung).
 * Used in Enigma K (A27) from 1927-1944.
 * Notch at position G (turnover at Y).
 */
final class RotorKI extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'LPGSZMHAEOQKVXRFYBUTNICJDW';
    }

    public static function getNotches(): array
    {
        return [Letter::G];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::ENIGMA_K];
    }

    public function getType(): RotorType
    {
        return RotorType::K_I;
    }
}
