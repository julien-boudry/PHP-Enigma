<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Rotor;

use JulienBoudry\Enigma\{EnigmaModel, EnigmaWiring, Letter, RotorType};

/**
 * Abstract base class for Enigma rotors (Walzen).
 *
 * The rotors are the key element of the Enigma. Each provides a monoalphabetical substitution
 * through its internal wiring, but unlike the plugboard and reflector, rotors move,
 * causing the substitution to change with each keypress.
 *
 * Example of rotor advancement:
 * <pre>
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * ||||||||||||||||||||||||||
 * EKMFLGDQVZNTOWYHXUSPAIBRCJ
 * =>
 * ABCDEFGHIJKLMNOPQRSTUVWXYZ
 * ||||||||||||||||||||||||||
 * JEKMFLGDQVZNTOWYHXUSPAIBRC
 * </pre>
 *
 * Notches mark positions where the next rotor may advance (turnover).
 * The Ringstellung (ring setting) offsets the wiring relative to the notches and visible alphabet.
 */
abstract class AbstractRotor
{
    /**
     * Get the wiring configuration for this rotor (26 letters).
     */
    abstract protected static function getWiring(): string;

    /**
     * The notch positions for this rotor.
     *
     * @return array<Letter>
     */
    abstract public static function getNotches(): array;

    /**
     * The compatible Enigma models for this rotor.
     *
     * @return array<EnigmaModel>
     */
    abstract public static function getCompatibleModels(): array;

    /**
     * Get the rotor type enum value.
     */
    abstract public function getType(): RotorType;

    /**
     * The wiring of a rotor.
     */
    private EnigmaWiring $wiring;

    /**
     * Actual position of the rotor.
     */
    private int $position = 0;

    /**
     * Offset of the wiring (ring setting).
     */
    private int $ringstellung = 0;

    /**
     * A rotor is in use or available.
     */
    public bool $inUse = false;

    /**
     * Constructor creates a new Wiring with the setup from the WIRING constant.
     *
     * @param Letter $ringstellung The ring setting (default: A)
     */
    public function __construct(Letter $ringstellung = Letter::A)
    {
        $this->wiring = new EnigmaWiring(static::getWiring());
        $this->setRingstellung($ringstellung);
    }

    /**
     * Advance the rotor by 1 step.
     * When position reaches Letter::count(), it is reset to 0.
     */
    public function advance(): void
    {
        $this->position = ($this->position + 1) % Letter::count();
    }

    /**
     * A notch is open.
     * Returns true if the rotor is in a turnover position for the next rotor.
     *
     * @return bool turnover position reached
     */
    public function isNotchOpen(): bool
    {
        foreach (static::getNotches() as $notch) {
            if ($this->position === $notch->value) {
                return true;
            }
        }

        return false;
    }

    /**
     * Send a letter from side A through the wiring to side B.
     * To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.
     * + Letter::count() and % Letter::count() keep the value positive and in bounds.
     *
     * @param Letter $letter letter to process
     *
     * @return Letter resulting letter
     */
    public function processLetter1stPass(Letter $letter): Letter
    {
        $count = Letter::count();
        $adjustedPosition = ($letter->value - $this->ringstellung + $this->position + $count) % $count;
        $result = $this->wiring->processLetter1stPass(Letter::from($adjustedPosition));

        return Letter::fromPosition($result->value + $this->ringstellung - $this->position);
    }

    /**
     * Send a letter from side B through the wiring to side A.
     * To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.
     * + Letter::count() and % Letter::count() keep the value positive and in bounds.
     *
     * @param Letter $letter letter to process
     *
     * @return Letter resulting letter
     */
    public function processLetter2ndPass(Letter $letter): Letter
    {
        $count = Letter::count();
        $adjustedPosition = ($letter->value - $this->ringstellung + $this->position + $count) % $count;
        $result = $this->wiring->processLetter2ndPass(Letter::from($adjustedPosition));

        return Letter::fromPosition($result->value + $this->ringstellung - $this->position);
    }

    /**
     * Set the rotor to a given position.
     *
     * @param Letter $letter position to go to
     */
    public function setPosition(Letter $letter): void
    {
        $this->position = $letter->value;
    }

    /**
     * Retrieve current position of the rotor.
     *
     * @return Letter current position
     */
    public function getPosition(): Letter
    {
        return Letter::from($this->position);
    }

    /**
     * Sets the ringstellung to a given position.
     *
     * @param Letter $letter position to go to
     */
    public function setRingstellung(Letter $letter): void
    {
        $this->ringstellung = $letter->value;
    }

    /**
     * Retrieve current ringstellung (ring setting) of the rotor.
     *
     * @return Letter current ringstellung
     */
    public function getRingstellung(): Letter
    {
        return Letter::from($this->ringstellung);
    }

    /**
     * Check if this rotor is compatible with the given Enigma model.
     *
     * @param EnigmaModel $model The model to check compatibility with
     *
     * @return bool True if compatible, false otherwise
     */
    public function isCompatibleWithModel(EnigmaModel $model): bool
    {
        return \in_array($model, static::getCompatibleModels(), true);
    }

    /**
     * Check if this rotor is a Greek rotor (BETA or GAMMA).
     *
     * @return bool True if this is a Greek rotor
     */
    public function isGreekRotor(): bool
    {
        return $this->getType() === RotorType::BETA || $this->getType() === RotorType::GAMMA;
    }

    /**
     * Deep clone the rotor.
     */
    public function __clone(): void
    {
        $this->wiring = clone $this->wiring;
    }
}
