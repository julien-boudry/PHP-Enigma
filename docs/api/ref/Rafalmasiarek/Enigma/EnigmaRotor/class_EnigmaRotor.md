> Rafalmasiarek \ **EnigmaRotor**
# Class EnigmaRotor
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaRotor.php#L32)
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [getDefaultSetup(...)](method_getDefaultSetup.md) | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [inUse(...)](property_inUse.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |
| [advance(...)](method_advance.md) | _When postion reaches ENIGMA_ALPHABET_SIZE, it is reset to 0._ |
| [getPosition(...)](method_getPosition.md) | __ |
| [isNotchOpen(...)](method_isNotchOpen.md) | _Returns true if the rotor is in a turnover position for the next rotor_ |
| [processLetter1stPass(...)](method_processLetter1stPass.md) | _To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br> + ENIGMA_ALPHABET_SIZE and % ENIGMA_ALPHABET_SIZE keep the value pos..._ |
| [processLetter2ndPass(...)](method_processLetter2ndPass.md) | _To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br> + ENIGMA_ALPHABET_SIZE and % ENIGMA_ALPHABET_SIZE keep the value pos..._ |
| [setPosition(...)](method_setPosition.md) | __ |
| [setRingstellung(...)](method_setRingstellung.md) | __ |


## Public Representation
```php
class Rafalmasiarek\Enigma\EnigmaRotor
{

    // Properties
    public bool $inUse = false;

    // Static Methods
    public static function getDefaultSetup( ): array;

    // Methods
    public function __construct( string $wiring, array $notches );
    public function advance( ): void;
    public function getPosition( ): int;
    public function isNotchOpen( ): bool;
    public function processLetter1stPass( int $letter ): int;
    public function processLetter2ndPass( int $letter ): int;
    public function setPosition( int $letter ): void;
    public function setRingstellung( int $letter ): void;

}
```

## Full Representation
```php
class Rafalmasiarek\Enigma\EnigmaRotor
{

    // Static Properties
    private static ?array $defaultSetup = null;

    // Properties
    public bool $inUse = false;
    private array $notches;
    private int $position = 0;
    private int $ringstellung = 0;
    private Rafalmasiarek\Enigma\EnigmaWiring $wiring;

    // Static Methods
    public static function getDefaultSetup( ): array;

    // Methods
    public function __construct( string $wiring, array $notches );
    public function advance( ): void;
    public function getPosition( ): int;
    public function isNotchOpen( ): bool;
    public function processLetter1stPass( int $letter ): int;
    public function processLetter2ndPass( int $letter ): int;
    public function setPosition( int $letter ): void;
    public function setRingstellung( int $letter ): void;

}
```