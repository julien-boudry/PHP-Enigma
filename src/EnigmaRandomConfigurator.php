<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

use Random\{Engine, Randomizer};
use Random\Engine\Secure;

/**
 * Generates random configurations for Enigma machines.
 *
 * This class provides methods to generate cryptographically secure random
 * configurations compatible with specific Enigma models. For testing purposes,
 * a deterministic random engine can be injected.
 *
 * Generated configurations include:
 * - Random rotor selection and order (compatible with model)
 * - Random ring settings (Ringstellung) for each rotor
 * - Random initial rotor positions (Grundstellung)
 * - Random plugboard connections (10 pairs, as per historical practice)
 * - Random reflector (compatible with model)
 */
final class EnigmaRandomConfigurator
{
    private Randomizer $randomizer;

    /**
     * Number of plugboard pairs (historical standard).
     */
    private const int PLUGBOARD_PAIRS = 10;

    /**
     * Create a new random configurator.
     *
     * @param Engine|null $engine Random engine to use. If null, uses cryptographically secure randomness.
     */
    public function __construct(?Engine $engine = null)
    {
        $this->randomizer = new Randomizer($engine ?? new Secure);
    }

    /**
     * Generate a complete random Enigma configuration for a model.
     *
     * @param EnigmaModel $model The Enigma model to configure
     *
     * @return EnigmaConfiguration The random configuration
     */
    public function generate(EnigmaModel $model): EnigmaConfiguration
    {
        $rotorTypes = $this->selectRandomRotors($model);
        $ringstellungen = $this->generateRandomRingstellungen($model);
        $positions = $this->generateRandomPositions($model);
        $reflector = $this->selectRandomReflector($model);

        // Generate plugboard pairs only for military models
        $plugboardPairs = $model->hasPlugboard()
            ? $this->generateRandomPlugboardPairs()
            : [];

        // Generate DORA wiring if DORA reflector is selected
        $doraWiringPairs = $reflector === ReflectorType::DORA
            ? $this->generateRandomDoraWiring()
            : null;

        return new EnigmaConfiguration(
            model: $model,
            rotorTypes: $rotorTypes,
            ringstellungen: $ringstellungen,
            positions: $positions,
            reflector: $reflector,
            plugboardPairs: $plugboardPairs,
            doraWiringPairs: $doraWiringPairs,
        );
    }

    /**
     * Select random rotors compatible with the model.
     *
     * @return array<string, RotorType> Keyed by position name (p1, p2, p3, greek)
     */
    private function selectRandomRotors(EnigmaModel $model): array
    {
        $availableRotors = $this->getAvailableRotors($model);
        $selectedKeys = $this->randomizer->pickArrayKeys($availableRotors, 3);

        $result = [
            'p1' => $availableRotors[$selectedKeys[0]],
            'p2' => $availableRotors[$selectedKeys[1]],
            'p3' => $availableRotors[$selectedKeys[2]],
        ];

        if ($model->requiresGreekRotor()) {
            $greekRotors = RotorType::getGreekRotors();
            $result['greek'] = $greekRotors[$this->randomizer->pickArrayKeys($greekRotors, 1)[0]];
        }

        return $result;
    }

    /**
     * Get available non-Greek rotors for a model.
     *
     * @return list<RotorType>
     */
    private function getAvailableRotors(EnigmaModel $model): array
    {
        return match ($model) {
            EnigmaModel::WMLW => [RotorType::I, RotorType::II, RotorType::III, RotorType::IV, RotorType::V],
            EnigmaModel::KMM3, EnigmaModel::KMM4 => [
                RotorType::I, RotorType::II, RotorType::III, RotorType::IV,
                RotorType::V, RotorType::VI, RotorType::VII, RotorType::VIII,
            ],
            EnigmaModel::ENIGMA_K => RotorType::getEnigmaKRotors(),
            EnigmaModel::SWISS_K => RotorType::getSwissKRotors(),
            EnigmaModel::RAILWAY => RotorType::getRailwayRotors(),
            EnigmaModel::TIRPITZ => RotorType::getTirpitzRotors(),
        };
    }

    /**
     * Generate random ring settings for each rotor.
     *
     * @return array<string, Letter> Keyed by position name
     */
    private function generateRandomRingstellungen(EnigmaModel $model): array
    {
        $result = [
            'p1' => $this->randomLetter(),
            'p2' => $this->randomLetter(),
            'p3' => $this->randomLetter(),
        ];

        if ($model->requiresGreekRotor()) {
            $result['greek'] = $this->randomLetter();
        }

        return $result;
    }

    /**
     * Generate random initial positions for each rotor.
     *
     * @return array<string, Letter> Keyed by position name
     */
    private function generateRandomPositions(EnigmaModel $model): array
    {
        $result = [
            'p1' => $this->randomLetter(),
            'p2' => $this->randomLetter(),
            'p3' => $this->randomLetter(),
        ];

        if ($model->requiresGreekRotor()) {
            $result['greek'] = $this->randomLetter();
        }

        return $result;
    }

    /**
     * Select a random reflector compatible with the model.
     */
    private function selectRandomReflector(EnigmaModel $model): ReflectorType
    {
        $compatible = $model->getCompatibleReflectors();

        return $compatible[$this->randomizer->pickArrayKeys($compatible, 1)[0]];
    }

    /**
     * Generate random plugboard pairs.
     *
     * @return list<array{Letter, Letter}> List of letter pairs
     */
    private function generateRandomPlugboardPairs(): array
    {
        $letters = Letter::cases();
        $selectedKeys = $this->randomizer->pickArrayKeys($letters, self::PLUGBOARD_PAIRS * 2);

        $pairs = [];
        for ($i = 0; $i < self::PLUGBOARD_PAIRS * 2; $i += 2) {
            $pairs[] = [$letters[$selectedKeys[$i]], $letters[$selectedKeys[$i + 1]]];
        }

        return $pairs;
    }

    /**
     * Generate random DORA reflector wiring.
     *
     * Creates 13 random letter pairs where each letter is used exactly once,
     * covering all 26 letters of the alphabet.
     *
     * @return list<array{Letter, Letter}> List of 13 letter pairs
     */
    private function generateRandomDoraWiring(): array
    {
        $letters = Letter::cases();
        // Shuffle all 26 letters and pair them up
        $shuffledKeys = $this->randomizer->pickArrayKeys($letters, 26);

        $pairs = [];
        for ($i = 0; $i < 26; $i += 2) {
            $pairs[] = [$letters[$shuffledKeys[$i]], $letters[$shuffledKeys[$i + 1]]];
        }

        return $pairs;
    }

    /**
     * Generate a random letter.
     */
    private function randomLetter(): Letter
    {
        $letters = Letter::cases();

        return $letters[$this->randomizer->pickArrayKeys($letters, 1)[0]];
    }
}
