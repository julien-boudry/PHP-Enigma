> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **AbstractEntryWheel**
# Class AbstractEntryWheel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheel/AbstractEntryWheel.php#L19)

## Description
Abstract base class for Entry Wheels (Eintrittswalze, ETW).

The entry wheel is the first component the signal passes through when entering
the rotor assembly. It maps keyboard positions to rotor contact positions.

Different Enigma models use different entry wheel configurations:
- Military models use alphabetical order (identity mapping)
- Commercial models use QWERTZ keyboard order
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | _Deep clone the entry wheel._ |
| [__construct(...)](method___construct.md) | _Constructor creates the entry wheel wiring._ |
| [getWiringString(...)](method_getWiringString.md) | _Get the wiring string for this entry wheel._ |
| [processInward(...)](method_processInward.md) | _Process a letter entering the rotor assembly (keyboard → rotors)._ |
| [processOutward(...)](method_processOutward.md) | _Process a letter exiting the rotor assembly (rotors → lamps)._ |


## Public Representation
```php
abstract class JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel
{

    // Methods
    public function __clone( ): void;
    public function __construct( );
    abstract public function getWiringString( ): string;
    public function processInward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function processOutward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```

## Full Representation
```php
abstract class JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel
{

    // Properties
    protected JulienBoudry\EnigmaMachine\EnigmaWiring $wiring;

    // Methods
    public function __clone( ): void;
    public function __construct( );
    abstract public function getWiringString( ): string;
    public function processInward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function processOutward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```