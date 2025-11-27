<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Represents a selection of rotor types for an Enigma machine.
 *
 * This class encapsulates the choice of which rotors to use in each position
 * before they are actually mounted in the machine. It provides type-safe
 * access to rotor types by their position.
 *
 * @implements \IteratorAggregate<RotorPosition, RotorType>
 */
readonly class RotorSelection implements \Countable, \IteratorAggregate
{
    /**
     * Creates a new rotor selection.
     *
     * @param RotorType $right The right rotor type (P1) - fastest rotating
     * @param RotorType $middle The middle rotor type (P2)
     * @param RotorType $left The left rotor type (P3) - slowest rotating
     * @param RotorType|null $greek The Greek rotor type (P4) - only for M4 model, never rotates
     */
    public function __construct(
        public RotorType $right,
        public RotorType $middle,
        public RotorType $left,
        public ?RotorType $greek = null,
    ) {}

    /**
     * Get a rotor type by its position.
     *
     * @param RotorPosition $position The position to get
     *
     * @throws \InvalidArgumentException If no rotor is selected for the given position
     *
     * @return RotorType The rotor type at the given position
     */
    public function get(RotorPosition $position): RotorType
    {
        return match ($position) {
            RotorPosition::P1 => $this->right,
            RotorPosition::P2 => $this->middle,
            RotorPosition::P3 => $this->left,
            RotorPosition::GREEK => $this->greek ?? throw new \InvalidArgumentException(
                "No rotor selected for position {$position->name}"
            ),
        };
    }

    /**
     * Check if a rotor is selected for the given position.
     *
     * @param RotorPosition $position The position to check
     *
     * @return bool True if a rotor is selected
     */
    public function has(RotorPosition $position): bool
    {
        return match ($position) {
            RotorPosition::P1, RotorPosition::P2, RotorPosition::P3 => true,
            RotorPosition::GREEK => $this->greek !== null,
        };
    }

    /**
     * Check if a Greek rotor is selected (M4 model).
     */
    public function hasGreekRotor(): bool
    {
        return $this->greek !== null;
    }

    /**
     * Get the number of selected rotors.
     */
    public function count(): int
    {
        return $this->greek !== null ? 4 : 3;
    }

    /**
     * Validate that the selection is valid for the given model.
     *
     * @param EnigmaModel $model The model to validate against
     *
     * @throws \InvalidArgumentException If the selection is invalid for the model
     */
    public function validateForModel(EnigmaModel $model): void
    {
        $expectedCount = $model->getExpectedRotorCount();

        if ($this->count() !== $expectedCount) {
            throw new \InvalidArgumentException(
                "Model {$model->name} requires exactly {$expectedCount} rotors, {$this->count()} provided"
            );
        }

        if ($model->requiresGreekRotor() && !$this->hasGreekRotor()) {
            throw new \InvalidArgumentException("Model {$model->name} requires a Greek rotor");
        }
    }

    /**
     * Iterate over the rotor types in order (P1, P2, P3, [GREEK]).
     *
     * @return \Traversable<RotorPosition, RotorType>
     */
    public function getIterator(): \Traversable
    {
        yield RotorPosition::P1 => $this->right;
        yield RotorPosition::P2 => $this->middle;
        yield RotorPosition::P3 => $this->left;

        if ($this->greek !== null) {
            yield RotorPosition::GREEK => $this->greek;
        }
    }
}
