<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Represents a Rotor (Walze) of an Enigma machine.
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
 *
 * @author Rafal Masiarek <rafalmasiarek@hotmail.com>
 */
class EnigmaRotor
{
    /**
     * stores the setup for all available rotors.
     *
     * @var array<int, EnigmaSetup>|null
     */
    private static ?array $defaultSetup = null;

    /**
     * Get the setup for all available rotors.
     *
     * @return array<int, EnigmaSetup>
     */
    public static function getDefaultSetup(): array
    {
        if (self::$defaultSetup === null) {
            self::$defaultSetup = [
                new EnigmaSetup(RotorType::I, 'EKMFLGDQVZNTOWYHXUSPAIBRCJ', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Letter::Q]),
                new EnigmaSetup(RotorType::II, 'AJDKSIRUXBLHWTMCQGZNPYFVOE', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Letter::E]),
                new EnigmaSetup(RotorType::III, 'BDFHJLCPRTXVZNYEIWGAKMUSQO', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Letter::V]),
                new EnigmaSetup(RotorType::IV, 'ESOVPZJAYQUIRHXLNFTGKDCMWB', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Letter::J]),
                new EnigmaSetup(RotorType::V, 'VZBRGITYUPSDNHLXAWMJQOFECK', [EnigmaModel::WMLW, EnigmaModel::KMM3, EnigmaModel::KMM4], [Letter::Z]),
                new EnigmaSetup(RotorType::VI, 'JPGVOUMFYQBENHZRDKASXLICTW', [EnigmaModel::KMM3, EnigmaModel::KMM4], [Letter::M, Letter::Z]),
                new EnigmaSetup(RotorType::VII, 'NZJHGRCXMYSWBOUFAIVLPEKQDT', [EnigmaModel::KMM3, EnigmaModel::KMM4], [Letter::M, Letter::Z]),
                new EnigmaSetup(RotorType::VIII, 'FKQHTLXOCBJSPDZRAMEWNIUYGV', [EnigmaModel::KMM3, EnigmaModel::KMM4], [Letter::M, Letter::Z]),
                new EnigmaSetup(RotorType::BETA, 'LEYJVCNIXWPBQMDRTAKZGFUHOS', [EnigmaModel::KMM4], []),
                new EnigmaSetup(RotorType::GAMMA, 'FSOKANUERHMBTIYCWLQPZXVGJD', [EnigmaModel::KMM4], []),
            ];
        }

        return self::$defaultSetup;
    }

    /**
     * Create a rotor from its type.
     *
     * @param RotorType $type The type of rotor to create
     * @param Letter $ringstellung The ring setting (default: A)
     *
     * @throws \InvalidArgumentException If the rotor type is not found
     *
     * @return self A new rotor instance
     */
    public static function fromType(RotorType $type, Letter $ringstellung = Letter::A): self
    {
        foreach (self::getDefaultSetup() as $setup) {
            if ($setup->type === $type) {
                $rotor = new self($setup->wiring, $setup->notches ?? []);
                $rotor->type = $type;
                $rotor->setRingstellung($ringstellung);

                return $rotor;
            }
        }

        throw new \InvalidArgumentException("Unknown rotor type: {$type->name}");
    }

    /**
     * The wiring of a rotor.
     *
     * @var EnigmaWiring
     */
    private EnigmaWiring $wiring;

    /**
     * The positions of the notches of a rotor.
     *
     * @var array<Letter> Letter positions of the notches
     */
    private array $notches;

    /**
     * Actual position of the rotor.
     *
     * @var int actual rotorpositions
     */
    private int $position = 0;

    /**
     * Offset of the wiring.
     *
     * @var int actual positions rotor
     */
    private int $ringstellung = 0;

    /**
     * The type of the rotor (if created from a known type).
     */
    private ?RotorType $type = null;

    /**
     * A rotor is in use or available.
     *
     * @var bool
     */
    public bool $inUse = false;

    /**
     * Constructor creates a new Wiring with the setup from $wiring and stores positions of the notches.
     *
     * @param string $wiring setup for the wiring
     * @param array<Letter> $notches positions of the notches
     */
    public function __construct(string $wiring, array $notches)
    {
        $this->wiring = new EnigmaWiring($wiring);
        $this->notches = $notches;
    }

    /**
     * Advance the rotor by 1 step.
     * When postion reaches Letter::count(), it is reset to 0.
     *
     * @return void
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
        foreach ($this->notches as $notch) {
            if ($this->position === $notch->value) {
                return true;
            }
        }

        return false;
    }

    /**
     * Send an letter from side A through the wiring to side B.
     * To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br>
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
     * Send an letter from side B through the wiring to side A.
     * To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br>
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
     *
     * @return void
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
     *
     * @return void
     */
    public function setRingstellung(Letter $letter): void
    {
        $this->ringstellung = $letter->value;
    }

    /**
     * Get the type of the rotor.
     *
     * @return RotorType|null The rotor type, or null if created with custom wiring
     */
    public function getType(): ?RotorType
    {
        return $this->type;
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
        if ($this->type === null) {
            // Custom rotors are assumed compatible
            return true;
        }

        foreach (self::getDefaultSetup() as $setup) {
            if ($setup->type === $this->type) {
                return \in_array($model, $setup->compatibleModels, true);
            }
        }

        return false;
    }

    /**
     * Check if this rotor is a Greek rotor (BETA or GAMMA).
     *
     * @return bool True if this is a Greek rotor
     */
    public function isGreekRotor(): bool
    {
        return $this->type === RotorType::BETA || $this->type === RotorType::GAMMA;
    }

    /**
     * Deep clone the rotor.
     */
    public function __clone(): void
    {
        $this->wiring = clone $this->wiring;
    }
}
