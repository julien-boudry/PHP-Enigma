<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine;

/**
 * Represents the internal wiring of Enigma components.
 *
 * This class implements the wiring used by rotors, reflectors, and the plugboard.
 * Each wiring provides a monoalphabetical substitution, mapping each input letter
 * to a different output letter.
 *
 * Example wiring:
 * <pre>
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * ||||||||||||||||||||||||||
 * EKMFLGDQVZNTOWYHXUSPAIBRCJ
 * </pre>
 *
 * The wiring can be traversed in both directions (side A to B, or B to A).
 *
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 */
class EnigmaWiring
{
    /**
     * The connections of the pins.
     *
     * [0]=Letter::E means pin 0 on side A leads to pin E on side B, [1]=Letter::K means pin 1 on side A leads to pin K on side B, ...<br>
     * Size is ENIGMA_ALPHABET_SIZE.
     *
     * @var array<int, Letter>
     */
    private array $wiring;

    /**
     * Constructor connects the pins according to the list in $wiring.
     *
     * example string EKMFLGDQVZNTOWYHXUSPAIBRCJ leads to [0]=Letter::E, [1]=Letter::K, [2]=Letter::M, ...
     *
     * @param $wiring setup for the internal wiring
     */
    public function __construct(string $wiring)
    {
        $this->wiring = array_map(
            static fn(string $char): Letter => Letter::fromChar($char),
            str_split($wiring)
        );
    }

    /**
     * Manually connect 2 pins.
     *
     * @param Letter $pin1 pin 1 to connect
     * @param Letter $pin2 pin 2 to connect
     *
     * @return void
     */
    public function connect(Letter $pin1, Letter $pin2): void
    {
        $this->wiring[$pin1->value] = $pin2;
    }

    /**
     * Get the connected pin.
     *
     * @param Letter $pin start of the connection
     *
     * @return Letter the connected pin
     */
    public function connectsTo(Letter $pin): Letter
    {
        return $this->wiring[$pin->value];
    }

    /**
     * Pass the given letter form side A to side B by following the connection of the pins.
     *
     * @param Letter $pin pin that got activated
     *
     * @return Letter pin that gets activated
     */
    public function processLetter1stPass(Letter $pin): Letter
    {
        return $this->wiring[$pin->value];
    }

    /**
     * Pass the given letter form side B to side A by following the connection of the pins.
     *
     * @param Letter $pin pin that got activated
     *
     * @return Letter pin that gets activated
     */
    public function processLetter2ndPass(Letter $pin): Letter
    {
        foreach ($this->wiring as $index => $letter) {
            if ($letter === $pin) {
                return Letter::from($index);
            }
        }

        throw new \RuntimeException('Wiring error: pin not found');
    }

    /**
     * Clone the wiring array for deep cloning support.
     */
    public function __clone(): void
    {
        // Array is already copied by value in PHP, nothing special needed
    }
}
