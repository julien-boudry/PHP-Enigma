<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine;

use RuntimeException;

/**
 * Converts arbitrary text to Enigma-compatible format (A-Z only).
 *
 * Historical Enigma machines could only process the 26 letters A-Z.
 * This class provides conversion utilities to transform any input text
 * into a format suitable for Enigma encryption.
 *
 * Common historical conventions:
 * - Numbers were spelled out in German (e.g., 1 → EINS)
 * - Spaces were represented as X
 * - Special characters were spelled out or omitted
 */
final class EnigmaTextConverter
{
    /**
     * German number words (0-9) as used historically with Enigma.
     *
     * @var array<int, string>
     */
    private const array GERMAN_NUMBERS = [
        0 => 'NULL',
        1 => 'EINS',
        2 => 'ZWEI',
        3 => 'DREI',
        4 => 'VIER',
        5 => 'FUENF',
        6 => 'SECHS',
        7 => 'SIEBEN',
        8 => 'ACHT',
        9 => 'NEUN',
    ];

    /**
     * Common punctuation replacements.
     *
     * @var array<string, string>
     */
    private const array PUNCTUATION_MAP = [
        '.' => 'X',      // Period/stop
        ',' => 'ZZ',     // Comma (historical convention)
        ':' => 'XX',     // Colon
        ';' => 'YY',     // Semicolon
        '?' => 'UD',     // Question mark (from German "Fragezeichen")
        '!' => 'X',      // Exclamation
        '-' => 'YY',     // Hyphen
        '(' => 'KK',     // Opening parenthesis (Klammer)
        ')' => 'KK',     // Closing parenthesis
        '"' => 'X',      // Quote
        "'" => 'X',      // Apostrophe
        '/' => 'X',      // Slash
        '@' => 'AT',     // At sign
        '&' => 'UND',    // Ampersand (German for "and")
        '+' => 'PLUS',   // Plus sign
        '=' => 'GLEICH', // Equals sign (German for "equals")
        '%' => 'PROZENT', // Percent (German)
    ];

    /**
     * Character normalization map for accented characters.
     *
     * @var array<string, string>
     */
    private const array ACCENT_MAP = [
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'AE', 'Å' => 'A',
        'Æ' => 'AE', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
        'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N',
        'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'OE', 'Ø' => 'O',
        'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'UE', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'SS',
        'à' => 'A', 'á' => 'A', 'â' => 'A', 'ã' => 'A', 'ä' => 'AE', 'å' => 'A',
        'æ' => 'AE', 'ç' => 'C', 'è' => 'E', 'é' => 'E', 'ê' => 'E', 'ë' => 'E',
        'ì' => 'I', 'í' => 'I', 'î' => 'I', 'ï' => 'I', 'ð' => 'D', 'ñ' => 'N',
        'ò' => 'O', 'ó' => 'O', 'ô' => 'O', 'õ' => 'O', 'ö' => 'OE', 'ø' => 'O',
        'ù' => 'U', 'ú' => 'U', 'û' => 'U', 'ü' => 'UE', 'ý' => 'Y', 'þ' => 'TH',
        'ÿ' => 'Y',
    ];

