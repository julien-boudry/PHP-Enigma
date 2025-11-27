<?php

declare(strict_types=1);

use JulienBoudry\Enigma\{Enigma, EnigmaConfiguration, EnigmaModel, EnigmaRandomConfigurator, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};
use JulienBoudry\Enigma\Reflector\ReflectorDora;
use Random\Engine\Mt19937;

describe('EnigmaRandomConfigurator', function (): void {
    it('generates valid configuration for WMLW model', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(12345));
        $config = $configurator->generate(EnigmaModel::WMLW);

        expect($config->model)->toBe(EnigmaModel::WMLW);
        expect($config->rotorTypes)->toHaveKeys(['p1', 'p2', 'p3']);
        expect($config->rotorTypes)->not->toHaveKey('greek');
        expect($config->ringstellungen)->toHaveKeys(['p1', 'p2', 'p3']);
        expect($config->positions)->toHaveKeys(['p1', 'p2', 'p3']);
        expect($config->plugboardPairs)->toHaveCount(10);

        // Verify reflector is compatible
        expect(\in_array($config->reflector, EnigmaModel::WMLW->getCompatibleReflectors(), true))->toBeTrue();
    });

    it('generates valid configuration for KMM3 model', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(54321));
        $config = $configurator->generate(EnigmaModel::KMM3);

        expect($config->model)->toBe(EnigmaModel::KMM3);
        expect($config->rotorTypes)->toHaveKeys(['p1', 'p2', 'p3']);
        expect($config->rotorTypes)->not->toHaveKey('greek');

        // Verify reflector is compatible (B or C, not DORA)
        expect(\in_array($config->reflector, [ReflectorType::B, ReflectorType::C], true))->toBeTrue();
    });

    it('generates valid configuration for KMM4 model with Greek rotor', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(67890));
        $config = $configurator->generate(EnigmaModel::KMM4);

        expect($config->model)->toBe(EnigmaModel::KMM4);
        expect($config->rotorTypes)->toHaveKeys(['p1', 'p2', 'p3', 'greek']);
        expect($config->ringstellungen)->toHaveKeys(['p1', 'p2', 'p3', 'greek']);
        expect($config->positions)->toHaveKeys(['p1', 'p2', 'p3', 'greek']);

        // Greek rotor must be BETA or GAMMA
        expect(\in_array($config->rotorTypes['greek'], [RotorType::BETA, RotorType::GAMMA], true))->toBeTrue();

        // Reflector must be thin
        expect(\in_array($config->reflector, [ReflectorType::BTHIN, ReflectorType::CTHIN], true))->toBeTrue();
    });

    it('generates unique rotors (no duplicates)', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(11111));

        for ($i = 0; $i < 10; $i++) {
            $config = $configurator->generate(EnigmaModel::WMLW);
            $rotors = [$config->rotorTypes['p1'], $config->rotorTypes['p2'], $config->rotorTypes['p3']];

            expect(\count(array_unique($rotors, \SORT_REGULAR)))->toBe(3);
        }
    });

    it('generates different configurations with different seeds', function (): void {
        $config1 = new EnigmaRandomConfigurator(new Mt19937(111))->generate(EnigmaModel::WMLW);
        $config2 = new EnigmaRandomConfigurator(new Mt19937(222))->generate(EnigmaModel::WMLW);

        // At least one setting should differ
        $same = $config1->rotorTypes === $config2->rotorTypes
            && $config1->ringstellungen === $config2->ringstellungen
            && $config1->positions === $config2->positions
            && $config1->reflector === $config2->reflector;

        expect($same)->toBeFalse();
    });

    it('generates same configuration with same seed', function (): void {
        $config1 = new EnigmaRandomConfigurator(new Mt19937(99999))->generate(EnigmaModel::WMLW);
        $config2 = new EnigmaRandomConfigurator(new Mt19937(99999))->generate(EnigmaModel::WMLW);

        expect($config1->rotorTypes)->toBe($config2->rotorTypes);
        expect($config1->ringstellungen)->toBe($config2->ringstellungen);
        expect($config1->positions)->toBe($config2->positions);
        expect($config1->reflector)->toBe($config2->reflector);
        expect($config1->plugboardPairs)->toBe($config2->plugboardPairs);
    });

    it('generates plugboard pairs with unique letters', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(33333));
        $config = $configurator->generate(EnigmaModel::WMLW);

        $usedLetters = [];
        foreach ($config->plugboardPairs as [$l1, $l2]) {
            expect($l1)->not->toBe($l2);
            expect(\in_array($l1, $usedLetters, true))->toBeFalse();
            expect(\in_array($l2, $usedLetters, true))->toBeFalse();
            $usedLetters[] = $l1;
            $usedLetters[] = $l2;
        }

        expect($usedLetters)->toHaveCount(20); // 10 pairs × 2 letters
    });

    it('generates random DORA wiring when DORA reflector is selected', function (): void {
        // Use a seed that selects DORA reflector
        $seed = 12345;
        $configurator = new EnigmaRandomConfigurator(new Mt19937($seed));

        // Keep generating until we get a DORA config (or force with specific seed)
        $config = null;
        for ($i = 0; $i < 100; $i++) {
            $testConfigurator = new EnigmaRandomConfigurator(new Mt19937($seed + $i));
            $testConfig = $testConfigurator->generate(EnigmaModel::WMLW);
            if ($testConfig->reflector === ReflectorType::DORA) {
                $config = $testConfig;

                break;
            }
        }

        expect($config)->not->toBeNull();
        expect($config->reflector)->toBe(ReflectorType::DORA);
        expect($config->doraWiringPairs)->not->toBeNull();
        expect($config->doraWiringPairs)->toHaveCount(13);

        // Verify all 26 letters are used exactly once
        $usedLetters = [];
        foreach ($config->doraWiringPairs as [$l1, $l2]) {
            expect($l1)->not->toBe($l2);
            expect(\in_array($l1, $usedLetters, true))->toBeFalse();
            expect(\in_array($l2, $usedLetters, true))->toBeFalse();
            $usedLetters[] = $l1;
            $usedLetters[] = $l2;
        }
        expect($usedLetters)->toHaveCount(26);
    });

    it('does not generate DORA wiring for non-DORA reflectors', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(54321));
        $config = $configurator->generate(EnigmaModel::KMM3);

        // KMM3 only supports B and C, not DORA
        expect($config->reflector)->not->toBe(ReflectorType::DORA);
        expect($config->doraWiringPairs)->toBeNull();
    });
});

