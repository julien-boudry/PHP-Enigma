<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

use JulienBoudry\Enigma\Rotor\AbstractRotor;

/**
 * Represents the configuration of rotors for an Enigma machine.
 *
 * This class encapsulates the collection of rotors and provides type-safe access
 * to rotors by their position. It accepts either RotorType enums (which will be
 * converted to AbstractRotor instances) or pre-configured AbstractRotor objects.
 *
 * @implements \IteratorAggregate<RotorPosition, AbstractRotor>
 */
class RotorConfiguration implements \Countable, \IteratorAggregate
{
    /**
     * The mounted rotors indexed by position value.
     *
     * @var array<int, AbstractRotor>
     */
    private array $rotors = [];

    /**
     * Creates a new rotor configuration.
     *
     * Each rotor can be specified as:
     * - A RotorType enum (will be created with the corresponding ringstellung parameter)
     * - An AbstractRotor instance (for pre-configured rotors, ringstellung parameter is ignored)
     *
     * @param RotorType|AbstractRotor $p1 Position 1 rotor (rightmost, fastest rotating)
     * @param RotorType|AbstractRotor $p2 Position 2 rotor (middle)
     * @param RotorType|AbstractRotor $p3 Position 3 rotor (leftmost in 3-rotor models)
     * @param RotorType|AbstractRotor|null $greek Greek position rotor (M4 only, never rotates)
     * @param Letter $ringstellungP1 Ring setting for P1 rotor (only used if $p1 is RotorType)
     * @param Letter $ringstellungP2 Ring setting for P2 rotor (only used if $p2 is RotorType)
     * @param Letter $ringstellungP3 Ring setting for P3 rotor (only used if $p3 is RotorType)
     * @param Letter $ringstellungGreek Ring setting for Greek rotor (only used if $greek is RotorType)
     */
    public function __construct(
        RotorType|AbstractRotor $p1,
        RotorType|AbstractRotor $p2,
        RotorType|AbstractRotor $p3,
        RotorType|AbstractRotor|null $greek = null,
        Letter $ringstellungP1 = Letter::A,
        Letter $ringstellungP2 = Letter::A,
        Letter $ringstellungP3 = Letter::A,
        Letter $ringstellungGreek = Letter::A,
    ) {
        $this->rotors[RotorPosition::P1->value] = $this->resolveRotor($p1, $ringstellungP1);
        $this->rotors[RotorPosition::P2->value] = $this->resolveRotor($p2, $ringstellungP2);
        $this->rotors[RotorPosition::P3->value] = $this->resolveRotor($p3, $ringstellungP3);

        if ($greek !== null) {
            $this->rotors[RotorPosition::GREEK->value] = $this->resolveRotor($greek, $ringstellungGreek);
        }

        $this->validateNoDuplicates();
        $this->validateGreekRotorPosition();
    }

    /**
     * Resolve a rotor parameter to an AbstractRotor instance.
     */
    private function resolveRotor(RotorType|AbstractRotor $rotor, Letter $ringstellung): AbstractRotor
    {
        if ($rotor instanceof AbstractRotor) {
            return $rotor;
        }

        return $rotor->createRotor($ringstellung);
    }

    /**
     * Validate that no rotor type is used more than once.
     *
     * @throws \InvalidArgumentException If a rotor type is duplicated
     */
    private function validateNoDuplicates(): void
    {
        $types = [];
        foreach ($this->rotors as $rotor) {
            $type = $rotor->getType();

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
                throw new \InvalidArgumentException(
                    "Only Greek rotors (BETA/GAMMA) can be mounted in the GREEK position, not {$greekRotor->getType()->name}"
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
     * @return AbstractRotor The rotor at the given position
     */
    public function get(RotorPosition $position): AbstractRotor
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
     * @param RotorType|AbstractRotor $rotor The rotor to mount
     * @param Letter $ringstellung The ring setting (only used if $rotor is RotorType)
     *
     * @throws \InvalidArgumentException If the rotor type is already used or incompatible with position
     */
    public function mountRotor(RotorPosition $position, RotorType|AbstractRotor $rotor, Letter $ringstellung = Letter::A): void
    {
        $newRotor = $this->resolveRotor($rotor, $ringstellung);

        // Validate Greek rotor position
        if ($position === RotorPosition::GREEK && !$newRotor->isGreekRotor()) {
            throw new \InvalidArgumentException(
                "Only Greek rotors (BETA/GAMMA) can be mounted in the GREEK position, not {$newRotor->getType()->name}"
            );
        }

        if ($position !== RotorPosition::GREEK && $newRotor->isGreekRotor()) {
            throw new \InvalidArgumentException(
                "Greek rotors (BETA/GAMMA) can only be mounted in the GREEK position, not {$position->name}"
            );
        }

        // Validate no duplicates (excluding the position being replaced)
        $newType = $newRotor->getType();
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

        $this->rotors[$position->value] = $newRotor;
    }

    /**
     * Get the P1 rotor (rightmost, fastest rotating).
     *
     * @throws \InvalidArgumentException If no rotor is mounted
     */
    public function getP1(): AbstractRotor
    {
        return $this->get(RotorPosition::P1);
    }

    /**
     * Get the P2 rotor (middle).
     *
     * @throws \InvalidArgumentException If no rotor is mounted
     */
    public function getP2(): AbstractRotor
    {
        return $this->get(RotorPosition::P2);
    }

    /**
     * Get the P3 rotor (leftmost in 3-rotor models).
     *
     * @throws \InvalidArgumentException If no rotor is mounted
     */
    public function getP3(): AbstractRotor
    {
        return $this->get(RotorPosition::P3);
    }

    /**
     * Get the Greek rotor (M4 only, never rotates).
     *
     * @throws \InvalidArgumentException If no rotor is mounted
     */
    public function getGreek(): AbstractRotor
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
                $positionName = RotorPosition::from($position)->name;

                throw new \InvalidArgumentException(
                    "Rotor {$rotor->getType()->name} at position {$positionName} is not compatible with model {$model->name}"
                );
            }
        }
    }

    /**
     * Iterate over the rotors in order (P1, P2, P3, [GREEK]).
     *
     * @return \Traversable<RotorPosition, AbstractRotor>
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
     * @return array<int, AbstractRotor>
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
