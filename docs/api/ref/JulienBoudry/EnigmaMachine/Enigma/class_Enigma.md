> JulienBoudry \ **Enigma**
# Class Enigma
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L28)

## Description
Represents an Enigma cipher machine.

This class emulates the historical Enigma machine used during World War II.
Multiple models can be emulated:
- Military models (Wehrmacht/Luftwaffe, Kriegsmarine M3/M4) with plugboard
- Commercial models (Enigma K, Swiss-K, Railway) without plugboard

Depending on the model, 3 or 4 rotors are mounted. Only the first three rotors can be triggered
by the advance mechanism. A letter is encoded by sending its corresponding signal through:
[plugboard →] entry wheel → rotors 1..3(4) → reflector → rotors 3(4)..1 → entry wheel [→ plugboard].

After each encoded letter, the advance mechanism changes the internal setup by rotating the rotors.
## Elements

### Public Static Properties
| Properties Name | Description |
| ------------- | ------------- |
| [fileChunkSize(...)](static_property_fileChunkSize.md) | _Default chunk size for file encoding operations (1MB)._ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [createRandom(...)](method_createRandom.md) | _Create an Enigma machine with a random configuration._ |
| [createRandomWithConfiguration(...)](method_createRandomWithConfiguration.md) | _Create an Enigma machine with a random configuration and return both._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [entryWheel(...)](property_entryWheel.md) | _The entry wheel (Eintrittswalze) that maps keyboard to rotor contacts._ |
| [model(...)](property_model.md) | _The model of the Enigma machine._ |
| [plugboard(...)](property_plugboard.md) | _The plugboard that connects input and output to the entry wheel._ |
| [reflector(...)](property_reflector.md) | _The reflector used by the Enigma._ |
| [rotors(...)](property_rotors.md) | _The rotors used by the Enigma._ |
| [strictMode(...)](property_strictMode.md) | _Whether to enforce compatibility checks._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | _Deep clone the Enigma machine._ |
| [__construct(...)](method___construct.md) | _Constructor sets up the plugboard and creates the rotors and reflectros available for the given model._ |
| [decodeFile(...)](method_decodeFile.md) | _Decode an Enigma-encoded file back to binary, reading and writing sequentially._ |
| [encodeBinary(...)](method_encodeBinary.md) | _Encode binary data through the Enigma machine._ |
| [encodeFile(...)](method_encodeFile.md) | _Encode a file through the Enigma machine, reading and writing sequentially._ |
| [encodeLatinText(...)](method_encodeLatinText.md) | _Encode Latin text by first converting it to Enigma format._ |
| [encodeLetter(...)](method_encodeLetter.md) | _Encode a single letter._ |
| [encodeLetters(...)](method_encodeLetters.md) | _Encode a sequence of letters (A-Z only)._ |
| [getConfiguration(...)](method_getConfiguration.md) | _Get the current configuration of this Enigma machine._ |
| [getPosition(...)](method_getPosition.md) | _Get the current position of a rotor._ |
| [hasPlugboard(...)](method_hasPlugboard.md) | _Check if this model historically has a plugboard._ |
| [mountReflector(...)](method_mountReflector.md) | _Mount a reflector into the enigma._ |
| [plugLetters(...)](method_plugLetters.md) | _Connect 2 letters on the plugboard._ |
| [plugLettersFromPairs(...)](method_plugLettersFromPairs.md) | _Connect multiple letter pairs on the plugboard._ |
| [setPosition(...)](method_setPosition.md) | _Turn a rotor to a new position._ |
| [unplugLetters(...)](method_unplugLetters.md) | _Disconnects 2 letters on the plugboard._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\Enigma
{

    // Static Properties
    public static int $fileChunkSize = 1048576;

    // Properties
    public protected(set) readonly JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel $entryWheel;
    public protected(set) readonly JulienBoudry\EnigmaMachine\EnigmaModel $model;
    public protected(set) readonly JulienBoudry\EnigmaMachine\EnigmaPlugboard $plugboard;
    final public private(set) JulienBoudry\EnigmaMachine\Reflector\AbstractReflector $reflector;
    final public private(set) JulienBoudry\EnigmaMachine\RotorConfiguration $rotors;
    public bool $strictMode;

    // Static Methods
    public static function createRandom( JulienBoudry\EnigmaMachine\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): self;
    public static function createRandomWithConfiguration( JulienBoudry\EnigmaMachine\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): array;

    // Methods
    public function __clone( ): void;
    public function __construct( JulienBoudry\EnigmaMachine\EnigmaModel $model, JulienBoudry\EnigmaMachine\RotorConfiguration $rotors, JulienBoudry\EnigmaMachine\ReflectorType $reflector, [ bool $strictMode = true ] );
    public function decodeFile( SplFileObject|string $source, SplFileObject|string $destination ): int;
    public function encodeBinary( string $binaryData, [ bool $formatOutput = false ] ): string;
    public function encodeFile( SplFileObject|string $source, SplFileObject|string $destination ): int;
    public function encodeLatinText( string $text, [ string $spaceReplacement = 'X', bool $formatOutput = false ] ): string;
    public function encodeLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function encodeLetters( string $letters ): string;
    public function getConfiguration( ): JulienBoudry\EnigmaMachine\EnigmaConfiguration;
    public function getPosition( JulienBoudry\EnigmaMachine\RotorPosition $position ): JulienBoudry\EnigmaMachine\Letter;
    public function hasPlugboard( ): bool;
    public function mountReflector( JulienBoudry\EnigmaMachine\ReflectorType|JulienBoudry\EnigmaMachine\Reflector\AbstractReflector $reflector ): void;
    public function plugLetters( JulienBoudry\EnigmaMachine\Letter $letter1, JulienBoudry\EnigmaMachine\Letter $letter2 ): void;
    public function plugLettersFromPairs( array|string $pairs ): void;
    public function setPosition( JulienBoudry\EnigmaMachine\RotorPosition $position, JulienBoudry\EnigmaMachine\Letter $letter ): void;
    public function unplugLetters( JulienBoudry\EnigmaMachine\Letter $letter ): void;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\Enigma
{

    // Static Properties
    public static int $fileChunkSize = 1048576;

    // Properties
    public protected(set) readonly JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel $entryWheel;
    public protected(set) readonly JulienBoudry\EnigmaMachine\EnigmaModel $model;
    public protected(set) readonly JulienBoudry\EnigmaMachine\EnigmaPlugboard $plugboard;
    final public private(set) JulienBoudry\EnigmaMachine\Reflector\AbstractReflector $reflector;
    final public private(set) JulienBoudry\EnigmaMachine\RotorConfiguration $rotors;
    public bool $strictMode;

    // Static Methods
    public static function createRandom( JulienBoudry\EnigmaMachine\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): self;
    public static function createRandomWithConfiguration( JulienBoudry\EnigmaMachine\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): array;

    // Methods
    public function __clone( ): void;
    public function __construct( JulienBoudry\EnigmaMachine\EnigmaModel $model, JulienBoudry\EnigmaMachine\RotorConfiguration $rotors, JulienBoudry\EnigmaMachine\ReflectorType $reflector, [ bool $strictMode = true ] );
    public function decodeFile( SplFileObject|string $source, SplFileObject|string $destination ): int;
    public function encodeBinary( string $binaryData, [ bool $formatOutput = false ] ): string;
    public function encodeFile( SplFileObject|string $source, SplFileObject|string $destination ): int;
    public function encodeLatinText( string $text, [ string $spaceReplacement = 'X', bool $formatOutput = false ] ): string;
    public function encodeLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function encodeLetters( string $letters ): string;
    public function getConfiguration( ): JulienBoudry\EnigmaMachine\EnigmaConfiguration;
    public function getPosition( JulienBoudry\EnigmaMachine\RotorPosition $position ): JulienBoudry\EnigmaMachine\Letter;
    public function hasPlugboard( ): bool;
    public function mountReflector( JulienBoudry\EnigmaMachine\ReflectorType|JulienBoudry\EnigmaMachine\Reflector\AbstractReflector $reflector ): void;
    public function plugLetters( JulienBoudry\EnigmaMachine\Letter $letter1, JulienBoudry\EnigmaMachine\Letter $letter2 ): void;
    public function plugLettersFromPairs( array|string $pairs ): void;
    public function setPosition( JulienBoudry\EnigmaMachine\RotorPosition $position, JulienBoudry\EnigmaMachine\Letter $letter ): void;
    public function unplugLetters( JulienBoudry\EnigmaMachine\Letter $letter ): void;

}
```