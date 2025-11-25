<?php

declare(strict_types=1);

namespace Rafalmasiarek\Enigma;

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
