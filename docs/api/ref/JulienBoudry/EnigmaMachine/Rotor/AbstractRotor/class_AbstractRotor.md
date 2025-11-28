> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **AbstractRotor**
# Class AbstractRotor
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Rotor/AbstractRotor.php#L30)

## Description
Abstract base class for Enigma rotors (Walzen).

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
| [getCompatibleModels(...)](method_getCompatibleModels.md) | _The compatible Enigma models for this rotor._ |
| [getNotches(...)](method_getNotches.md) | _The notch positions for this rotor._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [inUse(...)](property_inUse.md) | _A rotor is in use or available._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | _Deep clone the rotor._ |
| [__construct(...)](method___construct.md) | _Constructor creates a new Wiring with the setup from the WIRING constant._ |
| [advance(...)](method_advance.md) | _Advance the rotor by 1 step._ |
| [getPosition(...)](method_getPosition.md) | _Retrieve current position of the rotor._ |
| [getRingstellung(...)](method_getRingstellung.md) | _Retrieve current ringstellung (ring setting) of the rotor._ |
| [getType(...)](method_getType.md) | _Get the rotor type enum value._ |
| [isCompatibleWithModel(...)](method_isCompatibleWithModel.md) | _Check if this rotor is compatible with the given Enigma model._ |
| [isGreekRotor(...)](method_isGreekRotor.md) | _Check if this rotor is a Greek rotor (BETA or GAMMA)._ |
| [isNotchOpen(...)](method_isNotchOpen.md) | _A notch is open._ |
| [processLetter1stPass(...)](method_processLetter1stPass.md) | _Send a letter from side A through the wiring to side B._ |
| [processLetter2ndPass(...)](method_processLetter2ndPass.md) | _Send a letter from side B through the wiring to side A._ |
| [setPosition(...)](method_setPosition.md) | _Set the rotor to a given position._ |
| [setRingstellung(...)](method_setRingstellung.md) | _Sets the ringstellung to a given position._ |


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