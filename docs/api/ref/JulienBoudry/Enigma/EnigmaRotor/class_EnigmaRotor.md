> JulienBoudry \ **EnigmaRotor**
# Class EnigmaRotor
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaRotor.php#L30)

## Description
The rotors are the key element of the Enigma. Each provides a monoalphabetical substitution
through its internal wiring, but unlike the plugboard and reflector, rotors move,
causing the substitution to change with each keypress.

Example of rotor advancement:
<pre>
ABCDEFGHIJKLMNOPQRSTUVWXYZ
||||||||||||||||||||||||||
EKMFLGDQVZNTOWYHXUSPAIBRCJ
=>
ABCDEFGHIJKLMNOPQRSTUVWXYZ
||||||||||||||||||||||||||
JEKMFLGDQVZNTOWYHXUSPAIBRC
</pre>

Notches mark positions where the next rotor may advance (turnover).
The Ringstellung (ring setting) offsets the wiring relative to the notches and visible alphabet.
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
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | __ |
| [advance(...)](method_advance.md) | _When postion reaches Letter::count(), it is reset to 0._ |
| [getPosition(...)](method_getPosition.md) | __ |
| [isNotchOpen(...)](method_isNotchOpen.md) | _Returns true if the rotor is in a turnover position for the next rotor._ |
| [processLetter1stPass(...)](method_processLetter1stPass.md) | _To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br> + Letter::count() and % Letter::count() keep the value positive and ..._ |
| [processLetter2ndPass(...)](method_processLetter2ndPass.md) | _To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br> + Letter::count() and % Letter::count() keep the value positive and ..._ |
| [setPosition(...)](method_setPosition.md) | __ |
| [setRingstellung(...)](method_setRingstellung.md) | __ |


## Public Representation
```php
class JulienBoudry\Enigma\EnigmaRotor
{

    // Properties
    public bool $inUse = false;

    // Static Methods
    public static function getDefaultSetup( ): array;

    // Methods
    public function __clone( ): void;
    public function __construct( string $wiring, array $notches );
    public function advance( ): void;
    public function getPosition( ): JulienBoudry\Enigma\Letter;
    public function isNotchOpen( ): bool;
    public function processLetter1stPass( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function processLetter2ndPass( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function setPosition( JulienBoudry\Enigma\Letter $letter ): void;
    public function setRingstellung( JulienBoudry\Enigma\Letter $letter ): void;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\EnigmaRotor
{

    // Static Properties
    private static ?array $defaultSetup = null;

    // Properties
    public bool $inUse = false;
    private array $notches;
    private int $position = 0;
    private int $ringstellung = 0;
    private JulienBoudry\Enigma\EnigmaWiring $wiring;

    // Static Methods
    public static function getDefaultSetup( ): array;

    // Methods
    public function __clone( ): void;
    public function __construct( string $wiring, array $notches );
    public function advance( ): void;
    public function getPosition( ): JulienBoudry\Enigma\Letter;
    public function isNotchOpen( ): bool;
    public function processLetter1stPass( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function processLetter2ndPass( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function setPosition( JulienBoudry\Enigma\Letter $letter ): void;
    public function setRingstellung( JulienBoudry\Enigma\Letter $letter ): void;

}
```