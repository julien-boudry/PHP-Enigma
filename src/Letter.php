<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Enumeration representing the 26 letters of the Enigma alphabet.
 *
 * This backed enum provides type-safe letter handling for all Enigma operations.
 * The integer backing values (0-25) are used internally for efficient wiring calculations.
 *
 * Note: PHP enums cannot implement Stringable. Use ->toChar() for string conversion.
 */
enum Letter: int
{
    case A = 0;
    case B = 1;
    case C = 2;
    case D = 3;
    case E = 4;
    case F = 5;
    case G = 6;
    case H = 7;
    case I = 8;
    case J = 9;
    case K = 10;
    case L = 11;
    case M = 12;
    case N = 13;
    case O = 14;
    case P = 15;
    case Q = 16;
    case R = 17;
    case S = 18;
    case T = 19;
    case U = 20;
    case V = 21;
    case W = 22;
    case X = 23;
    case Y = 24;
    case Z = 25;

    /**
     * Get the total number of letters in the Enigma alphabet.
     */
    public static function count(): int
    {
        static $count;

        if ($count === null) {
            $count = count(self::cases());
        }

        return $count;
    }

    /**
     * Create a Letter from a single character string.
     *
     * @param string $char A single character (A-Z, case-insensitive)
     *
     * @throws \ValueError If the character is not a valid letter
     */
    public static function fromChar(string $char): self
    {
        $char = strtoupper($char);

        return self::tryFrom(ord($char) - ord('A'))
            ?? throw new \ValueError("Invalid character for Enigma alphabet: {$char}");
    }

    /**
     * Convert this letter to its character representation.
     */
    public function toChar(): string
    {
        return chr(ord('A') + $this->value);
    }

    /**
     * Get the letter at a given position (with modulo wrapping).
     *
     * This is useful for rotor calculations where positions wrap around.
     *
     * @param int $position The position (will be wrapped to 0-25)
     */
    public static function fromPosition(int $position): self
    {
        $count = self::count();
        $normalized = (($position % $count) + $count) % $count;

        return self::from($normalized);
    }
}
