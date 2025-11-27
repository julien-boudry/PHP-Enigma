<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Represents the configuration of rotors mounted in an Enigma machine.
 *
 * This class encapsulates the collection of rotors and provides type-safe access
 * to rotors by their position. It also validates that the correct number of rotors
 * is configured for the given Enigma model.
 *
 * @implements \IteratorAggregate<int, EnigmaRotor>
 */
class RotorConfiguration implements \Countable, \IteratorAggregate
{
    /**
     * The mounted rotors indexed by position value.
     *
     * @var array<int, EnigmaRotor>
     */
    private array $rotors = [];

    /**
     * Creates a new rotor configuration.
     *
     * @param EnigmaRotor|null $right The right rotor (P1) - fastest rotating
     * @param EnigmaRotor|null $middle The middle rotor (P2)
     * @param EnigmaRotor|null $left The left rotor (P3) - slowest rotating
     * @param EnigmaRotor|null $greek The Greek rotor (P4) - only for M4 model, never rotates
     */
    public function __construct(
        private ?EnigmaRotor $right = null,
        private ?EnigmaRotor $middle = null,
        private ?EnigmaRotor $left = null,
        private ?EnigmaRotor $greek = null,
    ) {
        if ($this->right !== null) {
            $this->rotors[RotorPosition::P1->value] = $this->right;
        }
        if ($this->middle !== null) {
            $this->rotors[RotorPosition::P2->value] = $this->middle;
        }
        if ($this->left !== null) {
            $this->rotors[RotorPosition::P3->value] = $this->left;
        }
        if ($this->greek !== null) {
            $this->rotors[RotorPosition::GREEK->value] = $this->greek;
        }
    }

    /**
     * Get a rotor by its position.
     *
     * @param RotorPosition $position The position to get
     *
     * @throws \InvalidArgumentException If no rotor is mounted at the given position
     *
     * @return EnigmaRotor The rotor at the given position
     */
    public function get(RotorPosition $position): EnigmaRotor
    {
        if (!isset($this->rotors[$position->value])) {
            throw new \InvalidArgumentException("No rotor mounted at position {$position->name}");
        }

        return $this->rotors[$position->value];
    }

    /**
     * Check if a rotor is mounted at the given position.
     *
     * @param RotorPosition $position The position to check
     *
     * @return bool True if a rotor is mounted
     */
    public function has(RotorPosition $position): bool
    {
        return isset($this->rotors[$position->value]);
    }

    /**
     * Mount a rotor at the given position.
     *
     * @param RotorPosition $position The position to mount at
     * @param EnigmaRotor $rotor The rotor to mount
     *
     * @return self Returns a new configuration with the rotor mounted
     */
    public function withRotor(RotorPosition $position, EnigmaRotor $rotor): self
    {
        $clone = clone $this;
        $clone->rotors[$position->value] = $rotor;

        match ($position) {
            RotorPosition::P1 => $clone->right = $rotor,
            RotorPosition::P2 => $clone->middle = $rotor,
            RotorPosition::P3 => $clone->left = $rotor,
            RotorPosition::GREEK => $clone->greek = $rotor,
        };

        return $clone;
    }

    /**
     * Set a rotor at the given position (mutable).
     *
     * @param RotorPosition $position The position to set
     * @param EnigmaRotor $rotor The rotor to set
     */
    public function set(RotorPosition $position, EnigmaRotor $rotor): void
    {
        $this->rotors[$position->value] = $rotor;

        match ($position) {
            RotorPosition::P1 => $this->right = $rotor,
            RotorPosition::P2 => $this->middle = $rotor,
            RotorPosition::P3 => $this->left = $rotor,
            RotorPosition::GREEK => $this->greek = $rotor,
        };
    }

    /**
     * Get the right rotor (P1) - the fastest rotating rotor.
     *
     * @throws \InvalidArgumentException If no rotor is mounted
     */
    public function getRight(): EnigmaRotor
    {
        return $this->get(RotorPosition::P1);
    }

    /**
     * Get the middle rotor (P2).
     *
     * @throws \InvalidArgumentException If no rotor is mounted
     */
    public function getMiddle(): EnigmaRotor
    {
        return $this->get(RotorPosition::P2);
    }

    /**
     * Get the left rotor (P3) - the slowest rotating rotor.
     *
     * @throws \InvalidArgumentException If no rotor is mounted
     */
    public function getLeft(): EnigmaRotor
    {
        return $this->get(RotorPosition::P3);
    }

    /**
     * Get the Greek rotor (P4) - only available on M4 model.
     *
     * @throws \InvalidArgumentException If no rotor is mounted
     */
    public function getGreek(): EnigmaRotor
    {
        return $this->get(RotorPosition::GREEK);
    }

    /**
     * Check if a Greek rotor is configured (M4 model).
     */
    public function hasGreekRotor(): bool
    {
        return $this->greek !== null;
    }

    /**
     * Get the number of mounted rotors.
     */
    public function count(): int
    {
        return \count($this->rotors);
    }

    /**
     * Validate that the configuration is complete for the given model.
     *
     * @param EnigmaModel $model The model to validate against
     *
     * @throws \InvalidArgumentException If the configuration is invalid for the model
     */
    public function validateForModel(EnigmaModel $model): void
    {
        $expectedCount = match ($model) {
            EnigmaModel::WMLW, EnigmaModel::KMM3 => 3,
            EnigmaModel::KMM4 => 4,
        };

        if ($this->count() !== $expectedCount) {
            throw new \InvalidArgumentException(
                "Model {$model->name} requires exactly {$expectedCount} rotors, {$this->count()} provided"
            );
        }

        if ($model === EnigmaModel::KMM4 && !$this->hasGreekRotor()) {
            throw new \InvalidArgumentException('Model KMM4 requires a Greek rotor');
        }
    }

    /**
     * Iterate over the rotors in order (P1, P2, P3, [GREEK]).
     *
     * @return \Traversable<int, EnigmaRotor>
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->rotors as $position => $rotor) {
            yield $position => $rotor;
        }
    }

    /**
     * Get all rotors as an array indexed by position value.
     *
     * @return array<int, EnigmaRotor>
     */
    public function toArray(): array
    {
        return $this->rotors;
    }

    /**
     * Deep clone all rotors.
     */
    public function __clone(): void
    {
        $clonedRotors = [];
        foreach ($this->rotors as $position => $rotor) {
            $clonedRotors[$position] = clone $rotor;
        }
        $this->rotors = $clonedRotors;

        $this->right = $this->rotors[RotorPosition::P1->value] ?? null;
        $this->middle = $this->rotors[RotorPosition::P2->value] ?? null;
        $this->left = $this->rotors[RotorPosition::P3->value] ?? null;
        $this->greek = $this->rotors[RotorPosition::GREEK->value] ?? null;
    }
}
