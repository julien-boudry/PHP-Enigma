<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Reflector;

use JulienBoudry\Enigma\ReflectorType;

/**
 * Reflector B (Umkehrwalze B).
 *
 * Standard reflector used with Wehrmacht/Luftwaffe and Kriegsmarine M3 models.
 */
final class ReflectorB extends AbstractReflector
{
    protected function getWiring(): string
    {
        return 'YRUHQSLDPXNGOKMIEBFZCWVJAT';
    }

    public function getType(): ReflectorType
    {
        return ReflectorType::B;
    }
}
