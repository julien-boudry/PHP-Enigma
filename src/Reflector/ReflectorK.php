<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Reflector;

use JulienBoudry\Enigma\ReflectorType;

/**
 * Commercial Enigma K (A27) Reflector (Umkehrwalze).
 *
 * Standard commercial wiring (handelsübliche Schaltung).
 * Also used by Swiss-K (the Swiss only rewired the rotors, not the reflector).
 *
 * Note: The commercial models use QWERTZ entry wheel, but the reflector wiring
 * is measured relative to the entry wheel contacts.
 *
 * @see https://www.cryptomuseum.com/crypto/enigma/k/index.htm
 */
final class ReflectorK extends AbstractReflector
{
    protected function getWiring(): string
    {
        return 'IMETCGFRAYSQBZXWLHKDVUPOJN';
    }

    public function getType(): ReflectorType
    {
        return ReflectorType::K;
    }
}
