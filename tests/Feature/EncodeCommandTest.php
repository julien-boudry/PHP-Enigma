<?php

declare(strict_types=1);

use JulienBoudry\EnigmaMachine\Console\EncodeCommand;
use Laravel\Prompts\Prompt;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Tester\CommandTester;

beforeEach(function (): void {
    // Redirect Laravel Prompts output to the buffered output
    $this->promptOutput = new BufferedOutput;
    Prompt::setOutput($this->promptOutput);

    $application = new Application;
    $application->addCommand(new EncodeCommand);
    $this->command = $application->find('encode');
    $this->commandTester = new CommandTester($this->command);
});

/**
 * Execute command and get combined output from command tester and Laravel Prompts.
 */
function executeAndGetOutput(CommandTester $tester, BufferedOutput $promptOutput, array $input): string
{
    $promptOutput->fetch(); // Clear any previous output
    $tester->execute($input);

    return $tester->getDisplay() . $promptOutput->fetch();
}

describe('EncodeCommand', function (): void {
    describe('Basic Text Encoding', function (): void {
        it('encodes simple text with default settings', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => 'HELLO']);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($this->commandTester->getDisplay())->toContain('MFNCZ');
        });

        it('encodes text and decodes back to original (reciprocal)', function (): void {
            // Encode
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => 'HELLOWORLD']);
            // Extract encoded text from the new military-style output (│ RESULT format)
            $encoded = trim(preg_replace('/.*│\s*(\w+).*/s', '$1', $this->commandTester->getDisplay()));

            // Decode with same settings
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => $encoded]);
            expect($this->commandTester->getDisplay())->toContain('HELLOWORLD');
        });

        it('handles lowercase input', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => 'hello']);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($this->commandTester->getDisplay())->toContain('MFNCZ');
        });

        it('strips non-alphabetic characters from input', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => 'HELLO123WORLD']);

            expect($this->commandTester->getStatusCode())->toBe(0);
            // Should encode HELLOWORLD (123 stripped)
            expect($this->commandTester->getDisplay())->toContain('MFNCZBBFZM');
        });

        it('fails when no text is provided', function (): void {
            $this->commandTester->execute([], ['interactive' => false]);
            $output = $this->commandTester->getDisplay() . $this->promptOutput->fetch();

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('No text provided');
        });
    });

    describe('Rotor Configuration', function (): void {
        it('accepts custom rotor order', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--rotors' => 'V-II-IV',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            // Different rotors = different output
            expect($this->commandTester->getDisplay())->not->toContain('MFNCZ');
        });

        it('accepts custom ring settings', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--ring' => 'XYZ',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('accepts custom initial positions', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--position' => 'ABC',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('accepts custom reflector', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--reflector' => 'C',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('fails with invalid rotor name', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--rotors' => 'INVALID-II-I',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('Unknown rotor');
        });

        it('fails with wrong number of rotors for model', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--rotors' => 'I-II',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('requires 3 rotors');
        });

        it('fails with wrong number of ring settings', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--ring' => 'AB',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('requires 3 ring settings');
        });

        it('fails with wrong number of positions', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--position' => 'ABCD',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('requires 3 positions');
        });

        it('fails with invalid reflector', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--reflector' => 'INVALID',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('Unknown reflector');
        });
    });

    describe('Enigma Models', function (): void {
        it('supports Wehrmacht/Luftwaffe model (WMLW)', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'WMLW',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('supports Kriegsmarine M3 model (KMM3)', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'KMM3',
                '--rotors' => 'VI-VII-VIII',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('supports Kriegsmarine M4 model with 4 rotors', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'KMM4',
                '--rotors' => 'BETA-V-VI-VIII',
                '--ring' => 'AAAA',
                '--position' => 'AAAA',
                '--reflector' => 'BTHIN',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('supports Enigma K commercial model', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'ENIGMA_K',
                '--rotors' => 'K_III-K_II-K_I',
                '--reflector' => 'K',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('supports Swiss-K model', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'SWISS_K',
                '--rotors' => 'SWISS_K_III-SWISS_K_II-SWISS_K_I',
                '--reflector' => 'SWISS_K',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('supports Railway model', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'RAILWAY',
                '--rotors' => 'RAILWAY_III-RAILWAY_II-RAILWAY_I',
                '--reflector' => 'RAILWAY',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('supports Tirpitz model', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'TIRPITZ',
                '--rotors' => 'TIRPITZ_VIII-TIRPITZ_V-TIRPITZ_III',
                '--reflector' => 'TIRPITZ',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('fails with unknown model', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'UNKNOWN',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('Unknown model');
        });
    });

    describe('Plugboard', function (): void {
        it('accepts plugboard connections', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--plugboard' => 'AB CD EF',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('plugboard affects encoding', function (): void {
            // Without plugboard
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => 'HELLO']);
            $withoutPlugboard = $this->commandTester->getDisplay();

            // With plugboard
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--plugboard' => 'AB CD EF GH IJ KL MN OP QR ST',
            ]);
            $withPlugboard = $this->commandTester->getDisplay();

            expect($withPlugboard)->not->toBe($withoutPlugboard);
        });

        it('warns when plugboard used on commercial model', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'ENIGMA_K',
                '--rotors' => 'K_III-K_II-K_I',
                '--reflector' => 'K',
                '--plugboard' => 'AB CD',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('does not have a plugboard');
        });
    });

    describe('DORA Reflector Wiring (--dora-wiring)', function (): void {
        it('accepts custom DORA wiring', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'WMLW',
                '--reflector' => 'DORA',
                '--dora-wiring' => 'AQ BW CE DT FX GR HU IZ JK LN MO PS VY',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('custom DORA wiring affects encoding', function (): void {
            // With default DORA wiring
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'WMLW',
                '--reflector' => 'DORA',
            ]);
            $withDefault = $this->commandTester->getDisplay();

            // With custom DORA wiring (different from default)
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'WMLW',
                '--reflector' => 'DORA',
                '--dora-wiring' => 'AQ BW CE DT FX GR HU IZ JK LN MO PS VY',
            ]);
            $withCustom = $this->commandTester->getDisplay();

            expect($withCustom)->not->toBe($withDefault);
        });

        it('encoding with DORA is reciprocal', function (): void {
            $customWiring = 'AQ BW CE DT FX GR HU IZ JK LN MO PS VY';

            // Encode
            $this->commandTester->execute([
                'text' => 'HELLOWORLD',
                '--model' => 'WMLW',
                '--reflector' => 'DORA',
                '--dora-wiring' => $customWiring,
            ]);

            // Extract encoded text from the military-style output
            $encoded = trim(preg_replace('/.*│\s*(\w+).*/s', '$1', $this->commandTester->getDisplay()));

            // Decode with same settings
            $this->commandTester->execute([
                'text' => $encoded,
                '--model' => 'WMLW',
                '--reflector' => 'DORA',
                '--dora-wiring' => $customWiring,
            ]);

            expect($this->commandTester->getDisplay())->toContain('HELLOWORLD');
        });

        it('warns when --dora-wiring used without DORA reflector', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'WMLW',
                '--reflector' => 'B',
                '--dora-wiring' => 'AQ BW CE DT FX GR HU IZ JK LN MO PS VY',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('--dora-wiring is only valid with reflector DORA');
        });

        it('fails with invalid DORA wiring', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'WMLW',
                '--reflector' => 'DORA',
                '--dora-wiring' => 'INVALID',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
        });

        it('shows DORA configuration with --show-config', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'WMLW',
                '--reflector' => 'DORA',
                '--dora-wiring' => 'AQ BW CE DT FX GR HU IZ JK LN MO PS VY',
                '--show-config' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('DORA');
        });
    });

    describe('Latin Text Conversion (--latin)', function (): void {
        it('converts spaces to X', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO WORLD',
                '--latin' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('converts numbers to German words', function (): void {
            $this->commandTester->execute([
                'text' => 'TEST123',
                '--latin' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            // 123 = EINSZWEIDREI, so output is longer than without --latin
        });

        it('converts accented characters', function (): void {
            $this->commandTester->execute([
                'text' => 'Héllo Wörld',
                '--latin' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('handles punctuation', function (): void {
            $this->commandTester->execute([
                'text' => 'Hello, World!',
                '--latin' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });
    });

    describe('Output Formatting (--format)', function (): void {
        it('formats output in 5-letter groups', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLOWORLDTHISISATEST',
                '--format' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            // Check for space-separated groups
            expect($this->commandTester->getDisplay())->toMatch('/[A-Z]{5}\s+[A-Z]{5}/');
        });
    });

    describe('Strip Spaces (--strip-spaces)', function (): void {
        it('removes spaces from input', function (): void {
            $this->commandTester->execute([
                'text' => 'MFNCZ BBFZM',
                '--strip-spaces' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            // Should decode MFNCZBBFZM = HELLOWORLD
            expect($this->commandTester->getDisplay())->toContain('HELLOWORLD');
        });

        it('allows decoding formatted 5-letter groups', function (): void {
            // First encode with formatting
            $this->commandTester->execute([
                'text' => 'SECRETMESSAGE',
                '--format' => true,
            ]);
            $encoded = $this->commandTester->getDisplay();

            // Extract the formatted output from military-style format (│ RESULT format)
            preg_match('/│\s*([A-Z\s]+)\s*$/m', $encoded, $matches);
            $formattedOutput = trim($matches[1] ?? '');

            // Decode with strip-spaces
            $this->commandTester->execute([
                'text' => $formattedOutput,
                '--strip-spaces' => true,
            ]);

            expect($this->commandTester->getDisplay())->toContain('SECRETMESSAGE');
        });
    });

    describe('Show Configuration (--show-config)', function (): void {
        it('displays configuration table', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--show-config' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('Model');
            expect($output)->toContain('Rotors');
            expect($output)->toContain('Ring');
            expect($output)->toContain('Position');
            expect($output)->toContain('Reflector');
            expect($output)->toContain('Plugboard');
        });

        it('shows custom configuration values', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--rotors' => 'V-IV-III',
                '--ring' => 'XYZ',
                '--position' => 'ABC',
                '--plugboard' => 'AB CD',
                '--show-config' => true,
            ]);

            expect($output)->toContain('V-IV-III');
            expect($output)->toContain('XYZ');
            expect($output)->toContain('ABC');
            expect($output)->toContain('AB CD');
        });
    });

    describe('Random Configuration (--random)', function (): void {
        it('generates random configuration', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--random' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('randomly generated configuration');
        });

        it('random configuration produces different output than default', function (): void {
            // Default
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => 'HELLO']);
            $defaultOutput = $this->commandTester->getDisplay();

            // Random (almost certainly different)
            $outputs = [];
            for ($i = 0; $i < 5; $i++) {
                $this->commandTester->execute([
                    'text' => 'HELLO',
                    '--random' => true,
                ]);
                $outputs[] = $this->commandTester->getDisplay();
            }

            // At least one should be different (statistically almost certain)
            $allSame = \count(array_unique($outputs)) === 1 && $outputs[0] === $defaultOutput;
            expect($allSame)->toBeFalse();
        });

        it('random works with M4 model', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'KMM4',
                '--random' => true,
                '--show-config' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('KMM4');
        });
    });

    describe('Text File Input (--input-text-file)', function (): void {
        beforeEach(function (): void {
            $this->tempDir = sys_get_temp_dir();
            $this->textFile = $this->tempDir . '/enigma_test_' . uniqid() . '.txt';
        });

        afterEach(function (): void {
            if (file_exists($this->textFile)) {
                unlink($this->textFile);
            }
        });

        it('reads text from file', function (): void {
            file_put_contents($this->textFile, 'HELLOWORLD');

            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-text-file' => $this->textFile,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('Reading text from');
            expect($output)->toContain('MFNCZBBFZM');
        });

        it('warns about non-alphabetic characters in file', function (): void {
            file_put_contents($this->textFile, 'Hello World 123!');

            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-text-file' => $this->textFile,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('non-alphabetic characters');
            expect($output)->toContain('--latin');
        });

        it('does not warn when using --latin', function (): void {
            file_put_contents($this->textFile, 'Hello World 123!');

            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-text-file' => $this->textFile,
                '--latin' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->not->toContain('non-alphabetic characters');
        });

        it('fails when file does not exist', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-text-file' => '/nonexistent/file.txt',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('Input file not found');
        });

        it('supports --strip-spaces with file input', function (): void {
            file_put_contents($this->textFile, 'MFNCZ BBFZM');

            $this->commandTester->execute([
                '--input-text-file' => $this->textFile,
                '--strip-spaces' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($this->commandTester->getDisplay())->toContain('HELLOWORLD');
        });

        it('supports --format with file input', function (): void {
            file_put_contents($this->textFile, 'HELLOWORLDTHISISATEST');

            $this->commandTester->execute([
                '--input-text-file' => $this->textFile,
                '--format' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($this->commandTester->getDisplay())->toMatch('/[A-Z]{5}\s+[A-Z]{5}/');
        });
    });

    describe('Output to File (--output-file)', function (): void {
        beforeEach(function (): void {
            $this->tempDir = sys_get_temp_dir();
            $this->outputFile = $this->tempDir . '/enigma_output_' . uniqid() . '.txt';
        });

        afterEach(function (): void {
            if (file_exists($this->outputFile)) {
                unlink($this->outputFile);
            }
        });

        it('writes output to file', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLOWORLD',
                '--output-file' => $this->outputFile,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('Written to');
            expect(file_exists($this->outputFile))->toBeTrue();
            expect(file_get_contents($this->outputFile))->toBe('MFNCZBBFZM');
        });

        it('fails when output directory does not exist', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--output-file' => '/nonexistent/dir/output.txt',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('Output directory does not exist');
        });
    });

    describe('Binary File Encoding (--input-binary-file)', function (): void {
        beforeEach(function (): void {
            $this->tempDir = sys_get_temp_dir();
            $this->binaryFile = $this->tempDir . '/enigma_binary_' . uniqid() . '.bin';
            $this->encodedFile = $this->tempDir . '/enigma_encoded_' . uniqid() . '.txt';
            $this->decodedFile = $this->tempDir . '/enigma_decoded_' . uniqid() . '.bin';
        });

        afterEach(function (): void {
            foreach ([$this->binaryFile, $this->encodedFile, $this->decodedFile] as $file) {
                if (file_exists($file)) {
                    unlink($file);
                }
            }
        });

        it('encodes binary file to Enigma letters', function (): void {
            // Create a small binary file
            file_put_contents($this->binaryFile, "\x00\x01\x02\xFF");

            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-binary-file' => $this->binaryFile,
                '--output-file' => $this->encodedFile,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('Encoding binary');
            expect(file_exists($this->encodedFile))->toBeTrue();

            // Binary file is 4 bytes, so encoded file should be 8 letters
            $encoded = file_get_contents($this->encodedFile);
            expect(\strlen($encoded))->toBe(8);
            expect($encoded)->toMatch('/^[A-Z]+$/');
        });

        it('fails without --output-file', function (): void {
            file_put_contents($this->binaryFile, 'test');

            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-binary-file' => $this->binaryFile,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('requires --output-file');
        });

        it('roundtrips binary file correctly', function (): void {
            // Create binary data with various byte values
            $originalData = '';
            for ($i = 0; $i < 256; $i++) {
                $originalData .= \chr($i);
            }
            file_put_contents($this->binaryFile, $originalData);

            // Encode
            $this->commandTester->execute([
                '--input-binary-file' => $this->binaryFile,
                '--output-file' => $this->encodedFile,
                '--rotors' => 'V-II-IV',
                '--position' => 'ABC',
            ]);
            expect($this->commandTester->getStatusCode())->toBe(0);

            // Decode with same settings
            $this->commandTester->execute([
                '--input-binary-file' => $this->encodedFile,
                '--output-file' => $this->decodedFile,
                '--to-binary' => true,
                '--rotors' => 'V-II-IV',
                '--position' => 'ABC',
            ]);
            expect($this->commandTester->getStatusCode())->toBe(0);

            // Verify roundtrip
            $decodedData = file_get_contents($this->decodedFile);
            expect($decodedData)->toBe($originalData);
        });

        it('converts Enigma file back to binary with --to-binary', function (): void {
            file_put_contents($this->binaryFile, 'Hello Binary!');

            // Encode
            $this->commandTester->execute([
                '--input-binary-file' => $this->binaryFile,
                '--output-file' => $this->encodedFile,
            ]);

            // Decode
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-binary-file' => $this->encodedFile,
                '--output-file' => $this->decodedFile,
                '--to-binary' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('Converting to binary');
            expect(file_get_contents($this->decodedFile))->toBe('Hello Binary!');
        });

        it('shows configuration with --show-config', function (): void {
            file_put_contents($this->binaryFile, 'test');

            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-binary-file' => $this->binaryFile,
                '--output-file' => $this->encodedFile,
                '--show-config' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('Model');
            expect($output)->toContain('Rotors');
        });

        it('works with random configuration', function (): void {
            file_put_contents($this->binaryFile, 'test data');

            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                '--input-binary-file' => $this->binaryFile,
                '--output-file' => $this->encodedFile,
                '--random' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('randomly generated configuration');
        });
    });

    describe('No Strict Mode (--no-strict)', function (): void {
        it('allows plugboard on commercial model with --no-strict', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'ENIGMA_K',
                '--rotors' => 'K_III-K_II-K_I',
                '--reflector' => 'K',
                '--plugboard' => 'AB CD',
                '--no-strict' => true,
                '--show-config' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            // Should not show warning about plugboard
            expect($output)->not->toContain('does not have a plugboard');
            // Plugboard should be applied
            expect($output)->toContain('AB CD');
        });

        it('plugboard affects encoding on commercial model with --no-strict', function (): void {
            // Without plugboard
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'ENIGMA_K',
                '--rotors' => 'K_III-K_II-K_I',
                '--reflector' => 'K',
            ]);
            $withoutPlugboard = $this->commandTester->getDisplay();

            // With plugboard and --no-strict
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'ENIGMA_K',
                '--rotors' => 'K_III-K_II-K_I',
                '--reflector' => 'K',
                '--plugboard' => 'AB CD EF GH IJ KL',
                '--no-strict' => true,
            ]);
            $withPlugboard = $this->commandTester->getDisplay();

            // Output should be different due to plugboard
            expect($withPlugboard)->not->toBe($withoutPlugboard);
        });

        it('warning mentions --no-strict when plugboard used on commercial model without flag', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'ENIGMA_K',
                '--rotors' => 'K_III-K_II-K_I',
                '--reflector' => 'K',
                '--plugboard' => 'AB CD',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('does not have a plugboard');
            expect($output)->toContain('--no-strict');
        });

        it('--no-strict works with random configuration', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '--model' => 'ENIGMA_K',
                '--random' => true,
                '--no-strict' => true,
                '--show-config' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('ENIGMA_K');
        });

        it('--no-strict works with binary file encoding', function (): void {
            $tempDir = sys_get_temp_dir();
            $binaryFile = $tempDir . '/enigma_strict_test_' . uniqid() . '.bin';
            $encodedFile = $tempDir . '/enigma_strict_encoded_' . uniqid() . '.txt';

            try {
                file_put_contents($binaryFile, 'test data');

                $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                    '--input-binary-file' => $binaryFile,
                    '--output-file' => $encodedFile,
                    '--model' => 'ENIGMA_K',
                    '--rotors' => 'K_III-K_II-K_I',
                    '--reflector' => 'K',
                    '--plugboard' => 'AB CD',
                    '--no-strict' => true,
                ]);

                expect($this->commandTester->getStatusCode())->toBe(0);
                expect($output)->not->toContain('does not have a plugboard');
            } finally {
                if (file_exists($binaryFile)) {
                    unlink($binaryFile);
                }
                if (file_exists($encodedFile)) {
                    unlink($encodedFile);
                }
            }
        });
    });

    describe('Historical Accuracy', function (): void {
        it('encodes Operation Barbarossa message correctly', function (): void {
            $this->commandTester->execute([
                'text' => 'AUFKLXABTEILUNGXVONXKURTINOWA',
                '--model' => 'WMLW',
                '--rotors' => 'II-IV-V',
                '--ring' => 'BUL',
                '--position' => 'BLA',
                '--reflector' => 'B',
                '--plugboard' => 'AV BS CG DL FU HZ IN KM OW RX',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($this->commandTester->getDisplay())->toContain('EDPUD');
        });
    });

    describe('Edge Cases', function (): void {
        it('handles empty text argument gracefully', function (): void {
            $result = $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => '']);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($output)->toContain('No text provided');
        });

        it('handles single character', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => 'A']);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('handles very long text', function (): void {
            $longText = str_repeat('HELLO', 1000);

            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, ['text' => $longText]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('is case insensitive for model names', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--model' => 'wmlw',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('is case insensitive for rotor names', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--rotors' => 'iii-ii-i',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('is case insensitive for reflector names', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--reflector' => 'b',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('is case insensitive for ring settings', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--ring' => 'abc',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });

        it('is case insensitive for position settings', function (): void {
            $this->commandTester->execute([
                'text' => 'HELLO',
                '--position' => 'xyz',
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
        });
    });

    describe('Interactive Mode', function (): void {
        it('enters interactive mode when no text argument is provided and interactive is true', function (): void {
            // Just verify that interactive mode is triggered (shows the welcome banner)
            // We don't test the full flow as ChoiceQuestion requires complex input simulation
            $this->commandTester->setInputs([]); // No inputs will cause an error, but we check the banner appears

            try {
                $this->commandTester->execute([], ['interactive' => true]);
            } catch (Exception) {
                // Expected - questions will fail without proper input
            }

            expect($this->commandTester->getDisplay())->toContain('Interactive Configuration');
            expect($this->commandTester->getDisplay())->toContain('Step 1');
        });

        it('does not enter interactive mode when text is provided', function (): void {
            $this->commandTester->execute(['text' => 'HELLO'], ['interactive' => true]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($this->commandTester->getDisplay())->not->toContain('Interactive Configuration');
        });

        it('does not enter interactive mode when --input-text-file is provided', function (): void {
            $tempFile = sys_get_temp_dir() . '/enigma_test_' . uniqid() . '.txt';
            file_put_contents($tempFile, 'HELLO');

            try {
                $this->commandTester->execute(['--input-text-file' => $tempFile], ['interactive' => true]);

                expect($this->commandTester->getStatusCode())->toBe(0);
                expect($this->commandTester->getDisplay())->not->toContain('Interactive Configuration');
            } finally {
                @unlink($tempFile);
            }
        });

        it('does not enter interactive mode when --no-interaction is set', function (): void {
            $this->commandTester->execute([], ['interactive' => false]);

            expect($this->commandTester->getStatusCode())->toBe(1);
            expect($this->commandTester->getDisplay())->not->toContain('Interactive Configuration');
            expect($this->commandTester->getDisplay())->toContain('No text provided');
        });

        it('shows pre-selected options from command line', function (): void {
            // Providing --model should show it as "from command line"
            // Tell the command which options were explicitly provided (since CommandTester doesn't set $_SERVER['argv'])
            $this->command->setExplicitlyProvidedOptions(['model' => 'KMM3']);
            $this->commandTester->setInputs([]);

            try {
                $this->commandTester->execute(['--model' => 'KMM3'], ['interactive' => true]);
            } catch (Exception) {
                // Expected
            }

            expect($this->commandTester->getDisplay())->toContain('KMM3 (from command line)');
        });

        it('shows multiple pre-selected options from command line', function (): void {
            // Providing multiple options should show all of them as "from command line"
            $this->command->setExplicitlyProvidedOptions([
                'model' => 'WMLW',
                'reflector' => 'DORA',
                'dora-wiring' => 'AQ BW CE DT FX GR HU IZ JK LN MO PS VY',
                'rotors' => 'V-II-I',
            ]);
            $this->commandTester->setInputs([]);

            try {
                $this->commandTester->execute([
                    '--model' => 'WMLW',
                    '--reflector' => 'DORA',
                    '--dora-wiring' => 'AQ BW CE DT FX GR HU IZ JK LN MO PS VY',
                    '--rotors' => 'V-II-I',
                ], ['interactive' => true]);
            } catch (Exception) {
                // Expected - interactive mode will fail without full input
            }

            $display = $this->commandTester->getDisplay();
            expect($display)->toContain('WMLW (from command line)');
            expect($display)->toContain('DORA with custom wiring (from command line)');
            expect($display)->toContain('V-II-I (from command line)');
            // Should NOT ask for model, reflector, or rotors selection
            expect($display)->not->toContain('Which Enigma model?');
            expect($display)->not->toContain('Select Reflector');
            expect($display)->not->toContain('Select Rotors');
        });

        it('calculates correct step count for models with plugboard', function (): void {
            // WMLW has plugboard, so should have 7 steps
            $this->command->setExplicitlyProvidedOptions(['model' => 'WMLW']);
            $this->commandTester->setInputs([]);

            try {
                $this->commandTester->execute(['--model' => 'WMLW'], ['interactive' => true]);
            } catch (Exception) {
                // Expected
            }

            // Step counter should show X/7 for models with plugboard
            expect($this->commandTester->getDisplay())->toMatch('/Step \d\/7/');
        });

        it('calculates correct step count for models without plugboard', function (): void {
            // ENIGMA_K has no plugboard, so should have 6 steps
            $this->command->setExplicitlyProvidedOptions(['model' => 'ENIGMA_K']);
            $this->commandTester->setInputs([]);

            try {
                $this->commandTester->execute(['--model' => 'ENIGMA_K'], ['interactive' => true]);
            } catch (Exception) {
                // Expected
            }

            // Step counter should show X/6 for models without plugboard
            expect($this->commandTester->getDisplay())->toMatch('/Step \d\/6/');
        });
    });

    describe('Short Options', function (): void {
        it('accepts -R for --random option', function (): void {
            $output = executeAndGetOutput($this->commandTester, $this->promptOutput, [
                'text' => 'HELLO',
                '-R' => true,
            ]);

            expect($this->commandTester->getStatusCode())->toBe(0);
            expect($output)->toContain('randomly generated configuration');
        });
    });
});
