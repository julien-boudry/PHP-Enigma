<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Defines the Enigma machine alphabet.
 *
 * The Enigma machine uses a 26-letter alphabet (A-Z) for all encryption operations.
 * This class provides the mapping between integer key codes and their corresponding letters.
 *
 * @package Enigma
 */
final class EnigmaAlphabet
{
    /**
     * encoding table@
     * eg.: Enigma::KEY_A=>"A", Enigma::KEY_B=>"B", ...
     *
     * @var array<int, string>
     */
    public const array MAP = [
        Enigma::KEY_A => 'A',
        Enigma::KEY_B => 'B',
        Enigma::KEY_C => 'C',
        Enigma::KEY_D => 'D',
        Enigma::KEY_E => 'E',
        Enigma::KEY_F => 'F',
        Enigma::KEY_G => 'G',
        Enigma::KEY_H => 'H',
        Enigma::KEY_I => 'I',
        Enigma::KEY_J => 'J',
        Enigma::KEY_K => 'K',
        Enigma::KEY_L => 'L',
        Enigma::KEY_M => 'M',
        Enigma::KEY_N => 'N',
        Enigma::KEY_O => 'O',
        Enigma::KEY_P => 'P',
        Enigma::KEY_Q => 'Q',
        Enigma::KEY_R => 'R',
        Enigma::KEY_S => 'S',
        Enigma::KEY_T => 'T',
        Enigma::KEY_U => 'U',
        Enigma::KEY_V => 'V',
        Enigma::KEY_W => 'W',
        Enigma::KEY_X => 'X',
        Enigma::KEY_Y => 'Y',
        Enigma::KEY_Z => 'Z',
    ];

    public static function count(): int
    {
        return \count(self::MAP);
    }
}
