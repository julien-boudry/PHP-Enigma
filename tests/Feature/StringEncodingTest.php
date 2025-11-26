<?php

declare(strict_types=1);

use JulienBoudry\Enigma\{Enigma, EnigmaModel, EnigmaTextConverter, ReflectorType, RotorPosition, RotorType};

describe('Enigma string encoding', function (): void {
    beforeEach(function (): void {
        $this->enigma = new Enigma(
            EnigmaModel::WMLW,
            [RotorType::I, RotorType::II, RotorType::III],
            ReflectorType::B
        );
        $this->enigma->setPosition(RotorPosition::P1, 'A');
        $this->enigma->setPosition(RotorPosition::P2, 'A');
        $this->enigma->setPosition(RotorPosition::P3, 'A');
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
            // Reset to same position for decoding
            $enigma1 = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $enigma1->setPosition(RotorPosition::P1, 'A');
            $enigma1->setPosition(RotorPosition::P2, 'A');
            $enigma1->setPosition(RotorPosition::P3, 'A');

            $enigma2 = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $enigma2->setPosition(RotorPosition::P1, 'A');
            $enigma2->setPosition(RotorPosition::P2, 'A');
            $enigma2->setPosition(RotorPosition::P3, 'A');

            $plaintext = 'HELLOWORLD';
            $ciphertext = $enigma1->encodeLetters($plaintext);
            $decrypted = $enigma2->encodeLetters($ciphertext);

            expect($decrypted)->toBe($plaintext);
        });

        test('throws exception for invalid characters', function (): void {
            expect(fn () => $this->enigma->encodeLetters('HELLO WORLD'))
                ->toThrow(\RuntimeException::class);
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
            $enigma1 = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $enigma1->setPosition(RotorPosition::P1, 'A');
            $enigma1->setPosition(RotorPosition::P2, 'A');
            $enigma1->setPosition(RotorPosition::P3, 'A');

            $enigma2 = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $enigma2->setPosition(RotorPosition::P1, 'A');
            $enigma2->setPosition(RotorPosition::P2, 'A');
            $enigma2->setPosition(RotorPosition::P3, 'A');

            // Convert text first, then encode, then decode
            $originalText = 'Hello World 123';
            $convertedText = EnigmaTextConverter::latinToEnigmaFormat($originalText);

            $ciphertext = $enigma1->encodeLetters($convertedText);
            $decrypted = $enigma2->encodeLetters($ciphertext);

            expect($decrypted)->toBe($convertedText);
        });

        test('handles empty string', function (): void {
            expect($this->enigma->encodeLatinText(''))->toBe('');
        });

        test('uses custom space replacement', function (): void {
            $enigma1 = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $enigma1->setPosition(RotorPosition::P1, 'A');
            $enigma1->setPosition(RotorPosition::P2, 'A');
            $enigma1->setPosition(RotorPosition::P3, 'A');

            $enigma2 = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $enigma2->setPosition(RotorPosition::P1, 'A');
            $enigma2->setPosition(RotorPosition::P2, 'A');
            $enigma2->setPosition(RotorPosition::P3, 'A');

            $ciphertext = $enigma1->encodeLatinText('A B', spaceReplacement: 'QQ');
            $decrypted = $enigma2->encodeLetters($ciphertext);

            expect($decrypted)->toBe('AQQB');
        });
    });

    describe('encodeBinary', function (): void {
        test('encodes binary data', function (): void {
            $result = $this->enigma->encodeBinary("\x00\x01\x02");
            expect($result)->toHaveLength(6); // 3 bytes = 6 chars
        });

        test('roundtrip binary encoding/decoding', function (): void {
            $enigma1 = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $enigma1->setPosition(RotorPosition::P1, 'A');
            $enigma1->setPosition(RotorPosition::P2, 'A');
            $enigma1->setPosition(RotorPosition::P3, 'A');

            $enigma2 = new Enigma(
                EnigmaModel::WMLW,
                [RotorType::I, RotorType::II, RotorType::III],
                ReflectorType::B
            );
            $enigma2->setPosition(RotorPosition::P1, 'A');
            $enigma2->setPosition(RotorPosition::P2, 'A');
            $enigma2->setPosition(RotorPosition::P3, 'A');

            $originalBinary = "\x00\x0F\xFF";
            $enigmaFormat = EnigmaTextConverter::binaryToEnigmaFormat($originalBinary);
            $encrypted = $enigma1->encodeLetters($enigmaFormat);
            $decrypted = $enigma2->encodeLetters($encrypted);
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
    });
});
