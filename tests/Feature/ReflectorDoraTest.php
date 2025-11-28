<?php

declare(strict_types=1);

use JulienBoudry\EnigmaMachine\Exception\{EnigmaConfigurationException, EnigmaWiringException};
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorType};
use JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;

describe('ReflectorDora', function (): void {
    describe('construction', function (): void {
        it('creates reflector with valid 13 pairs', function (): void {
            $pairs = [
                'A' => 'C', 'B' => 'O', 'D' => 'E', 'F' => 'G',
                'H' => 'I', 'J' => 'K', 'L' => 'M', 'N' => 'P',
                'Q' => 'R', 'S' => 'T', 'U' => 'V', 'W' => 'X',
                'Y' => 'Z',
            ];

            $reflector = new ReflectorDora($pairs);

            expect($reflector)->toBeInstanceOf(ReflectorDora::class);
        });

        it('creates reflector from string with 13 pairs', function (): void {
            $reflector = ReflectorDora::fromString('AC BO DE FG HI JK LM NP QR ST UV WX YZ');

            expect($reflector)->toBeInstanceOf(ReflectorDora::class);
        });

        it('creates reflector with default wiring', function (): void {
            $reflector = ReflectorDora::withDefaultWiring();

            expect($reflector)->toBeInstanceOf(ReflectorDora::class);
        });

        it('throws exception for wrong number of pairs', function (): void {
            $pairs = [
                'A' => 'C', 'D' => 'E', 'F' => 'G',
            ];

            expect(fn() => new ReflectorDora($pairs))->toThrow(EnigmaWiringException::class);
        });

        it('throws exception for self-connection', function (): void {
            $pairs = [
                'A' => 'A', 'B' => 'O', 'C' => 'D', 'E' => 'F',
                'G' => 'H', 'I' => 'J', 'K' => 'L', 'M' => 'N',
                'P' => 'Q', 'R' => 'S', 'T' => 'U', 'V' => 'W',
                'X' => 'Y',
            ];

            expect(fn() => new ReflectorDora($pairs))->toThrow(EnigmaWiringException::class);
        });

        it('throws exception for duplicate letter', function (): void {
            $pairs = [
                'A' => 'C', 'A' => 'D', 'B' => 'O', 'E' => 'F',
                'G' => 'H', 'I' => 'J', 'K' => 'L', 'M' => 'N',
                'P' => 'Q', 'R' => 'S', 'T' => 'U', 'V' => 'W',
                'X' => 'Y',
            ];

            expect(fn() => new ReflectorDora($pairs))->toThrow(EnigmaWiringException::class);
        });

        it('throws exception for invalid string length', function (): void {
            expect(fn() => ReflectorDora::fromString('AB CD'))->toThrow(EnigmaWiringException::class);
        });

        it('allows any 13 pairs without B↔O constraint', function (): void {
            // B is NOT paired with O - this should work now
            $pairs = [
                'A' => 'B', 'C' => 'D', 'E' => 'F', 'G' => 'H',
                'I' => 'J', 'K' => 'L', 'M' => 'N', 'O' => 'P',
                'Q' => 'R', 'S' => 'T', 'U' => 'V', 'W' => 'X',
                'Y' => 'Z',
            ];

            $reflector = new ReflectorDora($pairs);

            expect($reflector)->toBeInstanceOf(ReflectorDora::class);
            // Verify A↔B works
            expect($reflector->processLetter(Letter::A)->toChar())->toBe('B');
            expect($reflector->processLetter(Letter::B)->toChar())->toBe('A');
        });
    });

    describe('signal processing', function (): void {
        it('processes letter through reflector', function (): void {
            $reflector = ReflectorDora::fromString('AC BO DE FG HI JK LM NP QR ST UV WX YZ');

            // A↔C
            expect($reflector->processLetter(Letter::A)->toChar())->toBe('C');
            expect($reflector->processLetter(Letter::C)->toChar())->toBe('A');

            // B↔O
            expect($reflector->processLetter(Letter::B)->toChar())->toBe('O');
            expect($reflector->processLetter(Letter::O)->toChar())->toBe('B');
        });

        it('is reciprocal (encoding twice returns original)', function (): void {
            $reflector = ReflectorDora::withDefaultWiring();

            foreach (Letter::cases() as $letter) {
                $encoded = $reflector->processLetter($letter);
                $decoded = $reflector->processLetter($encoded);

                expect($decoded)->toBe($letter);
            }
        });
    });

    describe('integration with Enigma', function (): void {
        it('can be mounted via ReflectorType::DORA', function (): void {
            $enigma = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::DORA
            );

            $encoded = $enigma->encodeLetters('HELLO');

            expect($encoded)->toHaveLength(5);
            expect($encoded)->not->toBe('HELLO');
        });

        it('can be mounted with custom wiring', function (): void {
            $enigma = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );

            $customDora = ReflectorDora::fromString('AC BO DE FG HI JK LM NP QR ST UV WX YZ');
            $enigma->mountReflector($customDora);

            $encoded = $enigma->encodeLetters('HELLO');

            expect($encoded)->toHaveLength(5);
        });

        it('encoding then decoding returns original with same settings', function (): void {
            $createEnigma = fn() => new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::DORA
            );

            $enigma1 = $createEnigma();
            $enigma2 = $createEnigma();

            $plaintext = 'THEQUICKBROWNFOX';
            $ciphertext = $enigma1->encodeLetters($plaintext);
            $decoded = $enigma2->encodeLetters($ciphertext);

            expect($decoded)->toBe($plaintext);
        });

        it('different wiring produces different output', function (): void {
            $rotors = new RotorConfiguration(
                p1: RotorType::I,
                p2: RotorType::II,
                p3: RotorType::III,
            );

            $enigma1 = new Enigma(EnigmaModel::WMLW, clone $rotors, ReflectorType::B);
            $enigma2 = new Enigma(EnigmaModel::WMLW, clone $rotors, ReflectorType::B);

            // Two different UKW-D configurations
            $dora1 = ReflectorDora::fromString('AC BO DE FG HI JK LM NP QR ST UV WX YZ');
            $dora2 = ReflectorDora::fromString('AZ BO CE DF GH IJ KL MN PQ RS TU VW XY');

            $enigma1->mountReflector($dora1);
            $enigma2->mountReflector($dora2);

            $plaintext = 'TESTMESSAGE';
            $output1 = $enigma1->encodeLetters($plaintext);
            $output2 = $enigma2->encodeLetters($plaintext);

            expect($output1)->not->toBe($output2);
        });

        it('is only compatible with WMLW model', function (): void {
            expect(EnigmaModel::WMLW->isReflectorCompatible(ReflectorType::DORA))->toBeTrue();
            expect(EnigmaModel::KMM3->isReflectorCompatible(ReflectorType::DORA))->toBeFalse();
            expect(EnigmaModel::KMM4->isReflectorCompatible(ReflectorType::DORA))->toBeFalse();
        });

        it('throws exception when mounting DORA on incompatible model', function (): void {
            expect(fn() => new Enigma(
                EnigmaModel::KMM3,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::DORA
            ))->toThrow(EnigmaConfigurationException::class);
        });
    });

    describe('ReflectorType factory methods', function (): void {
        it('creates Dora via createDoraReflector', function (): void {
            $pairs = [
                'A' => 'C', 'B' => 'O', 'D' => 'E', 'F' => 'G',
                'H' => 'I', 'J' => 'K', 'L' => 'M', 'N' => 'P',
                'Q' => 'R', 'S' => 'T', 'U' => 'V', 'W' => 'X',
                'Y' => 'Z',
            ];

            $reflector = ReflectorType::createDoraReflector($pairs);

            expect($reflector)->toBeInstanceOf(ReflectorDora::class);
        });

        it('creates Dora via createDoraReflectorFromString', function (): void {
            $reflector = ReflectorType::createDoraReflectorFromString('AC BO DE FG HI JK LM NP QR ST UV WX YZ');

            expect($reflector)->toBeInstanceOf(ReflectorDora::class);
        });
    });

    describe('historical accuracy', function (): void {
        /**
         * Test based on historical UKW-D usage by the Luftwaffe (1944).
         *
         * The UKW-D was introduced in January 1944 by the German Air Force.
         * This test verifies the reciprocal encoding property that was
         * fundamental to all Enigma operations.
         *
         * @see https://www.cryptomuseum.com/crypto/enigma/ukwd/index.htm
         */
        it('verifies reciprocal encoding with historical-style configuration', function (): void {
            // Create a Luftwaffe-style configuration with UKW-D
            // Rotors I, II, III were standard issue
            $createEnigma = function () {
                $enigma = new Enigma(
                    EnigmaModel::WMLW,
                    new RotorConfiguration(
                        p1: RotorType::I,
                        p2: RotorType::II,
                        p3: RotorType::III,
                        ringstellungP1: Letter::A,
                        ringstellungP2: Letter::A,
                        ringstellungP3: Letter::A,
                    ),
                    ReflectorType::B
                );

                // Mount a UKW-D with a plausible historical configuration
                // The wiring would have been specified on the key sheet
                $ukwD = ReflectorDora::fromString('AC BO DE FG HI JK LM NP QR ST UV WX YZ');
                $enigma->mountReflector($ukwD);

                // Set initial rotor positions (Grundstellung)
                $enigma->setPosition(JulienBoudry\EnigmaMachine\RotorPosition::P1, Letter::A);
                $enigma->setPosition(JulienBoudry\EnigmaMachine\RotorPosition::P2, Letter::A);
                $enigma->setPosition(JulienBoudry\EnigmaMachine\RotorPosition::P3, Letter::A);

                // Add some plugboard connections (Stecker)
                $enigma->plugLettersFromPairs('AM ET GZ');

                return $enigma;
            };

            $enigma1 = $createEnigma();
            $enigma2 = $createEnigma();

            // A typical military message format
            $plaintext = 'KEINEZUSAETZEZUDEMVORANGEGANGENENFUNKSPRUCH';
            $ciphertext = $enigma1->encodeLetters($plaintext);

            // Verify the fundamental Enigma property: same settings decode the message
            $decoded = $enigma2->encodeLetters($ciphertext);

            expect($decoded)->toBe($plaintext);
        });

        /**
         * Test that no letter encrypts to itself (Enigma fundamental property).
         * This property was a cryptographic weakness but was inherent to all Enigma machines.
         */
        it('ensures no letter encrypts to itself', function (): void {
            $enigma = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::DORA
            );

            // Test each letter at the initial position
            foreach (Letter::cases() as $letter) {
                // Clone to reset state for each test
                $testEnigma = clone $enigma;
                $encoded = $testEnigma->encodeLetter($letter);

                expect($encoded)->not->toBe($letter, "Letter {$letter->toChar()} encrypted to itself!");
            }
        });

        /**
         * The default wiring includes B↔O which was historically fixed
         * on the physical device due to mechanical constraints.
         */
        it('default wiring includes historical B↔O pair', function (): void {
            $reflector = ReflectorDora::withDefaultWiring();

            // The default should have B↔O as per historical device
            expect($reflector->processLetter(Letter::B)->toChar())->toBe('O');
            expect($reflector->processLetter(Letter::O)->toChar())->toBe('B');
        });
    });
});
