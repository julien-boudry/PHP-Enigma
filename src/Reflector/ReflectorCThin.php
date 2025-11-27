<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Reflector;

/**
 * Reflector C Thin (Umkehrwalze C Dünn).
 *
 * Thin reflector used exclusively with the Kriegsmarine M4 model.
 * The thin design allows space for the fourth rotor.
 */
final class ReflectorCThin extends AbstractReflector
{
    protected function getWiring(): string
    {
        return 'RDOBJNTKVEHMLFCWZAXGYIPSUQ';
    }
}
