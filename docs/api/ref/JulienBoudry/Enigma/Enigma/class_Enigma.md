> JulienBoudry \ **Enigma**
# Class Enigma
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L24)

## Description
This class emulates the historical Enigma machine used during World War II.
Three different models can be emulated (Wehrmacht/Luftwaffe, Kriegsmarine M3, and Kriegsmarine M4),
each with its own set of rotors and reflectors.

Depending on the model, 3 or 4 rotors are mounted. Only the first three rotors can be triggered
by the advance mechanism. A letter is encoded by sending its corresponding signal through:
plugboard → rotors 1..3(4) → reflector → rotors 3(4)..1 → plugboard.

After each encoded letter, the advance mechanism changes the internal setup by rotating the rotors.
## Elements

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [model(...)](property_model.md) | __ |
| [plugboard(...)](property_plugboard.md) | __ |
| [reflector(...)](property_reflector.md) | __ |
| [rotors(...)](property_rotors.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | _This ensures all internal components (plugboard, rotors, reflector) are properly cloned so the cloned machine operates independently._ |
| [__construct(...)](method___construct.md) | _The initital rotors and reflectros are mounted._ |
| [encodeBinary(...)](method_encodeBinary.md) | _This method converts binary data to Enigma-compatible format and encodes it. Useful for encoding arbitrary data that isn't text._ |
| [encodeLatinText(...)](method_encodeLatinText.md) | _This method accepts Latin-based text (including numbers, accented characters, punctuation, spaces, etc.) and converts it to Enigma-compatible format before encoding. Non-Latin characters (Cyrillic, Ch..._ |
| [encodeLetter(...)](method_encodeLetter.md) | _The letter passes the plugboard, the rotors, the reflector, the rotors in the opposite direction and again the plugboard. Every encoding triggers the advancemechanism._ |
| [encodeLetters(...)](method_encodeLetters.md) | _This method processes each character in the input through the Enigma machine. The input must contain only valid Enigma alphabet characters (A-Z). Use encodeText() for arbitrary text that needs convers..._ |
| [getPosition(...)](method_getPosition.md) | __ |
| [mountReflector(...)](method_mountReflector.md) | _The previously used reflector will be replaced._ |
| [plugLetters(...)](method_plugLetters.md) | __ |
| [setPosition(...)](method_setPosition.md) | __ |
| [unplugLetters(...)](method_unplugLetters.md) | _Because letters are connected in pairs, we only need to know one of them._ |


## Public Representation
```php
class JulienBoudry\Enigma\Enigma
{

    // Properties
    public protected(set) readonly protected(set) JulienBoudry\Enigma\EnigmaModel $model;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\EnigmaPlugboard $plugboard;
    final public private(set) private(set) JulienBoudry\Enigma\Reflector\AbstractReflector $reflector;
    final public private(set) private(set) JulienBoudry\Enigma\RotorConfiguration $rotors;

    // Methods
    public function __clone( ): void;
    public function __construct( JulienBoudry\Enigma\EnigmaModel $model, JulienBoudry\Enigma\RotorConfiguration $rotors, JulienBoudry\Enigma\ReflectorType $reflector );
    public function encodeBinary( string $binaryData, [ bool $formatOutput = false ] ): string;
    public function encodeLatinText( string $text, [ string $spaceReplacement = 'X', bool $formatOutput = false ] ): string;
    public function encodeLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function encodeLetters( string $letters ): string;
    public function getPosition( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\Letter;
    public function mountReflector( JulienBoudry\Enigma\ReflectorType $reflector ): void;
    public function plugLetters( JulienBoudry\Enigma\Letter $letter1, JulienBoudry\Enigma\Letter $letter2 ): void;
    public function setPosition( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\Letter $letter ): void;
    public function unplugLetters( JulienBoudry\Enigma\Letter $letter ): void;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\Enigma
{

    // Properties
    public protected(set) readonly protected(set) JulienBoudry\Enigma\EnigmaModel $model;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\EnigmaPlugboard $plugboard;
    final public private(set) private(set) JulienBoudry\Enigma\Reflector\AbstractReflector $reflector;
    final public private(set) private(set) JulienBoudry\Enigma\RotorConfiguration $rotors;

    // Methods
    public function __clone( ): void;
    public function __construct( JulienBoudry\Enigma\EnigmaModel $model, JulienBoudry\Enigma\RotorConfiguration $rotors, JulienBoudry\Enigma\ReflectorType $reflector );
    public function encodeBinary( string $binaryData, [ bool $formatOutput = false ] ): string;
    public function encodeLatinText( string $text, [ string $spaceReplacement = 'X', bool $formatOutput = false ] ): string;
    public function encodeLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function encodeLetters( string $letters ): string;
    public function getPosition( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\Letter;
    public function mountReflector( JulienBoudry\Enigma\ReflectorType $reflector ): void;
    public function plugLetters( JulienBoudry\Enigma\Letter $letter1, JulienBoudry\Enigma\Letter $letter2 ): void;
    public function setPosition( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\Letter $letter ): void;
    public function unplugLetters( JulienBoudry\Enigma\Letter $letter ): void;

}
```