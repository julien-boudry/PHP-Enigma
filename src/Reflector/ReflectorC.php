<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Reflector;

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
}
