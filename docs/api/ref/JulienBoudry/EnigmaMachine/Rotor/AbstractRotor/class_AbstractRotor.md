> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **AbstractRotor**
# Class AbstractRotor
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Rotor/AbstractRotor.php#L30)

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
| [getCompatibleModels(...)](method_getCompatibleModels.md) | __ |
| [getNotches(...)](method_getNotches.md) | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [inUse(...)](property_inUse.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | __ |
| [advance(...)](method_advance.md) | _When position reaches Letter::count(), it is reset to 0._ |
| [getPosition(...)](method_getPosition.md) | __ |
| [getRingstellung(...)](method_getRingstellung.md) | __ |
| [getType(...)](method_getType.md) | __ |
| [isCompatibleWithModel(...)](method_isCompatibleWithModel.md) | __ |
| [isGreekRotor(...)](method_isGreekRotor.md) | __ |
| [isNotchOpen(...)](method_isNotchOpen.md) | _Returns true if the rotor is in a turnover position for the next rotor._ |
| [processLetter1stPass(...)](method_processLetter1stPass.md) | _To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account. + Letter::count() and % Letter::count() keep the value positive and in b..._ |
| [processLetter2ndPass(...)](method_processLetter2ndPass.md) | _To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account. + Letter::count() and % Letter::count() keep the value positive and in b..._ |
| [setPosition(...)](method_setPosition.md) | __ |
| [setRingstellung(...)](method_setRingstellung.md) | __ |


## Public Representation
```php
abstract class JulienBoudry\EnigmaMachine\Rotor\AbstractRotor
{

    // Properties
    public bool $inUse = false;

    // Static Methods
    abstract public static function getCompatibleModels( ): array;
    abstract public static function getNotches( ): array;

    // Methods
    public function __clone( ): void;
    public function __construct( [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] );
    public function advance( ): void;
    public function getPosition( ): JulienBoudry\EnigmaMachine\Letter;
    public function getRingstellung( ): JulienBoudry\EnigmaMachine\Letter;
    abstract public function getType( ): JulienBoudry\EnigmaMachine\RotorType;
    public function isCompatibleWithModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): bool;
    public function isGreekRotor( ): bool;
    public function isNotchOpen( ): bool;
    public function processLetter1stPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function processLetter2ndPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function setPosition( JulienBoudry\EnigmaMachine\Letter $letter ): void;
    public function setRingstellung( JulienBoudry\EnigmaMachine\Letter $letter ): void;

}
```

## Full Representation
```php
abstract class JulienBoudry\EnigmaMachine\Rotor\AbstractRotor
{

    // Properties
    public bool $inUse = false;
    private int $position = 0;
    private int $ringstellung = 0;
    private JulienBoudry\EnigmaMachine\EnigmaWiring $wiring;

    // Static Methods
    abstract public static function getCompatibleModels( ): array;
    abstract public static function getNotches( ): array;
    abstract protected static function getWiring( ): string;

    // Methods
    public function __clone( ): void;
    public function __construct( [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] );
    public function advance( ): void;
    public function getPosition( ): JulienBoudry\EnigmaMachine\Letter;
    public function getRingstellung( ): JulienBoudry\EnigmaMachine\Letter;
    abstract public function getType( ): JulienBoudry\EnigmaMachine\RotorType;
    public function isCompatibleWithModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): bool;
    public function isGreekRotor( ): bool;
    public function isNotchOpen( ): bool;
    public function processLetter1stPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function processLetter2ndPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function setPosition( JulienBoudry\EnigmaMachine\Letter $letter ): void;
    public function setRingstellung( JulienBoudry\EnigmaMachine\Letter $letter ): void;

}
```