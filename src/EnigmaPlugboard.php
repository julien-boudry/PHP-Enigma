<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Represents the Plugboard (Steckerbrett) of an Enigma machine.
 *
 * The plugboard allows the operator to swap pairs of letters before and after
 * the signal passes through the rotors. This adds an additional layer of encryption.
 *
 * The initial setup has no swaps (each letter connects to itself):
 * <pre>
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * ||||||||||||||||||||||||||
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * </pre>
 *
 * Plugging two letters (e.g., 'D' and 'F') results in:
 * <pre>
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * ||||||||||||||||||||||||||
 * ABCFEDGHIJKLMNOPQRSTUVWXYZ
 * </pre>
 *
 * Unplugging one of the two letters restores the original state.
 *
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 * @version 2.0
 * @package Enigma
 */
class EnigmaPlugboard
{
    /**
     * The wiring of the plugboard.
     *
     * Pins always have to be connected in pairs, that means, if 'D' on side A
     * connects to 'H' on side B, 'H' on side A has to connect to 'D' on side B
     */
    private EnigmaWiring $wiring;

    /**
     * Constructor creates a new Wiring and connects the pins in pairs.
     */
    public function __construct()
    {
        $wiring = '';
        for ($idx = 0; $idx < EnigmaAlphabet::count(); $idx++) {
            $wiring .= Enigma::enigma_p2l($idx);
        }
        $this->wiring = new EnigmaWiring($wiring);
    }

    /**
     * Send a letter through the wiring.
     * Because pins are connected in pairs, there is no difference if
     * processLetter1stPass() or processLetter2ndPass() is used.
     *
     * @param $letter letter to process
     *
     * @return int resulting letter
     */
    public function processLetter(int $letter): int
    {
        return $this->wiring->processLetter1stPass($letter);
    }

    /**
     * Connect 2 letters.
     *
     * @param $letter1 letter 1 to connect
     * @param $letter2 letter 2 to connect
     *
     * @return void
     */
    public function plugLetters(int $letter1, int $letter2): void
    {
        $this->wiring->connect($letter1, $letter2);
        $this->wiring->connect($letter2, $letter1);
    }

    /**
     * Disconnect 2 letters.
     * Because letters are connected in pairs, we only need to know one of them.
     *
     * @param $letter 1 of the 2 letters to disconnect
     *
     * @return void
     */
    public function unplugLetters(int $letter): void
    {
        $temp = $this->wiring->connectsTo($letter);
        $this->wiring->connect($letter, $letter);
        $this->wiring->connect($temp, $temp);
    }

    /**
     * Deep clone the plugboard.
     */
    public function __clone(): void
    {
        $this->wiring = clone $this->wiring;
    }
}
