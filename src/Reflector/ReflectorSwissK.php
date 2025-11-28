<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Reflector;

use JulienBoudry\Enigma\ReflectorType;

/**
 * Swiss-K Reflector (Umkehrwalze).
 *
 * The Swiss used the same reflector wiring as the commercial Enigma K.
 * They only modified the rotor wirings for additional security.
 *
 * @see https://www.cryptomuseum.com/crypto/enigma/k/swiss.htm
 */
final class ReflectorSwissK extends AbstractReflector
{
    protected function getWiring(): string
    {
        // Same wiring as commercial K
        return 'IMETCGFRAYSQBZXWLHKDVUPOJN';
    }

    public function getType(): ReflectorType
    {
        return ReflectorType::SWISS_K;
    }
}
