> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **AbstractReflector**
# Class AbstractReflector
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/AbstractReflector.php#L21)

## Description
Abstract base class for Enigma Reflectors (Umkehrwalze).

After passing through the plugboard and all rotors, the reflector redirects the signal
back through the rotors in reverse order. Because no letter connects to itself,
the signal always takes a different return path.

This reciprocal property enables the Enigma to work for both encryption and decryption
using the same settings—encoding the same message twice returns the original text.
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | _Deep clone the reflector._ |
| [__construct(...)](method___construct.md) | _Constructor creates a new Wiring with the setup from the concrete class._ |
| [getType(...)](method_getType.md) | _Get the reflector type._ |
| [processLetter(...)](method_processLetter.md) | _Send a letter through the wiring._ |


## Public Representation
```php
abstract class JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Methods
    public function __clone( ): void;
    public function __construct( );
    abstract public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;
    public function processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```

## Full Representation
```php
abstract class JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Properties
    private JulienBoudry\EnigmaMachine\EnigmaWiring $wiring;

    // Methods
    public function __clone( ): void;
    public function __construct( );
    abstract public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;
    public function processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```