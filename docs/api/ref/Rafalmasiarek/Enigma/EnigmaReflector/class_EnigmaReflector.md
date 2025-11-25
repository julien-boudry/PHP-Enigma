> Rafalmasiarek \ **EnigmaReflector**
# Class EnigmaReflector
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaReflector.php#L20)
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [getDefaultSetup(...)](method_getDefaultSetup.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |
| [processLetter(...)](method_processLetter.md) | _Because pins are connected in pairs, there is no difference if processLetter1stPass() or processLetter2ndPass() is used._ |


## Public Representation
```php
class Rafalmasiarek\Enigma\EnigmaReflector
{

    // Static Methods
    public static function getDefaultSetup( ): array;

    // Methods
    public function __construct( string $wiring );
    public function processLetter( int $letter ): int;

}
```

## Full Representation
```php
class Rafalmasiarek\Enigma\EnigmaReflector
{

    // Static Properties
    private static ?array $defaultSetup = null;

    // Properties
    private Rafalmasiarek\Enigma\EnigmaWiring $wiring;

    // Static Methods
    public static function getDefaultSetup( ): array;

    // Methods
    public function __construct( string $wiring );
    public function processLetter( int $letter ): int;

}
```