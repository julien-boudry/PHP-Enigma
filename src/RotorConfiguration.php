<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Represents the configuration of rotors for an Enigma machine.
 *
 * This class encapsulates the collection of rotors and provides type-safe access
 * to rotors by their position. It accepts either RotorType enums (which will be
 * converted to EnigmaRotor instances) or pre-configured EnigmaRotor objects.
 *
 * @implements \IteratorAggregate<RotorPosition, EnigmaRotor>
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
     * Each rotor can be specified as:
     * - A RotorType enum (will be created with the corresponding ringstellung parameter)
     * - An EnigmaRotor instance (for pre-configured rotors, ringstellung parameter is ignored)
     *
     * @param RotorType|EnigmaRotor $right The right rotor (P1) - fastest rotating
     * @param RotorType|EnigmaRotor $middle The middle rotor (P2)
     * @param RotorType|EnigmaRotor $left The left rotor (P3) - slowest rotating
     * @param RotorType|EnigmaRotor|null $greek The Greek rotor (P4) - only for M4 model, never rotates
     * @param Letter $ringstellungRight The ring setting for the right rotor (only used if $right is RotorType)
     * @param Letter $ringstellungMiddle The ring setting for the middle rotor (only used if $middle is RotorType)
     * @param Letter $ringstellungLeft The ring setting for the left rotor (only used if $left is RotorType)
     * @param Letter $ringstellungGreek The ring setting for the Greek rotor (only used if $greek is RotorType)
     */
    public function __construct(
        RotorType|EnigmaRotor $right,
        RotorType|EnigmaRotor $middle,
        RotorType|EnigmaRotor $left,
        RotorType|EnigmaRotor|null $greek = null,
        Letter $ringstellungRight = Letter::A,
        Letter $ringstellungMiddle = Letter::A,
        Letter $ringstellungLeft = Letter::A,
        Letter $ringstellungGreek = Letter::A,
    ) {
        $this->rotors[RotorPosition::P1->value] = $this->resolveRotor($right, $ringstellungRight);
        $this->rotors[RotorPosition::P2->value] = $this->resolveRotor($middle, $ringstellungMiddle);
        $this->rotors[RotorPosition::P3->value] = $this->resolveRotor($left, $ringstellungLeft);

        if ($greek !== null) {
            $this->rotors[RotorPosition::GREEK->value] = $this->resolveRotor($greek, $ringstellungGreek);
        }

        $this->validateNoDuplicates();
        $this->validateGreekRotorPosition();
    }

    /**
     * Resolve a rotor parameter to an EnigmaRotor instance.
     */
    private function resolveRotor(RotorType|EnigmaRotor $rotor, Letter $ringstellung): EnigmaRotor
    {
        if ($rotor instanceof EnigmaRotor) {
            return $rotor;
        }

        return EnigmaRotor::fromType($rotor, $ringstellung);
    }

    /**
     * Validate that no rotor type is used more than once.
     *
     * @throws \InvalidArgumentException If a rotor type is duplicated
     */
    private function validateNoDuplicates(): void
    {
        $types = [];
        foreach ($this->rotors as $position => $rotor) {
            $type = $rotor->getType();
            if ($type === null) {
                continue; // Custom rotors can be duplicated
            }

            if (\in_array($type, $types, true)) {
                throw new \InvalidArgumentException(
                    "Rotor {$type->name} is already mounted in another position. Each rotor can only be used once."
                );
            }
            $types[] = $type;
        }
    }

    /**
     * Validate that Greek rotors (BETA/GAMMA) are only in GREEK position
     * and non-Greek rotors are not in GREEK position.
     *
     * @throws \InvalidArgumentException If a rotor is in an invalid position
     */
    private function validateGreekRotorPosition(): void
    {
        // Check that BETA/GAMMA are only in GREEK position
        foreach ([RotorPosition::P1, RotorPosition::P2, RotorPosition::P3] as $position) {
            if (!isset($this->rotors[$position->value])) {
                continue;
            }
            $rotor = $this->rotors[$position->value];
            if ($rotor->isGreekRotor()) {
                throw new \InvalidArgumentException(
                    "Greek rotors (BETA/GAMMA) can only be mounted in the GREEK position, not {$position->name}"
                );
            }
        }

        // Check that non-Greek rotors are not in GREEK position
        if (isset($this->rotors[RotorPosition::GREEK->value])) {
            $greekRotor = $this->rotors[RotorPosition::GREEK->value];
            if (!$greekRotor->isGreekRotor()) {
                $type = $greekRotor->getType();
                $typeName = $type !== null ? $type->name : 'custom';
                throw new \InvalidArgumentException(
                    "Only Greek rotors (BETA/GAMMA) can be mounted in the GREEK position, not {$typeName}"
                );
            }
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
     * Mount a rotor at the given position, replacing any existing rotor.
     *
     * @param RotorPosition $position The position to mount the rotor
     * @param RotorType|EnigmaRotor $rotor The rotor to mount
     * @param Letter $ringstellung The ring setting (only used if $rotor is RotorType)
     *
     * @throws \InvalidArgumentException If the rotor type is already used or incompatible with position
     */
    public function mountRotor(RotorPosition $position, RotorType|EnigmaRotor $rotor, Letter $ringstellung = Letter::A): void
    {
        $newRotor = $this->resolveRotor($rotor, $ringstellung);

        // Validate Greek rotor position
        if ($position === RotorPosition::GREEK && !$newRotor->isGreekRotor()) {
            $type = $newRotor->getType();
            $typeName = $type !== null ? $type->name : 'custom';
            throw new \InvalidArgumentException(
                "Only Greek rotors (BETA/GAMMA) can be mounted in the GREEK position, not {$typeName}"
            );
        }

        if ($position !== RotorPosition::GREEK && $newRotor->isGreekRotor()) {
            throw new \InvalidArgumentException(
                "Greek rotors (BETA/GAMMA) can only be mounted in the GREEK position, not {$position->name}"
            );
        }

        // Validate no duplicates (excluding the position being replaced)
        $newType = $newRotor->getType();
        if ($newType !== null) {
            foreach ($this->rotors as $pos => $existingRotor) {
                if ($pos === $position->value) {
                    continue; // Skip the position we're replacing
                }
                if ($existingRotor->getType() === $newType) {
                    throw new \InvalidArgumentException(
                        "Rotor {$newType->name} is already mounted in another position. Each rotor can only be used once."
                    );
                }
            }
        }

        $this->rotors[$position->value] = $newRotor;
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
        return $this->has(RotorPosition::GREEK);
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
        $expectedCount = $model->getExpectedRotorCount();

        if ($this->count() !== $expectedCount) {
            throw new \InvalidArgumentException(
                "Model {$model->name} requires exactly {$expectedCount} rotors, {$this->count()} provided"
            );
        }

        if ($model->requiresGreekRotor() && !$this->hasGreekRotor()) {
            throw new \InvalidArgumentException("Model {$model->name} requires a Greek rotor");
        }

        // Validate each rotor is compatible with the model
        foreach ($this->rotors as $position => $rotor) {
            if (!$rotor->isCompatibleWithModel($model)) {
                $type = $rotor->getType();
                $typeName = $type !== null ? $type->name : 'custom';
                $positionName = RotorPosition::from($position)->name;
                throw new \InvalidArgumentException(
                    "Rotor {$typeName} at position {$positionName} is not compatible with model {$model->name}"
                );
            }
        }
    }

    /**
     * Iterate over the rotors in order (P1, P2, P3, [GREEK]).
     *
     * @return \Traversable<RotorPosition, EnigmaRotor>
     */
    public function getIterator(): \Traversable
    {
        yield RotorPosition::P1 => $this->rotors[RotorPosition::P1->value];
        yield RotorPosition::P2 => $this->rotors[RotorPosition::P2->value];
        yield RotorPosition::P3 => $this->rotors[RotorPosition::P3->value];

        if ($this->hasGreekRotor()) {
            yield RotorPosition::GREEK => $this->rotors[RotorPosition::GREEK->value];
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
    }
}
