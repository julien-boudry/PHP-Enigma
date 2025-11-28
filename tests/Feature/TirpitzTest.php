<?php

declare(strict_types=1);

use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, EnigmaPlugboard, Letter, ReflectorType, RotorConfiguration, RotorType, RotorPosition};
use JulienBoudry\EnigmaMachine\EntryWheel\TirpitzEntryWheel;
use JulienBoudry\EnigmaMachine\Exception\EnigmaConfigurationException;

describe('Enigma T (Tirpitz)', function (): void {

    describe('Basic Functionality', function (): void {

        it('creates a working Enigma T with Tirpitz rotors', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            expect($enigma)->toBeInstanceOf(Enigma::class);
            expect($enigma->model)->toBe(EnigmaModel::TIRPITZ);
        });

        it('does not have a plugboard (historically)', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            // Plugboard object exists but model historically has no plugboard
            expect($enigma->plugboard)->toBeInstanceOf(EnigmaPlugboard::class);
            expect($enigma->hasPlugboard())->toBeFalse();
        });

        it('throws exception when trying to plug letters', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            expect(fn() => $enigma->plugLetters(Letter::A, Letter::B))
                ->toThrow(EnigmaConfigurationException::class, 'does not have a plugboard');
        });

        it('encodes and decodes reciprocally (same settings)', function (): void {
            $enigmaEncoder = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_V,
                    p2: RotorType::TIRPITZ_III,
                    p3: RotorType::TIRPITZ_I,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            $enigmaDecoder = clone $enigmaEncoder;

            $plaintext = 'HELLOWORLD';
            $ciphertext = $enigmaEncoder->encodeLetters($plaintext);
            $decoded = $enigmaDecoder->encodeLetters($ciphertext);

            expect($decoded)->toBe($plaintext);
        });

        it('no letter encrypts to itself', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            // Test all 26 letters at different rotor positions
            for ($i = 0; $i < 26; $i++) {
                $letter = Letter::from($i);
                $encoded = $enigma->encodeLetter($letter);
                expect($encoded)->not->toBe($letter);
            }
        });
    });

    describe('8 Rotors', function (): void {

        it('supports all 8 Tirpitz rotors', function (): void {
            $allRotors = RotorType::getCompatibleRotorsForModel(EnigmaModel::TIRPITZ);

            expect($allRotors)->toHaveCount(8);
            expect($allRotors)->toBe([
                RotorType::TIRPITZ_I,
                RotorType::TIRPITZ_II,
                RotorType::TIRPITZ_III,
                RotorType::TIRPITZ_IV,
                RotorType::TIRPITZ_V,
                RotorType::TIRPITZ_VI,
                RotorType::TIRPITZ_VII,
                RotorType::TIRPITZ_VIII,
            ]);
        });

        it('can use any 3 of 8 rotors', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_VIII,
                    p2: RotorType::TIRPITZ_IV,
                    p3: RotorType::TIRPITZ_VI,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            expect($enigma)->toBeInstanceOf(Enigma::class);

            // Verify it works
            $ciphertext = $enigma->encodeLetters('TEST');
            expect($ciphertext)->toHaveLength(4);
        });

        it('each rotor has 5 notches', function (): void {
            $rotorTypes = RotorType::getCompatibleRotorsForModel(EnigmaModel::TIRPITZ);

            foreach ($rotorTypes as $rotorType) {
                $rotor = $rotorType->createRotor();
                $notches = $rotor::getNotches();

                expect($notches)->toHaveCount(5);
                expect($notches)->toBe([Letter::E, Letter::H, Letter::K, Letter::N, Letter::Q]);
            }
        });
    });

    describe('Entry Wheel', function (): void {

        it('uses Tirpitz entry wheel', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            expect($enigma->entryWheel)->toBeInstanceOf(TirpitzEntryWheel::class);
        });

        it('Tirpitz entry wheel has unique wiring', function (): void {
            expect(TirpitzEntryWheel::WIRING)->toBe('KZROUQHYAIGBLWVSTDXFPNMCJE');
        });

        it('Tirpitz entry wheel affects output', function (): void {
            // Create Enigma T with Tirpitz rotors
            $tirpitzEnigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            // Create military Enigma with same relative rotor configuration
            $militaryEnigma = new Enigma(
                model: EnigmaModel::WMLW,
                rotors: new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                reflector: ReflectorType::B,
            );

            // Same input should produce different output due to entry wheel
            $tirpitzOutput = $tirpitzEnigma->encodeLetter(Letter::A);
            $militaryOutput = $militaryEnigma->encodeLetter(Letter::A);

            expect($tirpitzOutput)->not->toBe($militaryOutput);
        });
    });

    describe('Random Configuration', function (): void {

        it('generates valid random configuration for TIRPITZ', function (): void {
            $enigma = Enigma::createRandom(EnigmaModel::TIRPITZ);

            expect($enigma)->toBeInstanceOf(Enigma::class);
            expect($enigma->model)->toBe(EnigmaModel::TIRPITZ);
        });

        it('random configuration uses only Tirpitz rotors', function (): void {
            $enigma = Enigma::createRandom(EnigmaModel::TIRPITZ);
            $config = $enigma->getConfiguration();

            $tirpitzRotors = RotorType::getCompatibleRotorsForModel(EnigmaModel::TIRPITZ);

            expect(\in_array($config->rotorTypes['p1'], $tirpitzRotors, true))->toBeTrue();
            expect(\in_array($config->rotorTypes['p2'], $tirpitzRotors, true))->toBeTrue();
            expect(\in_array($config->rotorTypes['p3'], $tirpitzRotors, true))->toBeTrue();
        });

        it('random configuration uses Tirpitz reflector', function (): void {
            $enigma = Enigma::createRandom(EnigmaModel::TIRPITZ);
            $config = $enigma->getConfiguration();

            expect($config->reflector)->toBe(ReflectorType::TIRPITZ);
        });

        it('configuration summary does not show plugboard for Tirpitz', function (): void {
            $enigma = Enigma::createRandom(EnigmaModel::TIRPITZ);
            $config = $enigma->getConfiguration();
            $summary = $config->getSummary();

            expect($summary)->not->toContain('Plugs:');
            expect($summary)->toContain('Model: TIRPITZ');
        });
    });

    describe('Model Compatibility', function (): void {

        it('rejects military rotors in Tirpitz model', function (): void {
            expect(function (): void {
                new Enigma(
                    model: EnigmaModel::TIRPITZ,
                    rotors: new RotorConfiguration(
                        p1: RotorType::I,  // Military rotor
                        p2: RotorType::TIRPITZ_II,
                        p3: RotorType::TIRPITZ_III,
                    ),
                    reflector: ReflectorType::TIRPITZ,
                );
            })->toThrow(EnigmaConfigurationException::class);
        });

        it('rejects Tirpitz rotors in military model', function (): void {
            expect(function (): void {
                new Enigma(
                    model: EnigmaModel::WMLW,
                    rotors: new RotorConfiguration(
                        p1: RotorType::TIRPITZ_I,  // Tirpitz rotor
                        p2: RotorType::II,
                        p3: RotorType::III,
                    ),
                    reflector: ReflectorType::B,
                );
            })->toThrow(EnigmaConfigurationException::class);
        });

        it('rejects military reflector in Tirpitz model', function (): void {
            expect(function (): void {
                new Enigma(
                    model: EnigmaModel::TIRPITZ,
                    rotors: new RotorConfiguration(
                        p1: RotorType::TIRPITZ_I,
                        p2: RotorType::TIRPITZ_II,
                        p3: RotorType::TIRPITZ_III,
                    ),
                    reflector: ReflectorType::B,  // Military reflector
                );
            })->toThrow(EnigmaConfigurationException::class);
        });

        it('strictMode false allows any rotor combination', function (): void {
            // Mix Tirpitz and military rotors with strictMode disabled
            $enigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::I,  // Military rotor
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                    strictMode: false,
                ),
                reflector: ReflectorType::TIRPITZ,
                strictMode: false,
            );

            expect($enigma)->toBeInstanceOf(Enigma::class);
        });

        it('strictMode false allows plugboard on Tirpitz model', function (): void {
            $enigma = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
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

    describe('Clone functionality', function (): void {

        it('clones Tirpitz model correctly', function (): void {
            $original = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
            );

            $original->setPosition(RotorPosition::P1, Letter::M);

            $clone = clone $original;

            // Both should produce same output
            $originalOutput = $original->encodeLetters('TEST');
            $cloneOutput = $clone->encodeLetters('TEST');

            // They started at same position, so first encode should match
            // (positions changed after encoding, so re-test after reset would be needed for full verification)
            expect($cloneOutput)->toBe($originalOutput);
        });
    });

});
