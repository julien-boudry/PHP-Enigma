> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **AbstractEntryWheel**
# Class AbstractEntryWheel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheel/AbstractEntryWheel.php#L19)

## Description
The entry wheel is the first component the signal passes through when entering
the rotor assembly. It maps keyboard positions to rotor contact positions.

Different Enigma models use different entry wheel configurations:
- Military models use alphabetical order (identity mapping)
- Commercial models use QWERTZ keyboard order
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | __ |
| [processInward(...)](method_processInward.md) | __ |
| [processOutward(...)](method_processOutward.md) | __ |


## Public Representation
```php
abstract class JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel
{

    // Methods
    public function __clone( ): void;
    public function __construct( );
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
    public function processInward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function processOutward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```