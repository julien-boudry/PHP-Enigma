<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine;

use JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;

/**
 * Represents an Enigma machine configuration.
 *
 * This immutable value object holds all the configuration parameters
 * needed to set up an Enigma machine. It can be created from scratch,
 * generated randomly, or extracted from an existing Enigma machine.
 */
final readonly class EnigmaConfiguration
{
    /**
     * @param $model The Enigma model
     * @param array<string, RotorType> $rotorTypes Rotor types keyed by position (p1, p2, p3, greek)
     * @param array<string, Letter> $ringstellungen Ring settings keyed by position
     * @param array<string, Letter> $positions Initial positions keyed by position
     * @param $reflector The reflector type
     * @param list<array{Letter, Letter}> $plugboardPairs Plugboard letter pairs
     * @param list<array{Letter, Letter}>|null $doraWiringPairs Custom DORA wiring pairs (13 pairs), null for default
     */
    public function __construct(
        public EnigmaModel $model,
        public array $rotorTypes,
        public array $ringstellungen,
        public array $positions,
        public ReflectorType $reflector,
        public array $plugboardPairs,
        public ?array $doraWiringPairs = null,
    ) {}

    /**
     * Create a configuration from an existing Enigma machine.
     *
     * Extracts the current state of the Enigma machine including
     * rotor types, ring settings, positions, reflector, and plugboard.
     *
     * @param $enigma The Enigma machine to extract configuration from
     *
     * @return self The extracted configuration
     */
    public static function fromEnigma(Enigma $enigma): self
    {
        $rotorTypes = [
            'p1' => $enigma->rotors->getP1()->getType(),
            'p2' => $enigma->rotors->getP2()->getType(),
            'p3' => $enigma->rotors->getP3()->getType(),
        ];

        $ringstellungen = [
            'p1' => $enigma->rotors->getP1()->getRingstellung(),
            'p2' => $enigma->rotors->getP2()->getRingstellung(),
            'p3' => $enigma->rotors->getP3()->getRingstellung(),
        ];

        $positions = [
            'p1' => $enigma->getPosition(RotorPosition::P1),
            'p2' => $enigma->getPosition(RotorPosition::P2),
            'p3' => $enigma->getPosition(RotorPosition::P3),
        ];

        if ($enigma->rotors->hasGreekRotor()) {
            $rotorTypes['greek'] = $enigma->rotors->getGreek()->getType();
            $ringstellungen['greek'] = $enigma->rotors->getGreek()->getRingstellung();
            $positions['greek'] = $enigma->getPosition(RotorPosition::GREEK);
        }

        // Extract DORA wiring if applicable
        $doraWiringPairs = null;
        if ($enigma->reflector instanceof ReflectorDora) {
            $doraWiringPairs = $enigma->reflector->getWiringPairs();
        }

        // Extract plugboard pairs (only for military models with plugboard)
        $plugboardPairs = $enigma->plugboard->getPluggedPairs();

        return new self(
            model: $enigma->model,
            rotorTypes: $rotorTypes,
            ringstellungen: $ringstellungen,
            positions: $positions,
            reflector: $enigma->reflector->getType(),
            plugboardPairs: $plugboardPairs,
            doraWiringPairs: $doraWiringPairs,
        );
    }

    /**
     * Create a RotorConfiguration from this configuration.
     */
    public function createRotorConfiguration(): RotorConfiguration
    {
        $args = [
            'p1' => $this->rotorTypes['p1'],
            'p2' => $this->rotorTypes['p2'],
            'p3' => $this->rotorTypes['p3'],
            'ringstellungP1' => $this->ringstellungen['p1'],
            'ringstellungP2' => $this->ringstellungen['p2'],
            'ringstellungP3' => $this->ringstellungen['p3'],
        ];

        if (isset($this->rotorTypes['greek'])) {
            $args['greek'] = $this->rotorTypes['greek'];
            $args['ringstellungGreek'] = $this->ringstellungen['greek'];
        }

        return new RotorConfiguration(...$args);
    }

    /**
     * Create and configure a complete Enigma machine from this configuration.
     */
    public function createEnigma(): Enigma
    {
        $enigma = new Enigma(
            model: $this->model,
            rotors: $this->createRotorConfiguration(),
            reflector: $this->reflector,
        );

        // Mount custom DORA reflector if wiring pairs are specified
        if ($this->doraWiringPairs !== null) {
            $pairs = [];
            foreach ($this->doraWiringPairs as [$letter1, $letter2]) {
                $pairs[$letter1->toChar()] = $letter2->toChar();
            }
            $enigma->mountReflector(new ReflectorDora($pairs));
        }

        // Set initial positions
        $enigma->setPosition(RotorPosition::P1, $this->positions['p1']);
        $enigma->setPosition(RotorPosition::P2, $this->positions['p2']);
        $enigma->setPosition(RotorPosition::P3, $this->positions['p3']);

        if (isset($this->positions['greek'])) {
            $enigma->setPosition(RotorPosition::GREEK, $this->positions['greek']);
        }

        // Configure plugboard (only for military models with plugboard)
        if ($enigma->hasPlugboard()) {
            foreach ($this->plugboardPairs as [$letter1, $letter2]) {
                $enigma->plugLetters($letter1, $letter2);
            }
        }

        return $enigma;
    }

    /**
     * Get a human-readable summary of the configuration.
     */
    public function getSummary(): string
    {
        $rotors = implode('-', array_map(
            static fn(RotorType $r): string => $r->name,
            [$this->rotorTypes['p3'], $this->rotorTypes['p2'], $this->rotorTypes['p1']]
        ));

        if (isset($this->rotorTypes['greek'])) {
            $rotors = $this->rotorTypes['greek']->name . '-' . $rotors;
        }

        $ringstellung = $this->ringstellungen['p3']->toChar()
            . $this->ringstellungen['p2']->toChar()
            . $this->ringstellungen['p1']->toChar();

        if (isset($this->ringstellungen['greek'])) {
            $ringstellung = $this->ringstellungen['greek']->toChar() . $ringstellung;
        }

        $position = $this->positions['p3']->toChar()
            . $this->positions['p2']->toChar()
            . $this->positions['p1']->toChar();

        if (isset($this->positions['greek'])) {
            $position = $this->positions['greek']->toChar() . $position;
        }

        $summary = \sprintf(
            'Model: %s | Rotors: %s | Ring: %s | Position: %s | Reflector: %s',
            $this->model->name,
            $rotors,
            $ringstellung,
            $position,
            $this->reflector->name
        );

        // Only show plugboard for military models
        if ($this->model->hasPlugboard()) {
            $plugs = implode(' ', array_map(
                static fn(array $pair): string => $pair[0]->toChar() . $pair[1]->toChar(),
                $this->plugboardPairs
            ));
            $summary .= ' | Plugs: ' . ($plugs ?: '(none)');
        }

        return $summary;
    }
}
