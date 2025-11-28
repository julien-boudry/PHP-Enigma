<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Reflector;

use JulienBoudry\EnigmaMachine\ReflectorType;

/**
 * Railway Enigma (Rocket) Reflector (Umkehrwalze).
 *
 * Rewired reflector used by the German Reichsbahn (Railway).
 * Wiring recovered in 2023 from physical measurement of UKW K456.
 *
 * @see https://www.cryptomuseum.com/crypto/enigma/k/railway.htm
 */
final class ReflectorRailway extends AbstractReflector
{
    protected function getWiring(): string
    {
        return 'DNSAJQIPGEXRWBVHFLCZYOMKUT';
    }

    public function getType(): ReflectorType
    {
        return ReflectorType::RAILWAY;
    }
}
