<?php

declare(strict_types=1);

use JulienBoudry\Enigma\{Enigma, EnigmaModel, EnigmaTextConverter, Letter, ReflectorType, RotorPosition, RotorType};

describe('Enigma string encoding', function (): void {
    beforeEach(function (): void {
        $this->enigma = new Enigma(
            EnigmaModel::WMLW,
            [RotorType::I, RotorType::II, RotorType::III],
            ReflectorType::B
        );
        $this->enigma->setPosition(RotorPosition::P1, Letter::A);
        $this->enigma->setPosition(RotorPosition::P2, Letter::A);
        $this->enigma->setPosition(RotorPosition::P3, Letter::A);
    });

    describe('encodeLetters', function (): void {
        test('encodes a simple string', function (): void {
            $result = $this->enigma->encodeLetters('HELLO');
            expect($result)->toHaveLength(5);
            expect(EnigmaTextConverter::isValidEnigmaFormat($result))->toBeTrue();
        });

        test('handles lowercase input', function (): void {
            $result = $this->enigma->encodeLetters('hello');
            expect($result)->toHaveLength(5);
        });

        test('encoding then decoding returns original', function (): void {
            // Create encoder
            $encoder = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::A);
            $encoder->setPosition(RotorPosition::P2, Letter::A);
            $encoder->setPosition(RotorPosition::P3, Letter::A);

            // Clone encoder to create decoder with same initial state
            $decoder = clone $encoder;

            $plaintext = 'HELLOWORLD';
            $ciphertext = $encoder->encodeLetters($plaintext);
            $decrypted = $decoder->encodeLetters($ciphertext);

            expect($decrypted)->toBe($plaintext);
        });

        test('throws exception for invalid characters', function (): void {
            expect(fn() => $this->enigma->encodeLetters('HELLO WORLD'))
                ->toThrow(ValueError::class);
        });

        test('handles empty string', function (): void {
            expect($this->enigma->encodeLetters(''))->toBe('');
        });
    });

    describe('encodeLatinText', function (): void {
        test('encodes text with spaces', function (): void {
            $result = $this->enigma->encodeLatinText('HELLO WORLD');
            // "HELLO WORLD" becomes "HELLOXWORLD" (11 chars)
            expect($result)->toHaveLength(11);
        });

        test('encodes text with numbers', function (): void {
            $result = $this->enigma->encodeLatinText('AGENT 007');
            // "AGENT 007" becomes "AGENTXNULLNULLSIEBEN"
            expect(EnigmaTextConverter::isValidEnigmaFormat($result))->toBeTrue();
        });

        test('encodes text with accents', function (): void {
            $result = $this->enigma->encodeLatinText('MÜNCHEN');
            expect(EnigmaTextConverter::isValidEnigmaFormat($result))->toBeTrue();
        });

        test('formats output in groups when requested', function (): void {
            $result = $this->enigma->encodeLatinText('HELLO WORLD', formatOutput: true);
            expect($result)->toContain(' ');
        });

        test('encoding then decoding with text conversion', function (): void {
            $encoder = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::A);
            $encoder->setPosition(RotorPosition::P2, Letter::A);
            $encoder->setPosition(RotorPosition::P3, Letter::A);

            // Clone encoder to create decoder with same initial state
            $decoder = clone $encoder;

            // Convert text first, then encode, then decode
            $originalText = 'Hello World 123';
            $convertedText = EnigmaTextConverter::latinToEnigmaFormat($originalText);

            $ciphertext = $encoder->encodeLetters($convertedText);
            $decrypted = $decoder->encodeLetters($ciphertext);

            expect($decrypted)->toBe($convertedText);
        });

        test('handles empty string', function (): void {
            expect($this->enigma->encodeLatinText(''))->toBe('');
        });

        test('uses custom space replacement', function (): void {
            $encoder = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::A);
            $encoder->setPosition(RotorPosition::P2, Letter::A);
            $encoder->setPosition(RotorPosition::P3, Letter::A);

            // Clone encoder to create decoder with same initial state
            $decoder = clone $encoder;

            $ciphertext = $encoder->encodeLatinText('A B', spaceReplacement: 'QQ');
            $decrypted = $decoder->encodeLetters($ciphertext);

            expect($decrypted)->toBe('AQQB');
        });
    });

    describe('encodeBinary', function (): void {
        test('encodes binary data', function (): void {
            $result = $this->enigma->encodeBinary("\x00\x01\x02");
            expect($result)->toHaveLength(6); // 3 bytes = 6 chars
        });

        test('roundtrip binary encoding/decoding', function (): void {
            $encoder = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::A);
            $encoder->setPosition(RotorPosition::P2, Letter::A);
            $encoder->setPosition(RotorPosition::P3, Letter::A);

            // Clone encoder to create decoder with same initial state
            $decoder = clone $encoder;

            $originalBinary = "\x00\x0F\xFF";
            $enigmaFormat = EnigmaTextConverter::binaryToEnigmaFormat($originalBinary);
            $encrypted = $encoder->encodeLetters($enigmaFormat);
            $decrypted = $decoder->encodeLetters($encrypted);
            $recoveredBinary = EnigmaTextConverter::enigmaFormatToBinary($decrypted);

            expect($recoveredBinary)->toBe($originalBinary);
        });

        test('formats binary output in groups when requested', function (): void {
            $result = $this->enigma->encodeBinary("\x00\x01\x02\x03\x04\x05", formatOutput: true);
            expect($result)->toContain(' ');
        });

        test('handles empty binary input', function (): void {
            expect($this->enigma->encodeBinary(''))->toBe('');
        });

        test('roundtrip PNG file encoding/decoding preserves integrity', function (): void {
            // Load the PNG file
            $originalPngData = file_get_contents(__DIR__ . '/../Assets/Enigma-logo.png');

            // Create encoder
            $encoder = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::C);
            $encoder->setPosition(RotorPosition::P2, Letter::F);
            $encoder->setPosition(RotorPosition::P3, Letter::G);
            $encoder->plugLetters(Letter::A, Letter::B);
            $encoder->plugLetters(Letter::C, Letter::D);
            $encoder->plugLetters(Letter::E, Letter::F);
            $encoder->plugLetters(Letter::G, Letter::H);

            // Clone encoder to create decoder with same initial state
            $decoder = clone $encoder;

            // Encode the binary PNG data
            $encrypted = $encoder->encodeBinary($originalPngData);

            // Decode it back
            $decrypted = $decoder->encodeLetters($encrypted);
            $recoveredPngData = EnigmaTextConverter::enigmaFormatToBinary($decrypted);

            // Verify data is identical
            expect($recoveredPngData)->toBe($originalPngData);
        });
    });
});
