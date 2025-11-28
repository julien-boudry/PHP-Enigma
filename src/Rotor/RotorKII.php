<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\{EnigmaModel, Letter, RotorType};

/**
 * Commercial Enigma K Rotor II.
 *
 * Standard commercial wiring (handelsübliche Schaltung).
 * Used in Enigma K (A27) from 1927-1944.
 * Notch at position M (turnover at E).
 */
final class RotorKII extends AbstractRotor
{
    protected static function getWiring(): string
    {
        return 'SLVGBTFXJQOHEWIRZYAMKPCNDU';
    }

    public static function getNotches(): array
    {
        return [Letter::M];
    }

    public static function getCompatibleModels(): array
    {
        return [EnigmaModel::ENIGMA_K];
    }

    public function getType(): RotorType
    {
        return RotorType::K_II;
    }
}
