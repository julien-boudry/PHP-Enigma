<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Reflector;

use JulienBoudry\Enigma\ReflectorType;

/**
 * Enigma T (Tirpitz) Reflector (Umkehrwalze).
 *
 * The Enigma T was used for German-Japanese military communications during WW2.
 * It has a unique reflector wiring and uses the Tirpitz entry wheel.
 *
 * @see https://www.cryptomuseum.com/crypto/enigma/t/index.htm
 */
final class ReflectorTirpitz extends AbstractReflector
{
    protected function getWiring(): string
    {
        return 'GEKPBTAUMOCNILJDXZYFHWVQSR';
    }

    public function getType(): ReflectorType
    {
        return ReflectorType::TIRPITZ;
    }
}
