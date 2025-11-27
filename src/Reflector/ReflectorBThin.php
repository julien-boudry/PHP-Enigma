<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Reflector;

use JulienBoudry\Enigma\ReflectorType;

/**
 * Reflector B Thin (Umkehrwalze B Dünn).
 *
 * Thin reflector used exclusively with the Kriegsmarine M4 model.
 * The thin design allows space for the fourth rotor.
 */
final class ReflectorBThin extends AbstractReflector
{
    protected function getWiring(): string
    {
        return 'ENKQAUYWJICOPBLMDXZVFTHRGS';
    }

    public function getType(): ReflectorType
    {
        return ReflectorType::BTHIN;
    }
}