describe('EnigmaConfiguration', function (): void {
    it('creates valid RotorConfiguration', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(44444));
        $config = $configurator->generate(EnigmaModel::WMLW);

        $rotorConfig = $config->createRotorConfiguration();

        expect($rotorConfig->getP1()->getType())->toBe($config->rotorTypes['p1']);
        expect($rotorConfig->getP2()->getType())->toBe($config->rotorTypes['p2']);
        expect($rotorConfig->getP3()->getType())->toBe($config->rotorTypes['p3']);
    });

    it('creates valid RotorConfiguration for KMM4 with Greek rotor', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(55555));
        $config = $configurator->generate(EnigmaModel::KMM4);

        $rotorConfig = $config->createRotorConfiguration();

        expect($rotorConfig->hasGreekRotor())->toBeTrue();
        expect($rotorConfig->getGreek()->getType())->toBe($config->rotorTypes['greek']);
    });

    it('creates fully configured Enigma machine', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(66666));
        $config = $configurator->generate(EnigmaModel::WMLW);

        $enigma = $config->createEnigma();

        expect($enigma->model)->toBe(EnigmaModel::WMLW);
        expect($enigma->getPosition(RotorPosition::P1))->toBe($config->positions['p1']);
        expect($enigma->getPosition(RotorPosition::P2))->toBe($config->positions['p2']);
        expect($enigma->getPosition(RotorPosition::P3))->toBe($config->positions['p3']);
    });

    it('generates readable summary', function (): void {
        $configurator = new EnigmaRandomConfigurator(new Mt19937(77777));
        $config = $configurator->generate(EnigmaModel::WMLW);

        $summary = $config->getSummary();

        expect($summary)->toContain('Model: WMLW');
        expect($summary)->toContain('Rotors:');
        expect($summary)->toContain('Ring:');
        expect($summary)->toContain('Position:');
        expect($summary)->toContain('Reflector:');
        expect($summary)->toContain('Plugs:');
    });

    it('extracts configuration from existing Enigma', function (): void {
        $rotorsConfiguration = new RotorConfiguration(
            p1: RotorType::I,
            p2: RotorType::II,
            p3: RotorType::III,
            ringstellungP1: Letter::B,
            ringstellungP2: Letter::C,
            ringstellungP3: Letter::D,
        );

        $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
        $enigma->setPosition(RotorPosition::P1, Letter::X);
        $enigma->setPosition(RotorPosition::P2, Letter::Y);
        $enigma->setPosition(RotorPosition::P3, Letter::Z);
        $enigma->plugLetters(Letter::A, Letter::B);
        $enigma->plugLetters(Letter::C, Letter::D);

        $config = EnigmaConfiguration::fromEnigma($enigma);

        expect($config->model)->toBe(EnigmaModel::WMLW);
        expect($config->rotorTypes['p1'])->toBe(RotorType::I);
        expect($config->rotorTypes['p2'])->toBe(RotorType::II);
        expect($config->rotorTypes['p3'])->toBe(RotorType::III);
        expect($config->ringstellungen['p1'])->toBe(Letter::B);
        expect($config->ringstellungen['p2'])->toBe(Letter::C);
        expect($config->ringstellungen['p3'])->toBe(Letter::D);
        expect($config->positions['p1'])->toBe(Letter::X);
        expect($config->positions['p2'])->toBe(Letter::Y);
        expect($config->positions['p3'])->toBe(Letter::Z);
        expect($config->reflector)->toBe(ReflectorType::B);
        expect($config->plugboardPairs)->toHaveCount(2);
    });

    it('extracts configuration from KMM4 with Greek rotor', function (): void {
        $rotorsConfiguration = new RotorConfiguration(
            p1: RotorType::I,
            p2: RotorType::II,
            p3: RotorType::III,
            greek: RotorType::BETA,
        );

        $enigma = new Enigma(EnigmaModel::KMM4, $rotorsConfiguration, ReflectorType::BTHIN);

        $config = EnigmaConfiguration::fromEnigma($enigma);

        expect($config->rotorTypes)->toHaveKey('greek');
        expect($config->rotorTypes['greek'])->toBe(RotorType::BETA);
    });

    it('recreates identical Enigma from extracted configuration', function (): void {
        $original = Enigma::createRandom(EnigmaModel::WMLW, new Mt19937(12345));
        $config = $original->getConfiguration();

        $recreated = $config->createEnigma();

        $text = 'TESTMESSAGE';
        $cipher1 = $original->encodeLetters($text);

        // Reset original to same position
        $original2 = $config->createEnigma();
        $cipher2 = $original2->encodeLetters($text);

        expect($cipher1)->toBe($cipher2);
    });

    it('extracts DORA wiring from Enigma with custom DORA reflector', function (): void {
        $rotorsConfiguration = new RotorConfiguration(
            p1: RotorType::I,
            p2: RotorType::II,
            p3: RotorType::III,
        );

        $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
        $customDora = ReflectorDora::fromString('AZ BY CX DW EV FU GT HS IR JQ KP LO MN');
        $enigma->mountReflector($customDora);

        $config = EnigmaConfiguration::fromEnigma($enigma);

        expect($config->reflector)->toBe(ReflectorType::DORA);
        expect($config->doraWiringPairs)->not->toBeNull();
        expect($config->doraWiringPairs)->toHaveCount(13);
    });

    it('recreates identical Enigma with custom DORA wiring', function (): void {
        $rotorsConfiguration = new RotorConfiguration(
            p1: RotorType::I,
            p2: RotorType::II,
            p3: RotorType::III,
        );

        $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
        $customDora = ReflectorDora::fromString('AZ BY CX DW EV FU GT HS IR JQ KP LO MN');
        $enigma->mountReflector($customDora);
        $enigma->setPosition(RotorPosition::P1, Letter::A);
        $enigma->setPosition(RotorPosition::P2, Letter::A);
        $enigma->setPosition(RotorPosition::P3, Letter::A);

        $config = EnigmaConfiguration::fromEnigma($enigma);
        $recreated = $config->createEnigma();

        // Both machines should produce identical output
        $plaintext = 'SECRETMESSAGE';
        $cipher1 = $enigma->encodeLetters($plaintext);

        $enigma2 = $config->createEnigma(); // Fresh instance with same config
        $cipher2 = $enigma2->encodeLetters($plaintext);

        expect($cipher1)->toBe($cipher2);
    });

    it('creates Enigma with random DORA wiring from configuration', function (): void {
        // Find a seed that generates DORA
        $config = null;
        for ($i = 0; $i < 100; $i++) {
            $configurator = new EnigmaRandomConfigurator(new Mt19937(12345 + $i));
            $testConfig = $configurator->generate(EnigmaModel::WMLW);
            if ($testConfig->reflector === ReflectorType::DORA) {
                $config = $testConfig;

                break;
            }
        }

        expect($config)->not->toBeNull();

        $enigma = $config->createEnigma();

        // Verify the machine works with reciprocal encoding
        $plaintext = 'TESTMESSAGE';
        $ciphertext = $enigma->encodeLetters($plaintext);

        // Reset position and decode
        $decoder = $config->createEnigma();
        $decoded = $decoder->encodeLetters($ciphertext);

        expect($decoded)->toBe($plaintext);
    });
});

