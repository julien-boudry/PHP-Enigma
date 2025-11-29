<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine;

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
        for ($idx = 0; $idx < Letter::count(); $idx++) {
            $wiring .= Letter::from($idx)->toChar();
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
     * @return Letter resulting letter
     */
    public function processLetter(Letter $letter): Letter
    {
        return $this->wiring->processLetter1stPass($letter);
    }

    /**
     * Connect 2 letters.
     *
     * @param $letter1 letter 1 to connect
     * @param $letter2 letter 2 to connect
     */
    public function plugLetters(Letter $letter1, Letter $letter2): void
    {
        $this->wiring->connect($letter1, $letter2);
        $this->wiring->connect($letter2, $letter1);
    }

    /**
     * Disconnect 2 letters.
     * Because letters are connected in pairs, we only need to know one of them.
     *
     * @param $letter 1 of the 2 letters to disconnect
     */
    public function unplugLetters(Letter $letter): void
    {
        $temp = $this->wiring->connectsTo($letter);
        $this->wiring->connect($letter, $letter);
        $this->wiring->connect($temp, $temp);
    }

    /**
     * Connect multiple letter pairs from string notation.
     *
     * Accepts pairs in various formats:
     * - Space-separated: "AV BS CG DL"
     * - Array of pairs: ['AV', 'BS', 'CG', 'DL']
     *
     * @param string|array<string> $pairs Pairs to connect
     */
    public function plugLettersFromPairs(string|array $pairs): void
    {
        if (\is_string($pairs)) {
            $pairs = preg_split('/\s+/', trim($pairs), -1, \PREG_SPLIT_NO_EMPTY) ?: [];
        }

        foreach ($pairs as $pair) {
            if (\strlen($pair) !== 2) {
                throw new \InvalidArgumentException("Invalid pair format: '{$pair}'. Expected 2 characters.");
            }
            $this->plugLetters(Letter::fromChar($pair[0]), Letter::fromChar($pair[1]));
        }
    }

    /**
     * Get all plugged letter pairs.
     *
     * Returns pairs where the first letter is alphabetically before the second
     * to avoid duplicates (e.g., returns [A, Z] not [Z, A]).
     *
     * @return list<array{Letter, Letter}> List of letter pairs
     */
    public function getPluggedPairs(): array
    {
        $pairs = [];

        foreach (Letter::cases() as $letter) {
            $connected = $this->wiring->connectsTo($letter);

            // Only include if connected to a different letter
            // and this letter comes before its pair alphabetically (avoid duplicates)
            if ($connected !== $letter && $letter->value < $connected->value) {
                $pairs[] = [$letter, $connected];
            }
        }

        return $pairs;
    }

    /**
     * Deep clone the plugboard.
     */
    public function __clone(): void
    {
        $this->wiring = clone $this->wiring;
    }
}
