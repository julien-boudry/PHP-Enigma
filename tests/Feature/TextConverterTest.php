<?php

declare(strict_types=1);

use JulienBoudry\Enigma\EnigmaTextConverter;

describe('EnigmaTextConverter', function (): void {
    describe('latinToEnigmaFormat', function (): void {
        test('converts lowercase to uppercase', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('hello'))->toBe('HELLO');
        });

        test('keeps uppercase letters unchanged', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('HELLO'))->toBe('HELLO');
        });

        test('converts spaces to X by default', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('HELLO WORLD'))->toBe('HELLOXWORLD');
        });

        test('converts spaces with custom replacement', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('HELLO WORLD', spaceReplacement: 'QQ'))->toBe('HELLOQQWORLD');
        });

        test('converts numbers to German words', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('ABC123'))->toBe('ABCEINSZWEIDREI');
        });

        test('converts all German numbers correctly', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('0123456789'))->toBe('NULLEINSZWEIDREIVIERFUENFSECHSSIEBENACHTNEUN');
        });

        test('converts German umlauts', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('MÜNCHEN'))->toBe('MUENCHEN');
            expect(EnigmaTextConverter::latinToEnigmaFormat('KÖLN'))->toBe('KOELN');
            expect(EnigmaTextConverter::latinToEnigmaFormat('GRÜß'))->toBe('GRUESS');
        });

        test('converts French accents', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('CAFÉ'))->toBe('CAFE');
            expect(EnigmaTextConverter::latinToEnigmaFormat('RÉSUMÉ'))->toBe('RESUME');
        });

        test('handles punctuation', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('STOP.'))->toBe('STOPX');
            expect(EnigmaTextConverter::latinToEnigmaFormat('YES?'))->toBe('YESUD');
        });

        test('replaces unknown characters with X', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('TEST™'))->toBe('TESTX');
        });

        test('skips unknown characters when specified', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat('TEST™', keepUnknownAsX: false))->toBe('TEST');
        });

        test('handles mixed content', function (): void {
            $input = 'Hello, World! 123';
            // HELLO + ZZ (comma) + X (space) + WORLD + X (!) + X (space) + EINS + ZWEI + DREI
            $expected = 'HELLOZZXWORLDXXEINSZWEIDREI';
            expect(EnigmaTextConverter::latinToEnigmaFormat($input))->toBe($expected);
        });

        test('handles empty string', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat(''))->toBe('');
        });

        test('handles whitespace variations', function (): void {
            expect(EnigmaTextConverter::latinToEnigmaFormat("A\tB\nC"))->toBe('AXBXC');
        });

        test('converts non-Latin characters to X', function (): void {
            // Cyrillic, Chinese, Arabic are unknown and become X
            expect(EnigmaTextConverter::latinToEnigmaFormat('AБB'))->toBe('AXB');
            expect(EnigmaTextConverter::latinToEnigmaFormat('A中B'))->toBe('AXB');
        });
    });

    describe('isValidEnigmaFormat', function (): void {
        test('returns true for valid Enigma text', function (): void {
            expect(EnigmaTextConverter::isValidEnigmaFormat('ABCXYZ'))->toBeTrue();
        });

        test('returns true for empty string', function (): void {
            expect(EnigmaTextConverter::isValidEnigmaFormat(''))->toBeTrue();
        });

        test('returns false for lowercase', function (): void {
            expect(EnigmaTextConverter::isValidEnigmaFormat('abc'))->toBeFalse();
        });

        test('returns false for numbers', function (): void {
            expect(EnigmaTextConverter::isValidEnigmaFormat('ABC123'))->toBeFalse();
        });

        test('returns false for spaces', function (): void {
            expect(EnigmaTextConverter::isValidEnigmaFormat('ABC DEF'))->toBeFalse();
        });
    });

    describe('binaryToEnigmaFormat', function (): void {
        test('encodes simple bytes', function (): void {
            // Byte 0 = AA, Byte 1 = AB, Byte 26 = BA
            expect(EnigmaTextConverter::binaryToEnigmaFormat("\x00"))->toBe('AA');
            expect(EnigmaTextConverter::binaryToEnigmaFormat("\x01"))->toBe('AB');
            expect(EnigmaTextConverter::binaryToEnigmaFormat("\x1A"))->toBe('BA'); // 26
        });

        test('encodes multiple bytes', function (): void {
            $result = EnigmaTextConverter::binaryToEnigmaFormat("\x00\x01\x02");
            expect($result)->toBe('AAABAC');
        });

        test('handles empty input', function (): void {
            expect(EnigmaTextConverter::binaryToEnigmaFormat(''))->toBe('');
        });
    });

    describe('enigmaFormatToBinary', function (): void {
        test('decodes simple encoding', function (): void {
            expect(EnigmaTextConverter::enigmaFormatToBinary('AA'))->toBe("\x00");
            expect(EnigmaTextConverter::enigmaFormatToBinary('AB'))->toBe("\x01");
            expect(EnigmaTextConverter::enigmaFormatToBinary('BA'))->toBe("\x1A");
        });

        test('roundtrip encoding/decoding', function (): void {
            $original = "Hello\x00\xFF";
            $encoded = EnigmaTextConverter::binaryToEnigmaFormat($original);
            $decoded = EnigmaTextConverter::enigmaFormatToBinary($encoded);
            expect($decoded)->toBe($original);
        });

        test('returns null for odd length', function (): void {
            expect(EnigmaTextConverter::enigmaFormatToBinary('ABC'))->toBeNull();
        });

        test('returns null for invalid characters', function (): void {
            expect(EnigmaTextConverter::enigmaFormatToBinary('KA'))->toBeNull(); // K > 9
        });

        test('handles empty input', function (): void {
            expect(EnigmaTextConverter::enigmaFormatToBinary(''))->toBe('');
        });
    });

    describe('formatInGroups', function (): void {
        test('formats in 5-letter groups by default', function (): void {
            expect(EnigmaTextConverter::formatInGroups('ABCDEFGHIJ'))->toBe('ABCDE FGHIJ');
        });

        test('handles incomplete last group', function (): void {
            expect(EnigmaTextConverter::formatInGroups('ABCDEFGH'))->toBe('ABCDE FGH');
        });

        test('uses custom group size', function (): void {
            expect(EnigmaTextConverter::formatInGroups('ABCDEF', 3))->toBe('ABC DEF');
        });

        test('handles empty string', function (): void {
            expect(EnigmaTextConverter::formatInGroups(''))->toBe('');
        });
    });

    describe('removeGroupFormatting', function (): void {
        test('removes spaces', function (): void {
            expect(EnigmaTextConverter::removeGroupFormatting('ABCDE FGHIJ'))->toBe('ABCDEFGHIJ');
        });

        test('handles no spaces', function (): void {
            expect(EnigmaTextConverter::removeGroupFormatting('ABCDEF'))->toBe('ABCDEF');
        });
    });
});