describe('Enigma::createRandom', function (): void {
    it('creates working Enigma machine', function (): void {
        $enigma = Enigma::createRandom(EnigmaModel::WMLW, new Mt19937(88888));

        // Should be able to encode and decode
        $plaintext = 'HELLO';
        $ciphertext = $enigma->encodeLetters($plaintext);

        expect($ciphertext)->toHaveLength(5);
        expect($ciphertext)->not->toBe($plaintext);
    });

    it('creates reciprocal encryption (encode + decode = original)', function (): void {
        $seed = 99999;
        $plaintext = 'THEQUICKBROWNFOXJUMPSOVERTHELAZYDOG';

        // Encode
        $encoder = Enigma::createRandom(EnigmaModel::WMLW, new Mt19937($seed));
        $ciphertext = $encoder->encodeLetters($plaintext);

        // Decode with same seed (same configuration)
        $decoder = Enigma::createRandom(EnigmaModel::WMLW, new Mt19937($seed));
        $decoded = $decoder->encodeLetters($ciphertext);

        expect($decoded)->toBe($plaintext);
    });

    it('creates different machines without seed', function (): void {
        // Note: This test has a tiny chance of failing if two random configs are identical
        $enigma1 = Enigma::createRandom(EnigmaModel::WMLW);
        $enigma2 = Enigma::createRandom(EnigmaModel::WMLW);

        $text = 'AAAAAAAAAA';
        $cipher1 = $enigma1->encodeLetters($text);
        $cipher2 = $enigma2->encodeLetters($text);

        expect($cipher1)->not->toBe($cipher2);
    });

    it('works with KMM4 model', function (): void {
        $enigma = Enigma::createRandom(EnigmaModel::KMM4, new Mt19937(11111));

        $ciphertext = $enigma->encodeLetters('SECRETMESSAGE');

        expect($ciphertext)->toHaveLength(13);
    });
});

