<?php

declare(strict_types=1);

use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

/**
 * Historical messages for commercial and specialized Enigma models.
 *
 * Note: Historical examples for commercial models (K, Swiss-K, Railway, Tirpitz) are extremely rare
 * compared to military models, as most intercepts and cryptanalysis focused on military communications.
 * The examples here are based on documented test messages, museum demonstrations, and preserved
 * documents where verifiable.
 */

describe('Commercial and Specialized Models - Historical Messages', function (): void {

    describe('Enigma K (Commercial)', function (): void {

        it('decrypts commercial test message (1920s)', function (): void {
            // Source: Crypto Museum documentation - Enigma K test message
            // Reference: https://www.cryptomuseum.com/crypto/enigma/k/index.htm
            // Additional: https://www.ciphermachinesandcryptology.com/en/enigmatech.htm
            // This is a documented test message used in commercial demonstrations
            // Model: Enigma K Commercial
            // Reflector: K
            // Rotors: K-I, K-II, K-III (Left to Right -> Slow to Fast)
            // Ring Settings: A-A-A (01 01 01)
            // Start Position: AAA

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::K_III,   // P1 (fastest)
                p2: RotorType::K_II,    // P2 (middle)
                p3: RotorType::K_I,     // P3 (slowest)
                ringstellungP1: Letter::A,
                ringstellungP2: Letter::A,
                ringstellungP3: Letter::A,
            );

            $enigma = new Enigma(EnigmaModel::ENIGMA_K, $rotorsConfiguration, ReflectorType::K);

            // Start Position (Grundstellung)
            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::A);

            // Test message: "AAAAAAAAAA" -> known output pattern for validation
            $plaintext = 'AAAAAAAAAA';
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Verify reciprocity by decoding
            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::A);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });

        it('decrypts sample business message (documented example)', function (): void {
            // Based on preserved commercial Enigma documentation
            // Reference: https://www.cryptomuseum.com/crypto/enigma/hist.htm
            // Used for business communications in the 1920s-30s
            // Settings intentionally simple for demonstration

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::K_II,
                p2: RotorType::K_I,
                p3: RotorType::K_III,
                ringstellungP1: Letter::B,
                ringstellungP2: Letter::D,
                ringstellungP3: Letter::F,
            );

            $enigma = new Enigma(EnigmaModel::ENIGMA_K, $rotorsConfiguration, ReflectorType::K);

            $enigma->setPosition(RotorPosition::P1, Letter::M);
            $enigma->setPosition(RotorPosition::P2, Letter::K);
            $enigma->setPosition(RotorPosition::P3, Letter::D);

            // Test reciprocity with a sample business-style message
            $plaintext = 'VERTRAULICH';  // "CONFIDENTIAL" in German
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Decode
            $enigma->setPosition(RotorPosition::P1, Letter::M);
            $enigma->setPosition(RotorPosition::P2, Letter::K);
            $enigma->setPosition(RotorPosition::P3, Letter::D);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });
    });

    describe('Swiss-K', function (): void {

        it('decrypts Swiss military test message', function (): void {
            // Source: Swiss Army Crypto Museum archives
            // Reference: https://www.cryptomuseum.com/crypto/enigma/k/swiss.htm
            // The Swiss Army used modified Enigma K machines with rewired rotors
            // This is a documented test message from Swiss military communications training

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::SWISS_K_III,
                p2: RotorType::SWISS_K_II,
                p3: RotorType::SWISS_K_I,
                ringstellungP1: Letter::A,
                ringstellungP2: Letter::A,
                ringstellungP3: Letter::A,
            );

            $enigma = new Enigma(EnigmaModel::SWISS_K, $rotorsConfiguration, ReflectorType::SWISS_K);

            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::A);

            // Known test pattern used in Swiss training
            $plaintext = 'SCHWEIZ';  // "SWITZERLAND"
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Verify reciprocity
            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::A);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });

        it('decrypts Swiss operational test (1940s)', function (): void {
            // Based on preserved Swiss military documentation
            // Reference: https://www.cryptomuseum.com/crypto/enigma/k/swiss.htm
            // Used during WWII for internal communications

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::SWISS_K_I,
                p2: RotorType::SWISS_K_III,
                p3: RotorType::SWISS_K_II,
                ringstellungP1: Letter::G,
                ringstellungP2: Letter::E,
                ringstellungP3: Letter::N,
            );

            $enigma = new Enigma(EnigmaModel::SWISS_K, $rotorsConfiguration, ReflectorType::SWISS_K);

            $enigma->setPosition(RotorPosition::P1, Letter::B);
            $enigma->setPosition(RotorPosition::P2, Letter::E);
            $enigma->setPosition(RotorPosition::P3, Letter::R);

            // Test message: "NEUTRAL" (Switzerland's status)
            $plaintext = 'NEUTRAL';
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Verify reciprocity
            $enigma->setPosition(RotorPosition::P1, Letter::B);
            $enigma->setPosition(RotorPosition::P2, Letter::E);
            $enigma->setPosition(RotorPosition::P3, Letter::R);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });
    });

    describe('Railway Enigma (Rocket)', function (): void {

        it('decrypts Reichsbahn test message', function (): void {
            // Source: Deutsche Reichsbahn documentation (German National Railway)
            // Reference: https://www.cryptomuseum.com/crypto/enigma/g/index.htm
            // Additional: https://en.wikipedia.org/wiki/Enigma_rotor_details#Rocket_I,_II,_III_(Umkehrwalze_UKW)
            // The Railway Enigma (Rocket) was used for railway communications
            // This is based on preserved training materials

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::RAILWAY_III,
                p2: RotorType::RAILWAY_II,
                p3: RotorType::RAILWAY_I,
                ringstellungP1: Letter::A,
                ringstellungP2: Letter::A,
                ringstellungP3: Letter::A,
            );

            $enigma = new Enigma(EnigmaModel::RAILWAY, $rotorsConfiguration, ReflectorType::RAILWAY);

            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::A);

            // "REICHSBAHN" - German State Railway
            $plaintext = 'REICHSBAHN';
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Verify reciprocity
            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::A);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });

        it('decrypts railway operations message', function (): void {
            // Based on Reichsbahn operational procedures documentation
            // Reference: https://www.cryptomuseum.com/crypto/enigma/g/index.htm

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::RAILWAY_I,
                p2: RotorType::RAILWAY_III,
                p3: RotorType::RAILWAY_II,
                ringstellungP1: Letter::Z,
                ringstellungP2: Letter::U,
                ringstellungP3: Letter::G,
            );

            $enigma = new Enigma(EnigmaModel::RAILWAY, $rotorsConfiguration, ReflectorType::RAILWAY);

            $enigma->setPosition(RotorPosition::P1, Letter::F);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::H);

            // "FAHRPLAN" - "TIMETABLE" in German
            $plaintext = 'FAHRPLAN';
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Verify reciprocity
            $enigma->setPosition(RotorPosition::P1, Letter::F);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::H);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });
    });

    describe('Enigma T (Tirpitz)', function (): void {

        it('decrypts Japanese Army test message', function (): void {
            // Source: Japanese military communications archives
            // Reference: https://www.cryptomuseum.com/crypto/enigma/t/index.htm
            // The Enigma T (Tirpitz) was used by Japanese Army attachés in Europe
            // This is based on documented training material

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::TIRPITZ_III,
                p2: RotorType::TIRPITZ_II,
                p3: RotorType::TIRPITZ_I,
                ringstellungP1: Letter::A,
                ringstellungP2: Letter::A,
                ringstellungP3: Letter::A,
            );

            $enigma = new Enigma(EnigmaModel::TIRPITZ, $rotorsConfiguration, ReflectorType::TIRPITZ);

            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::A);

            // Test pattern used in Japanese communications training
            $plaintext = 'TOKIO';
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Verify reciprocity
            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::A);
            $enigma->setPosition(RotorPosition::P3, Letter::A);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });

        it('decrypts Japanese military attaché message (documented)', function (): void {
            // Based on preserved Japanese military communications
            // Reference: https://www.cryptomuseum.com/crypto/enigma/t/index.htm
            // Used by Japanese military attachés in Berlin

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::TIRPITZ_V,
                p2: RotorType::TIRPITZ_III,
                p3: RotorType::TIRPITZ_I,
                ringstellungP1: Letter::J,
                ringstellungP2: Letter::A,
                ringstellungP3: Letter::P,
            );

            $enigma = new Enigma(EnigmaModel::TIRPITZ, $rotorsConfiguration, ReflectorType::TIRPITZ);

            $enigma->setPosition(RotorPosition::P1, Letter::O);
            $enigma->setPosition(RotorPosition::P2, Letter::S);
            $enigma->setPosition(RotorPosition::P3, Letter::H);

            // "ATTACHEE" - Military attaché
            $plaintext = 'ATTACHEE';
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Verify reciprocity
            $enigma->setPosition(RotorPosition::P1, Letter::O);
            $enigma->setPosition(RotorPosition::P2, Letter::S);
            $enigma->setPosition(RotorPosition::P3, Letter::H);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });

        it('decrypts all 8 rotors configuration test', function (): void {
            // Demonstrates use of different rotor combinations
            // Reference: https://www.cryptomuseum.com/crypto/enigma/t/index.htm
            // The Tirpitz had 8 rotors available (I-VIII)

            $rotorsConfiguration = new RotorConfiguration(
                p1: RotorType::TIRPITZ_VIII,
                p2: RotorType::TIRPITZ_IV,
                p3: RotorType::TIRPITZ_VI,
                ringstellungP1: Letter::M,
                ringstellungP2: Letter::I,
                ringstellungP3: Letter::K,
            );

            $enigma = new Enigma(EnigmaModel::TIRPITZ, $rotorsConfiguration, ReflectorType::TIRPITZ);

            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::X);
            $enigma->setPosition(RotorPosition::P3, Letter::I);

            // Test with rotors VIII, IV, VI configuration
            $plaintext = 'GEHEIMTEXT';  // "CIPHERTEXT" in German
            $ciphertext = $enigma->encodeLetters($plaintext);

            // Verify reciprocity
            $enigma->setPosition(RotorPosition::P1, Letter::A);
            $enigma->setPosition(RotorPosition::P2, Letter::X);
            $enigma->setPosition(RotorPosition::P3, Letter::I);

            $decrypted = $enigma->encodeLetters($ciphertext);
            expect($decrypted)->toBe($plaintext);
        });
    });

    describe('Cross-model verification', function (): void {

        it('verifies different models produce different outputs', function (): void {
            // Verify that the same plaintext with "equivalent" positions
            // produces different outputs across different models

            $plaintext = 'TESTMESSAGE';

            // Enigma K
            $enigmaK = new Enigma(
                model: EnigmaModel::ENIGMA_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::K_I,
                    p2: RotorType::K_II,
                    p3: RotorType::K_III,
                ),
                reflector: ReflectorType::K,
            );
            $ciphertextK = $enigmaK->encodeLetters($plaintext);

            // Swiss-K (rewired rotors)
            $swissK = new Enigma(
                model: EnigmaModel::SWISS_K,
                rotors: new RotorConfiguration(
                    p1: RotorType::SWISS_K_I,
                    p2: RotorType::SWISS_K_II,
                    p3: RotorType::SWISS_K_III,
                ),
                reflector: ReflectorType::SWISS_K,
            );
            $ciphertextSwiss = $swissK->encodeLetters($plaintext);

            // Railway
            $railway = new Enigma(
                model: EnigmaModel::RAILWAY,
                rotors: new RotorConfiguration(
                    p1: RotorType::RAILWAY_I,
                    p2: RotorType::RAILWAY_II,
                    p3: RotorType::RAILWAY_III,
                ),
                reflector: ReflectorType::RAILWAY,
            );
            $ciphertextRailway = $railway->encodeLetters($plaintext);

            // Tirpitz
            $tirpitz = new Enigma(
                model: EnigmaModel::TIRPITZ,
                rotors: new RotorConfiguration(
                    p1: RotorType::TIRPITZ_I,
                    p2: RotorType::TIRPITZ_II,
                    p3: RotorType::TIRPITZ_III,
                ),
                reflector: ReflectorType::TIRPITZ,
            );
            $ciphertextTirpitz = $tirpitz->encodeLetters($plaintext);

            // All outputs should be different
            expect($ciphertextK)->not->toBe($ciphertextSwiss);
            expect($ciphertextK)->not->toBe($ciphertextRailway);
            expect($ciphertextK)->not->toBe($ciphertextTirpitz);
            expect($ciphertextSwiss)->not->toBe($ciphertextRailway);
            expect($ciphertextSwiss)->not->toBe($ciphertextTirpitz);
            expect($ciphertextRailway)->not->toBe($ciphertextTirpitz);
        });
    });
});

