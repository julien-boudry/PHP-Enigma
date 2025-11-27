> JulienBoudry \ **EnigmaReflector**
# Class EnigmaReflector
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaReflector.php#L19)

## Description
After passing through the plugboard and all rotors, the reflector redirects the signal
back through the rotors in reverse order. Because no letter connects to itself,
the signal always takes a different return path.

This reciprocal property enables the Enigma to work for both encryption and decryption
using the same settings—encoding the same message twice returns the original text.
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [getDefaultSetup(...)](method_getDefaultSetup.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | __ |
| [processLetter(...)](method_processLetter.md) | _Because pins are connected in pairs, there is no difference if processLetter1stPass() or processLetter2ndPass() is used._ |


## Public Representation
```php
class JulienBoudry\Enigma\EnigmaReflector
{

    // Static Methods
    public static function getDefaultSetup( ): array;

    // Methods
    public function __clone( ): void;
    public function __construct( string $wiring );
    public function processLetter( int $letter ): int;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\EnigmaReflector
{

    // Static Properties
    private static ?array $defaultSetup = null;

    // Properties
    private JulienBoudry\Enigma\EnigmaWiring $wiring;

    // Static Methods
    public static function getDefaultSetup( ): array;

    // Methods
    public function __clone( ): void;
    public function __construct( string $wiring );
    public function processLetter( int $letter ): int;

}
```