describe('Enigma::createRandomWithConfiguration', function (): void {
    it('returns both Enigma and configuration', function (): void {
        [$enigma, $config] = Enigma::createRandomWithConfiguration(EnigmaModel::WMLW, new Mt19937(22222));

        expect($enigma)->toBeInstanceOf(Enigma::class);
        expect($config)->toBeInstanceOf(EnigmaConfiguration::class);
        expect($enigma->model)->toBe($config->model);
    });

    it('configuration can recreate identical Enigma', function (): void {
        [$enigma1, $config] = Enigma::createRandomWithConfiguration(EnigmaModel::WMLW, new Mt19937(33333));
        $enigma2 = $config->createEnigma();

        $text = 'IDENTICALTEST';

        // Reset positions (they advance during encoding)
        $cipher1 = $enigma1->encodeLetters($text);
        $cipher2 = $enigma2->encodeLetters($text);

        expect($cipher1)->toBe($cipher2);
    });
});

describe('Enigma::getConfiguration', function (): void {
    it('returns current configuration', function (): void {
        $enigma = Enigma::createRandom(EnigmaModel::WMLW, new Mt19937(44444));
        $config = $enigma->getConfiguration();

        expect($config)->toBeInstanceOf(EnigmaConfiguration::class);
        expect($config->model)->toBe(EnigmaModel::WMLW);
    });

    it('reflects position changes', function (): void {
        $rotorsConfiguration = new RotorConfiguration(
            p1: RotorType::I,
            p2: RotorType::II,
            p3: RotorType::III,
        );

        $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
        $enigma->setPosition(RotorPosition::P1, Letter::M);

        $config = $enigma->getConfiguration();

        expect($config->positions['p1'])->toBe(Letter::M);
    });
});
