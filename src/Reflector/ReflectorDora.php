<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Reflector;

use JulienBoudry\EnigmaMachine\Exception\EnigmaWiringException;
use JulienBoudry\EnigmaMachine\{Letter, ReflectorType};

/**
 * UKW-D (Umkehrwalze Dora) - Rewirable Reflector.
 *
 * The UKW-D was a rewirable reflector introduced by the Wehrmacht/Luftwaffe in January 1944.
 * Unlike fixed reflectors (B, C), operators could configure their own wiring using plug cables.
 *
 * The physical device had 12 plug cables connecting 24 sockets. The remaining 2 positions
 * (B and O in Bletchley Park notation, or J and Y) were occupied by spring-loaded balls holding the
 * inner core in place, creating a fixed B↔O (or J↔Y) pair on the physical device.
 *
 * Mapping between Bletchley Park (BP) notation and German (DE) index ring:
 * BP: A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
 * DE: A - Z X W V U T S R Q P O N - M L K I H G F E D C B
 *
 * In BP notation (standard A-Z), the fixed pair is B↔O.
 * In German notation, the letters J and Y are omitted from the ring, and the
 * physical gaps (marked '-') correspond to the fixed connections.
 *
 * This software implementation allows full flexibility with 13 configurable pairs,
 * though the default wiring includes the historical B↔O pair.
 *
 * The wiring was typically changed every 10 days as per the key sheets.
 * This reflector was compatible with 3-rotor Enigma models (Wehrmacht/Luftwaffe).
 *
 * @see https://www.cryptomuseum.com/crypto/enigma/ukwd/index.htm
 */
final class ReflectorDora extends AbstractReflector
{
    /**
     * Default wiring pairs for UKW-D.
     *
     * Historical default: B↔O was fixed on the physical device.
     * Format: 13 pairs separated by spaces (26 letters total).
     */
    public const string DEFAULT_WIRING = 'AC BO DE FG HI JK LM NP QR ST UV WX YZ';

    /**
     * The custom wiring configuration.
     */
    private string $customWiring;

    /**
     * Create a UKW-D reflector with custom wiring.
     *
     * @param array<string, string> $pairs Array of 13 letter pairs, e.g., ['A' => 'C', 'B' => 'O', ...]
     *
     * @throws \InvalidArgumentException If the wiring is invalid
     */
    public function __construct(array $pairs)
    {
        $this->customWiring = $this->buildWiring($pairs);
        parent::__construct();
    }

    /**
     * Build the 26-character wiring string from pairs.
     *
     * @param array<string, string> $pairs
     *
     * @throws \InvalidArgumentException
     */
    private function buildWiring(array $pairs): string
    {
        $this->validatePairs($pairs);

        // Build the wiring string (26 characters, one for each letter position)
        $wiring = array_fill(0, 26, null);

        foreach ($pairs as $from => $to) {
            $from = strtoupper((string) $from);
            $to = strtoupper($to);

            $fromIndex = \ord($from) - \ord('A');
            $toIndex = \ord($to) - \ord('A');

            $wiring[$fromIndex] = $to;
            $wiring[$toIndex] = $from;
        }

        return implode('', $wiring);
    }

    /**
     * Validate the wiring pairs.
     *
     * @param array<string, string> $pairs
     *
     * @throws EnigmaWiringException If the wiring is invalid
     */
    private function validatePairs(array $pairs): void
    {
        if (\count($pairs) !== 13) {
            throw new EnigmaWiringException(
                'UKW-D requires exactly 13 pairs. Got ' . \count($pairs) . ' pairs.'
            );
        }

        $usedLetters = [];

        foreach ($pairs as $from => $to) {
            // Ensure keys are strings (could be int if numeric)
            $from = (string) $from;

            // Validate letter format
            if (\strlen($from) !== 1 || !ctype_alpha($from)) {
                throw new EnigmaWiringException("Invalid letter: '{$from}'");
            }
            if (\strlen($to) !== 1 || !ctype_alpha($to)) {
                throw new EnigmaWiringException("Invalid letter: '{$to}'");
            }

            $from = strtoupper($from);
            $to = strtoupper($to);

            // No letter can connect to itself
            if ($from === $to) {
                throw new EnigmaWiringException("Letter '{$from}' cannot connect to itself");
            }

            // Check for duplicate letters
            if (\in_array($from, $usedLetters, true)) {
                throw new EnigmaWiringException("Letter '{$from}' is used more than once");
            }
            if (\in_array($to, $usedLetters, true)) {
                throw new EnigmaWiringException("Letter '{$to}' is used more than once");
            }

            $usedLetters[] = $from;
            $usedLetters[] = $to;
        }

        // Verify all 26 letters are used
        if (\count($usedLetters) !== 26) {
            $missing = array_diff(range('A', 'Z'), $usedLetters);

            throw new EnigmaWiringException(
                'All 26 letters must be paired. Missing: ' . implode(', ', $missing)
            );
        }
    }

    /**
     * Get the wiring configuration.
     */
    protected function getWiring(): string
    {
        return $this->customWiring;
    }

    /**
     * Get the wiring pairs as an array of Letter tuples.
     *
     * @return list<array{Letter, Letter}> The 13 wiring pairs
     */
    public function getWiringPairs(): array
    {
        $pairs = [];
        $usedLetters = [];

        for ($i = 0; $i < 26; $i++) {
            $fromChar = \chr(\ord('A') + $i);
            $toChar = $this->customWiring[$i];

            if (!\in_array($fromChar, $usedLetters, true) && !\in_array($toChar, $usedLetters, true)) {
                $pairs[] = [Letter::fromChar($fromChar), Letter::fromChar($toChar)];
                $usedLetters[] = $fromChar;
                $usedLetters[] = $toChar;
            }
        }

        return $pairs;
    }

    /**
     * Get the reflector type.
     *
     * Returns DORA for default wiring, null for custom configurations.
     */
    public function getType(): ReflectorType
    {
        return ReflectorType::DORA;
    }

    /**
     * Create a ReflectorDora from a simple string of pairs.
     *
     * @param $pairsString 13 pairs as a string, e.g., "AC BO DE FG HI JK LM NP QR ST UV WX YZ"
     *
     * @throws EnigmaWiringException If the string format is invalid
     *
     * @return self
     */
    public static function fromString(string $pairsString): self
    {
        $cleaned = preg_replace('/\s+/', '', $pairsString);
        if ($cleaned === null) {
            throw new EnigmaWiringException('Invalid pairs string');
        }
        $pairsString = strtoupper($cleaned);

        if (\strlen($pairsString) !== 26) {
            throw new EnigmaWiringException(
                'Pairs string must contain exactly 26 characters (13 pairs). Got ' . \strlen($pairsString) . ' characters.'
            );
        }

        $pairs = [];
        for ($i = 0; $i < 26; $i += 2) {
            $from = $pairsString[$i];
            $to = $pairsString[$i + 1];
            $pairs[$from] = $to;
        }

        return new self($pairs);
    }

    /**
     * Get a default wiring configuration.
     *
     * This uses a historically plausible configuration including the B↔O pair
     * (or J↔Y depending on notation) which was fixed on the physical device
     * due to mechanical constraints.
     *
     * @return self
     */
    public static function withDefaultWiring(): self
    {
        return self::fromString(self::DEFAULT_WIRING);
    }
}
