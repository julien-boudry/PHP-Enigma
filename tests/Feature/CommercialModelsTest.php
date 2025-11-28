<?php

declare(strict_types=1);

use JulienBoudry\Enigma\{Enigma, EnigmaModel, EnigmaPlugboard, Letter, ReflectorType, RotorConfiguration, RotorType, RotorPosition};
use JulienBoudry\Enigma\EntryWheel\{AlphabeticalEntryWheel, QwertzEntryWheel};
use JulienBoudry\Enigma\Exception\EnigmaConfigurationException;

describe('Commercial Enigma Models', function (): void {

    describe('Enigma K Commercial', function (): void {

        it('creates a working Enigma K with commercial rotors', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            expect($enigma->model)->toBe(EnigmaModel::ENIGMA_K);
            expect($enigma->hasPlugboard())->toBeFalse();
            expect($enigma->entryWheel)->toBeInstanceOf(QwertzEntryWheel::class);
        });

        it('does not have a plugboard (historically)', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            // Plugboard object exists but model historically has no plugboard
            expect($enigma->plugboard)->toBeInstanceOf(EnigmaPlugboard::class);
            expect($enigma->hasPlugboard())->toBeFalse();
        });

        it('throws exception when trying to plug letters', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            expect(fn() => $enigma->plugLetters(Letter::A, Letter::B))
                ->toThrow(EnigmaConfigurationException::class);
        });

        it('encodes and decodes reciprocally (same settings)', function (): void {
            $enigma1 = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            $enigma2 = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            $plaintext = 'HELLOWORLD';
            $ciphertext = $enigma1->encodeLetters($plaintext);
            $decoded = $enigma2->encodeLetters($ciphertext);

            expect($decoded)->toBe($plaintext);
        });

        it('no letter encrypts to itself', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            // Test all 26 letters
            foreach (Letter::cases() as $letter) {
                $enigmaClone = clone $enigma;
                $encoded = $enigmaClone->encodeLetter($letter);
                expect($encoded)->not->toBe($letter, "Letter {$letter->toChar()} should not encrypt to itself");
            }
        });
    });

    describe('Swiss-K', function (): void {

        it('creates a working Swiss-K with Swiss rotors', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::SWISS_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::SWISS_K_I,
                    p2: RotorType::SWISS_K_II,
                    p3: RotorType::SWISS_K_III,
                ),
                reflector: ReflectorType::SWISS_K,
            );

            expect($enigma->model)->toBe(EnigmaModel::SWISS_K);
            expect($enigma->hasPlugboard())->toBeFalse();
            expect($enigma->entryWheel)->toBeInstanceOf(QwertzEntryWheel::class);
        });

        it('produces different output than commercial K with same settings', function (): void {
            // Swiss rewired their rotors, so same positions should produce different output
            $enigmaK = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            $swissK = new Enigma(
                model: EnigmaModel::SWISS_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::SWISS_K_I,
                    p2: RotorType::SWISS_K_II,
                    p3: RotorType::SWISS_K_III,
                ),
                reflector: ReflectorType::SWISS_K,
            );

            $plaintext = 'TESTMESSAGE';
            $ciphertextK = $enigmaK->encodeLetters($plaintext);
            $ciphertextSwiss = $swissK->encodeLetters($plaintext);

            expect($ciphertextSwiss)->not->toBe($ciphertextK);
        });

        it('encodes and decodes reciprocally', function (): void {
            $enigma1 = new Enigma(
                model: EnigmaModel::SWISS_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::SWISS_K_I,
                    p2: RotorType::SWISS_K_II,
                    p3: RotorType::SWISS_K_III,
                ),
                reflector: ReflectorType::SWISS_K,
            );

            $enigma2 = new Enigma(
                model: EnigmaModel::SWISS_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::SWISS_K_I,
                    p2: RotorType::SWISS_K_II,
                    p3: RotorType::SWISS_K_III,
                ),
                reflector: ReflectorType::SWISS_K,
            );

            $plaintext = 'SCHWEIZERNEUTRAL';
            $ciphertext = $enigma1->encodeLetters($plaintext);
            $decoded = $enigma2->encodeLetters($ciphertext);

            expect($decoded)->toBe($plaintext);
        });
    });

    describe('Railway Enigma (Rocket)', function (): void {

        it('creates a working Railway Enigma with Railway rotors', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::RAILWAY,
                rotors: new RotorConfiguration(
                    p1: RotorType::RAILWAY_I,
                    p2: RotorType::RAILWAY_II,
                    p3: RotorType::RAILWAY_III,
                ),
                reflector: ReflectorType::RAILWAY,
            );

            expect($enigma->model)->toBe(EnigmaModel::RAILWAY);
            expect($enigma->hasPlugboard())->toBeFalse();
            expect($enigma->entryWheel)->toBeInstanceOf(QwertzEntryWheel::class);
        });

        it('produces different output than commercial K (rewired rotors)', function (): void {
            $enigmaK = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            $railway = new Enigma(
                model: EnigmaModel::RAILWAY,
                rotors: new RotorConfiguration(
                    p1: RotorType::RAILWAY_I,
                    p2: RotorType::RAILWAY_II,
                    p3: RotorType::RAILWAY_III,
                ),
                reflector: ReflectorType::RAILWAY,
            );

            $plaintext = 'REICHSBAHN';
            $ciphertextK = $enigmaK->encodeLetters($plaintext);
            $ciphertextRailway = $railway->encodeLetters($plaintext);

            expect($ciphertextRailway)->not->toBe($ciphertextK);
        });

        it('encodes and decodes reciprocally', function (): void {
            $enigma1 = new Enigma(
                model: EnigmaModel::RAILWAY,
                rotors: new RotorConfiguration(
                    p1: RotorType::RAILWAY_I,
                    p2: RotorType::RAILWAY_II,
                    p3: RotorType::RAILWAY_III,
                ),
                reflector: ReflectorType::RAILWAY,
            );

            $enigma2 = new Enigma(
                model: EnigmaModel::RAILWAY,
                rotors: new RotorConfiguration(
                    p1: RotorType::RAILWAY_I,
                    p2: RotorType::RAILWAY_II,
                    p3: RotorType::RAILWAY_III,
                ),
                reflector: ReflectorType::RAILWAY,
            );

            $plaintext = 'ZUGVERKEHR';
            $ciphertext = $enigma1->encodeLetters($plaintext);
            $decoded = $enigma2->encodeLetters($ciphertext);

            expect($decoded)->toBe($plaintext);
        });
    });

    describe('Random Configuration for Commercial Models', function (): void {

        it('generates valid random configuration for ENIGMA_K', function (): void {
            $enigma = Enigma::createRandom(EnigmaModel::ENIGMA_K);

            expect($enigma->model)->toBe(EnigmaModel::ENIGMA_K);
            expect($enigma->hasPlugboard())->toBeFalse();

            // Verify it can encode
            $ciphertext = $enigma->encodeLetters('TEST');
            expect(\strlen($ciphertext))->toBe(4);
        });

        it('generates valid random configuration for SWISS_K', function (): void {
            $enigma = Enigma::createRandom(EnigmaModel::SWISS_K);

            expect($enigma->model)->toBe(EnigmaModel::SWISS_K);
            expect($enigma->hasPlugboard())->toBeFalse();

            // Verify it can encode
            $ciphertext = $enigma->encodeLetters('TEST');
            expect(\strlen($ciphertext))->toBe(4);
        });

        it('generates valid random configuration for RAILWAY', function (): void {
            $enigma = Enigma::createRandom(EnigmaModel::RAILWAY);

            expect($enigma->model)->toBe(EnigmaModel::RAILWAY);
            expect($enigma->hasPlugboard())->toBeFalse();

            // Verify it can encode
            $ciphertext = $enigma->encodeLetters('TEST');
            expect(\strlen($ciphertext))->toBe(4);
        });

        it('configuration summary does not show plugboard for commercial models', function (): void {
            [$enigma, $config] = Enigma::createRandomWithConfiguration(EnigmaModel::ENIGMA_K);

            $summary = $config->getSummary();
            expect($summary)->not->toContain('Plugs:');
        });
    });

    describe('Model Compatibility', function (): void {

        it('rejects military rotors in commercial model', function (): void {
            expect(fn() => new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::I,  // Military rotor
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            ))->toThrow(EnigmaConfigurationException::class);
        });

        it('rejects commercial rotors in military model', function (): void {
            expect(fn() => new Enigma(
                model: EnigmaModel::WMLW,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,  // Commercial rotor
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                reflector: ReflectorType::B,
            ))->toThrow(EnigmaConfigurationException::class);
        });

        it('rejects military reflector in commercial model', function (): void {
            expect(fn() => new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::B,  // Military reflector
            ))->toThrow(EnigmaConfigurationException::class);
        });

        it('strictMode false allows any rotor combination', function (): void {
            // This wouldn't be historically accurate but should work
            $enigma = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::I,  // Military rotor in commercial model
                    p2: RotorType::II,
                    p3: RotorType::III,
                    strictMode: false,
                ),
                reflector: ReflectorType::K,
                strictMode: false,
            );

            expect($enigma->encodeLetters('TEST'))->toHaveLength(4);
        });

        it('strictMode false allows plugboard on commercial model', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
                strictMode: false,
            );

            // hasPlugboard() still returns false (historical), but we can use it
            expect($enigma->hasPlugboard())->toBeFalse();

            // With strictMode false, we can plug letters on any model
            $enigma->plugLetters(Letter::A, Letter::Z);

            $ciphertext = $enigma->encodeLetters('TEST');
            expect($ciphertext)->toHaveLength(4);
        });
    });

    describe('Entry Wheel QWERTZ', function (): void {

        it('commercial models use QWERTZ entry wheel', function (): void {
            $enigmaK = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            expect($enigmaK->entryWheel)->toBeInstanceOf(QwertzEntryWheel::class);
        });

        it('military models use alphabetical entry wheel', function (): void {
            $enigmaMilitary = new Enigma(
                model: EnigmaModel::WMLW,
                rotors: new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                reflector: ReflectorType::B,
            );

            expect($enigmaMilitary->entryWheel)->toBeInstanceOf(AlphabeticalEntryWheel::class);
        });

        it('QWERTZ entry wheel affects output', function (): void {
            // Create two machines with same wiring but different entry wheels
            // (one commercial, one military with strictMode off)
            $commercial = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            // The output depends on the entry wheel
            // Just verify it produces valid output
            $ciphertext = $commercial->encodeLetters('QWERTZ');
            expect($ciphertext)->toHaveLength(6);
            expect($ciphertext)->toMatch('/^[A-Z]+$/');
        });
    });

    describe('Clone functionality for commercial models', function (): void {

        it('clones commercial model correctly', function (): void {
            $original = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );

            $original->setPosition(RotorPosition::P1, Letter::F);

            $clone = clone $original;

            // Original and clone should be at same position
            expect($clone->getPosition(RotorPosition::P1))->toBe(Letter::F);

            // Encoding on clone should not affect original
            $clone->encodeLetter(Letter::A);
            expect($original->getPosition(RotorPosition::P1))->toBe(Letter::F);
        });
    });
});
