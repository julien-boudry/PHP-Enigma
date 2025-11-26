<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Immutable configuration data for rotors and reflectors.
 *
 * This class stores the wiring configuration, compatible Enigma models,
 * and notch positions for a specific rotor or reflector type.
 * It is used to initialize the available components of an Enigma machine.
 */
readonly class EnigmaSetup
{
    /**
     * @param array<int, EnigmaModel> $used
     * @param array<int>|null $notches
     */
    public function __construct(
        public ReflectorType|RotorType $reflectorType,
        public string $wiring,
        public array $used,
        public ?array $notches = null
    ) {}
}
