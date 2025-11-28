<?php

declare(strict_types=1);

use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, EnigmaTextConverter, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

describe('Enigma string encoding', function (): void {
    beforeEach(function (): void {
        $this->enigma = new Enigma(
            EnigmaModel::WMLW,
            new RotorConfiguration(
                p1: RotorType::I,
                p2: RotorType::II,
                p3: RotorType::III,
            ),
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
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
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
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
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
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
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
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
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
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::C);
            $encoder->setPosition(RotorPosition::P2, Letter::F);
            $encoder->setPosition(RotorPosition::P3, Letter::G);
            $encoder->plugLettersFromPairs('AB CD EF GH');

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

    describe('encodeFile', function (): void {
        test('encodes file using paths', function (): void {
            $sourceFile = __DIR__ . '/../Assets/Enigma-logo.png';
            $destFile = sys_get_temp_dir() . '/enigma_test_encoded_' . uniqid() . '.txt';

            try {
                // Create encoder
                $encoder = new Enigma(
                    EnigmaModel::WMLW,
                    new RotorConfiguration(
                        p1: RotorType::I,
                        p2: RotorType::II,
                        p3: RotorType::III,
                    ),
                    ReflectorType::B
                );
                $encoder->setPosition(RotorPosition::P1, Letter::A);
                $encoder->setPosition(RotorPosition::P2, Letter::A);
                $encoder->setPosition(RotorPosition::P3, Letter::A);

                $bytesWritten = $encoder->encodeFile($sourceFile, $destFile);

                expect($bytesWritten)->toBeGreaterThan(0);
                expect(file_exists($destFile))->toBeTrue();

                // Verify output is valid Enigma format
                $encodedContent = file_get_contents($destFile);
                expect(EnigmaTextConverter::isValidEnigmaFormat($encodedContent))->toBeTrue();
            } finally {
                if (file_exists($destFile)) {
                    unlink($destFile);
                }
            }
        });

        test('encodes file using SplFileObject', function (): void {
            $sourceFile = __DIR__ . '/../Assets/Enigma-logo.png';
            $destFile = sys_get_temp_dir() . '/enigma_test_encoded_spl_' . uniqid() . '.txt';


            $source = new SplFileObject($sourceFile, 'rb');
            $dest = new SplTempFileObject;

            $encoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::A);
            $encoder->setPosition(RotorPosition::P2, Letter::A);
            $encoder->setPosition(RotorPosition::P3, Letter::A);

            $bytesWritten = $encoder->encodeFile($source, $dest);

            expect($bytesWritten)->toBeGreaterThan(0);
        });

        test('roundtrip file encoding/decoding preserves integrity', function (): void {
            $sourceFile = __DIR__ . '/../Assets/Enigma-logo.png';
            $encoded = new SplTempFileObject;
            $decoded = new SplTempFileObject;

            // Create encoder
            $encoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::A);
            $encoder->setPosition(RotorPosition::P2, Letter::A);
            $encoder->setPosition(RotorPosition::P3, Letter::A);

            // Clone encoder to create decoder with same initial state
            $decoder = clone $encoder;

            // Encode the file
            $encoder->encodeFile($sourceFile, $encoded);

            // Decode using decodeFile
            $encoded->rewind();
            $decoder->decodeFile($encoded, $decoded);

            // Read decoded content
            $decoded->rewind();
            $recoveredBinary = $decoded->fread($decoded->fstat()['size']);

            // Verify files are identical
            expect($recoveredBinary)->toBe(file_get_contents($sourceFile));
        });

        test('produces same output as encodeBinary for small files', function (): void {
            $sourceFile = __DIR__ . '/../Assets/Enigma-logo.png';
            $dest = new SplTempFileObject;

            // Method 1: encodeFile with small chunks
            $originalChunkSize = Enigma::$fileChunkSize;
            Enigma::$fileChunkSize = 1024; // Small chunks for testing

            $encoder1 = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );
            $encoder1->setPosition(RotorPosition::P1, Letter::A);
            $encoder1->setPosition(RotorPosition::P2, Letter::A);
            $encoder1->setPosition(RotorPosition::P3, Letter::A);
            $encoder1->encodeFile($sourceFile, $dest);

            Enigma::$fileChunkSize = $originalChunkSize; // Restore

            // Read result from SplTempFileObject
            $dest->rewind();
            $fileResult = $dest->fread($dest->fstat()['size']);

            // Method 2: encodeBinary (all at once)
            $encoder2 = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );
            $encoder2->setPosition(RotorPosition::P1, Letter::A);
            $encoder2->setPosition(RotorPosition::P2, Letter::A);
            $encoder2->setPosition(RotorPosition::P3, Letter::A);

            $binaryResult = $encoder2->encodeBinary(file_get_contents($sourceFile));

            // Results should be identical
            expect($fileResult)->toBe($binaryResult);
        });

        test('throws exception for non-existent source file', function (): void {
            $encoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );

            expect(fn() => $encoder->encodeFile('/nonexistent/file.txt', '/tmp/output.txt'))
                ->toThrow(RuntimeException::class, 'Cannot open source file');
        });

        test('throws exception for non-writable destination', function (): void {
            $encoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );
            $sourceFile = __DIR__ . '/../Assets/Enigma-logo.png';

            expect(fn() => $encoder->encodeFile($sourceFile, '/nonexistent/directory/output.txt'))
                ->toThrow(RuntimeException::class, 'Cannot open destination file');
        });

        test('returns correct byte count', function (): void {
            $sourceFile = __DIR__ . '/../Assets/Enigma-logo.png';
            $dest = new SplTempFileObject;

            $encoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );

            $bytesWritten = $encoder->encodeFile($sourceFile, $dest);
            $actualSize = $dest->fstat()['size'];

            expect($bytesWritten)->toBe($actualSize);
        });

        test('handles empty file', function (): void {
            // Create empty source using SplTempFileObject
            $source = new SplTempFileObject;
            $dest = new SplTempFileObject;

            $encoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );

            $bytesWritten = $encoder->encodeFile($source, $dest);

            expect($bytesWritten)->toBe(0);
            expect($dest->fstat()['size'])->toBe(0);
        });
    });

    describe('decodeFile', function (): void {
        test('decodes file using SplFileObject', function (): void {
            $sourceFile = __DIR__ . '/../Assets/Enigma-logo.png';
            $encoded = new SplTempFileObject;
            $decoded = new SplTempFileObject;

            $encoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::A);
            $encoder->setPosition(RotorPosition::P2, Letter::A);
            $encoder->setPosition(RotorPosition::P3, Letter::A);

            $decoder = clone $encoder;

            // Encode
            $encoder->encodeFile($sourceFile, $encoded);

            // Decode
            $encoded->rewind();
            $bytesWritten = $decoder->decodeFile($encoded, $decoded);

            expect($bytesWritten)->toBeGreaterThan(0);
            expect($bytesWritten)->toBe(filesize($sourceFile));
        });

        test('decodes to identical binary as original', function (): void {
            $originalData = file_get_contents(__DIR__ . '/../Assets/Enigma-logo.png');
            $source = new SplTempFileObject;
            $source->fwrite($originalData);
            $source->rewind();

            $encoded = new SplTempFileObject;
            $decoded = new SplTempFileObject;

            $encoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );
            $encoder->setPosition(RotorPosition::P1, Letter::A);
            $encoder->setPosition(RotorPosition::P2, Letter::A);
            $encoder->setPosition(RotorPosition::P3, Letter::A);

            $decoder = clone $encoder;

            // Encode
            $encoder->encodeFile($source, $encoded);

            // Decode
            $encoded->rewind();
            $decoder->decodeFile($encoded, $decoded);

            // Compare
            $decoded->rewind();
            $decodedData = $decoded->fread($decoded->fstat()['size']);

            expect($decodedData)->toBe($originalData);
        });

        test('handles empty encoded file', function (): void {
            $source = new SplTempFileObject;
            $dest = new SplTempFileObject;

            $decoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );

            $bytesWritten = $decoder->decodeFile($source, $dest);

            expect($bytesWritten)->toBe(0);
            expect($dest->fstat()['size'])->toBe(0);
        });

        test('throws exception for non-existent source file', function (): void {
            $decoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );

            expect(fn() => $decoder->decodeFile('/nonexistent/file.txt', '/tmp/output.bin'))
                ->toThrow(RuntimeException::class, 'Cannot open source file');
        });

        test('throws exception for non-writable destination', function (): void {
            $source = new SplTempFileObject;
            $source->fwrite('ABCD'); // Valid Enigma format
            $source->rewind();

            $decoder = new Enigma(
                EnigmaModel::WMLW,
                new RotorConfiguration(
                    p1: RotorType::I,
                    p2: RotorType::II,
                    p3: RotorType::III,
                ),
                ReflectorType::B
            );

            expect(fn() => $decoder->decodeFile($source, '/nonexistent/directory/output.bin'))
                ->toThrow(RuntimeException::class, 'Cannot open destination file');
        });
    });
});
