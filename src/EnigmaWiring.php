<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * This class represents the wiring of rotors, reflectors and the plugboard.
 *
 * Each wiring provides a monoalphabetical substitution e.g.:
 *
 * <pre>
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * ||||||||||||||||||||||||||
 * EKMFLGDQVZNTOWYHXUSPAIBRCJ
 * </pre>
 */
/**
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 *
 * @version 2.0
 */
class EnigmaWiring
{
    /**
     * The connections of the pins.
     *
     * [0]=4 means pin 0 on side A leads to pin 4 on side B, [1]=10 means pin 1 on side A leads to pin 10 on side B, ...<br>
     * Size is ENIGMA_ALPHABET_SIZE.
     *
     * @var array<int, int>
     */
    private array $wiring;

    /**
     * Constructor connects the pins according to the list in $wiring.
     *
     * example string EKMFLGDQVZNTOWYHXUSPAIBRCJ leads to [0]=4, [1]=10, [2]=12, ...
     *
     * @param $wiring setup for the internal wiring
     */
    public function __construct(string $wiring)
    {
        $this->wiring = array_map(Enigma::enigma_l2p(...), str_split($wiring));
    }

    /**
     * Manually connect 2 pins.
     *
     * @param $pin1 pin 1 to connect
     * @param $pin2 pin 2 to connect
     *
     * @return void
     */
    public function connect(int $pin1, int $pin2): void
    {
        $this->wiring[$pin1] = $pin2;
    }

    /**
     * Get the connected pin.
     *
     * @param $pin start of the connection
     *
     * @return int the connected pin
     */
    public function connectsTo(int $pin): int
    {
        return $this->wiring[$pin];
    }

    /**
     * Pass the given letter form side A to side B by following the connection of the pins.
     *
     * @param $pin pin that got activated
     *
     * @return int pin that gets activated
     */
    public function processLetter1stPass(int $pin): int
    {
        return $this->wiring[$pin];
    }

    /**
     * Pass the given letter form side B to side A by following the connection of the pins.
     *
     * @param $pin pin that got activated
     *
     * @return int pin that gets activated
     */
    public function processLetter2ndPass(int $pin): int
    {
        $r = array_search($pin, $this->wiring, true);

        if ($r === false) {
            throw new \RuntimeException('Wiring error: pin not found');
        }

        return $r;
    }
}
