<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Reflector;

use JulienBoudry\EnigmaMachine\ReflectorType;

/**
 * Reflector C (Umkehrwalze C).
 *
 * Alternative reflector used with Wehrmacht/Luftwaffe and Kriegsmarine M3 models.
 */
final class ReflectorC extends AbstractReflector
{
    protected function getWiring(): string
    {
        return 'FVPJIAOYEDRZXWGCTKUQSBNMHL';
    }

    public function getType(): ReflectorType
    {
        return ReflectorType::C;
    }
}