    /**
     * Convert Latin text to Enigma-compatible format.
     *
     * Handles Latin alphabet, accented characters (é, ü, ß, etc.), numbers,
     * and common punctuation. Non-Latin scripts (Cyrillic, Chinese, Arabic, etc.)
     * will be converted to X or skipped depending on $keepUnknownAsX.
     *
     * Numbers are converted to German words (historical convention):
     * 0=NULL, 1=EINS, 2=ZWEI, 3=DREI, 4=VIER, 5=FUENF, 6=SECHS, 7=SIEBEN, 8=ACHT, 9=NEUN
     *
     * @param string $text The input text (Latin characters, numbers, accents, punctuation)
     * @param string $spaceReplacement Character(s) to replace spaces with (default: 'X')
     * @param bool $keepUnknownAsX Replace unknown/non-Latin characters with X (default: true)
     *
     * @return string The converted text containing only A-Z characters
     */
    public static function latinToEnigmaFormat(
        string $text,
        string $spaceReplacement = 'X',
        bool $keepUnknownAsX = true
    ): string {
        $result = '';

        // Convert to uppercase first
        $text = mb_strtoupper($text);

        // Process character by character
        $length = mb_strlen($text);
        for ($i = 0; $i < $length; $i++) {
            $char = mb_substr($text, $i, 1);

            // Already a valid Enigma letter
            if (preg_match('/^[A-Z]$/', $char)) {
                $result .= $char;

                continue;
            }

            // Space handling
            if ($char === ' ' || $char === "\t" || $char === "\n" || $char === "\r") {
                $result .= $spaceReplacement;

                continue;
            }

            // Number handling (German words, historical convention)
            if (preg_match('/^[0-9]$/', $char)) {
                $result .= self::GERMAN_NUMBERS[(int) $char];

                continue;
            }

            // Accented character handling
            if (isset(self::ACCENT_MAP[$char])) {
                $result .= self::ACCENT_MAP[$char];

                continue;
            }

            // Check lowercase version for accents
            $lowerChar = mb_strtolower($char);
            if (isset(self::ACCENT_MAP[$lowerChar])) {
                $result .= mb_strtoupper(self::ACCENT_MAP[$lowerChar]);

                continue;
            }

            // Punctuation handling
            if (isset(self::PUNCTUATION_MAP[$char])) {
                $result .= self::PUNCTUATION_MAP[$char];

                continue;
            }

            // Unknown character
            if ($keepUnknownAsX) {
                $result .= 'X';
            }
            // else: skip the character
        }

        return $result;
    }

    /**
     * Check if a string is already in valid Enigma format (A-Z only).
     *
     * @param string $text The text to check
     *
     * @return bool True if the text contains only A-Z characters
     */
    public static function isValidEnigmaFormat(string $text): bool
    {
        return preg_match('/^[A-Z]*$/', $text) === 1;
    }

    /**
     * Convert binary data to Enigma format using base64-like encoding.
     *
     * This encodes arbitrary binary data into A-Z characters only.
     * Each byte is converted to a 2-3 letter representation.
     *
     * @param string $binaryData Raw binary data
     *
     * @return string Enigma-compatible representation
     */
    public static function binaryToEnigmaFormat(string $binaryData): string
    {
        $result = '';
        $bytes = unpack('C*', $binaryData);

        if ($bytes === false) {
            return '';
        }

        foreach ($bytes as $byte) {
            // Convert each byte (0-255) to base-26 representation (AA-JV)
            $high = intdiv($byte, 26);
            $low = $byte % 26;

            $result .= \chr(65 + $high); // A=0, B=1, ..., J=9
            $result .= \chr(65 + $low);  // A=0, B=1, ..., Z=25
        }

        return $result;
    }

    /**
     * Convert Enigma format back to binary data.
     *
     * This is the reverse of binaryToEnigmaFormat().
     *
     * @param string $enigmaText Text encoded with binaryToEnigmaFormat()
     *
     * @return string|null Decoded binary data, or null if invalid format
     */
    public static function enigmaFormatToBinary(string $enigmaText): ?string
    {
        if (mb_strlen($enigmaText) % 2 !== 0) {
            return null;
        }

        $result = '';
        $length = mb_strlen($enigmaText);

        for ($i = 0; $i < $length; $i += 2) {
            $high = \ord($enigmaText[$i]) - 65;
            $low = \ord($enigmaText[$i + 1]) - 65;

            if ($high < 0 || $high > 9 || $low < 0 || $low > 25) {
                return null;
            }

            $byte = ($high * 26) + $low;
            if ($byte > 255) {
                return null;
            }

            $result .= \chr($byte);
        }

        return $result;
    }

    /**
     * Format Enigma output into traditional 5-letter groups.
     *
     * @param string $text The Enigma text
     * @param int $groupSize Size of each group (default: 5)
     *
     * @return string Formatted text with spaces between groups
     */
    public static function formatInGroups(string $text, int $groupSize = 5): string
    {
        if ($groupSize < 1) {
            throw new RuntimeException('Group size must be at least 1.');
        }

        return implode(' ', str_split($text, $groupSize));
    }

    /**
     * Remove group formatting (spaces) from Enigma text.
     *
     * @param string $text The formatted Enigma text
     *
     * @return string Text without spaces
     */
    public static function removeGroupFormatting(string $text): string
    {
        return str_replace(' ', '', $text);
    }
}
