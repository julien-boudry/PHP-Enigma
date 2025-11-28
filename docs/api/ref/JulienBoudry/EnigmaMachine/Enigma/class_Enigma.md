> JulienBoudry \ **Enigma**
# Class Enigma
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L28)

## Description
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
| [fileChunkSize(...)](static_property_fileChunkSize.md) | _This value determines how many bytes are read at a time when using encodeFile(). Adjust this value to balance memory usage vs. performance._ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [createRandom(...)](method_createRandom.md) | _Generates cryptographically secure random settings including: - Random rotor selection and order (compatible with model) - Random ring settings (Ringstellung) - Random initial positions (Grundstellung..._ |
| [createRandomWithConfiguration(...)](method_createRandomWithConfiguration.md) | _Same as createRandom() but also returns the configuration object, which is useful for logging, debugging, or recreating the same setup._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [entryWheel(...)](property_entryWheel.md) | _Uses QWERTZ order for commercial models, alphabetical for military._ |
| [model(...)](property_model.md) | __ |
| [plugboard(...)](property_plugboard.md) | _Always present but empty by default on commercial models. In strictMode, commercial models cannot use the plugboard._ |
| [reflector(...)](property_reflector.md) | __ |
| [rotors(...)](property_rotors.md) | __ |
| [strictMode(...)](property_strictMode.md) | _When true (default), validates that rotors and reflectors are compatible with the selected model. When false, bypasses all compatibility checks and allows any configuration (including plugboard on com..._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | _This ensures all internal components (plugboard, entry wheel, rotors, reflector) are properly cloned so the cloned machine operates independently._ |
| [__construct(...)](method___construct.md) | _The initital rotors and reflectros are mounted._ |
| [decodeFile(...)](method_decodeFile.md) | _This method is the inverse of encodeFile(). It reads an Enigma-encoded file, decodes it through the Enigma machine, and converts the result back to binary.  IMPORTANT: The Enigma machine must be in th..._ |
| [encodeBinary(...)](method_encodeBinary.md) | _This method converts binary data to Enigma-compatible format and encodes it. Useful for encoding arbitrary data that isn't text._ |
| [encodeFile(...)](method_encodeFile.md) | _This method processes the source file in chunks to minimize memory usage, making it suitable for encoding large files. Each chunk is converted to Enigma format and encoded before being written to the ..._ |
| [encodeLatinText(...)](method_encodeLatinText.md) | _This method accepts Latin-based text (including numbers, accented characters, punctuation, spaces, etc.) and converts it to Enigma-compatible format before encoding. Non-Latin characters (Cyrillic, Ch..._ |
| [encodeLetter(...)](method_encodeLetter.md) | _The letter passes the plugboard (if available), entry wheel, rotors, reflector, rotors in the opposite direction, entry wheel again, and plugboard (if available). Every encoding triggers the advance m..._ |
| [encodeLetters(...)](method_encodeLetters.md) | _This method processes each character in the input through the Enigma machine. The input must contain only valid Enigma alphabet characters (A-Z). Use encodeText() for arbitrary text that needs convers..._ |
| [getConfiguration(...)](method_getConfiguration.md) | _Extracts the complete state including rotor types, ring settings, current positions, reflector, and plugboard configuration._ |
| [getPosition(...)](method_getPosition.md) | __ |
| [hasPlugboard(...)](method_hasPlugboard.md) | _Military models have plugboards, commercial models do not. Note: The plugboard object always exists internally, but this method indicates whether it should be used according to historical accuracy._ |
| [mountReflector(...)](method_mountReflector.md) | _The previously used reflector will be replaced._ |
| [plugLetters(...)](method_plugLetters.md) | _Only available on military models (Wehrmacht, Kriegsmarine). Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard._ |
| [plugLettersFromPairs(...)](method_plugLettersFromPairs.md) | _Only available on military models (Wehrmacht, Kriegsmarine). Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.  Accepts pairs in various formats: - Space-separated string: "AV BS..._ |
| [setPosition(...)](method_setPosition.md) | __ |
| [unplugLetters(...)](method_unplugLetters.md) | _Because letters are connected in pairs, we only need to know one of them.  Only available on military models (Wehrmacht, Kriegsmarine). Commercial models (Enigma K, Swiss-K, Railway) do not have a plu..._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\Enigma
{

    // Static Properties
    public static int $fileChunkSize = 1048576;

    // Properties
    public protected(set) readonly protected(set) JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel $entryWheel;
    public protected(set) readonly protected(set) JulienBoudry\EnigmaMachine\EnigmaModel $model;
    public protected(set) readonly protected(set) JulienBoudry\EnigmaMachine\EnigmaPlugboard $plugboard;
    final public private(set) private(set) JulienBoudry\EnigmaMachine\Reflector\AbstractReflector $reflector;
    final public private(set) private(set) JulienBoudry\EnigmaMachine\RotorConfiguration $rotors;
    public bool $strictMode;

    // Static Methods
    public static function createRandom( JulienBoudry\EnigmaMachine\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): JulienBoudry\EnigmaMachine\Enigma;
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
    public protected(set) readonly protected(set) JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel $entryWheel;
    public protected(set) readonly protected(set) JulienBoudry\EnigmaMachine\EnigmaModel $model;
    public protected(set) readonly protected(set) JulienBoudry\EnigmaMachine\EnigmaPlugboard $plugboard;
    final public private(set) private(set) JulienBoudry\EnigmaMachine\Reflector\AbstractReflector $reflector;
    final public private(set) private(set) JulienBoudry\EnigmaMachine\RotorConfiguration $rotors;
    public bool $strictMode;

    // Static Methods
    public static function createRandom( JulienBoudry\EnigmaMachine\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): JulienBoudry\EnigmaMachine\Enigma;
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