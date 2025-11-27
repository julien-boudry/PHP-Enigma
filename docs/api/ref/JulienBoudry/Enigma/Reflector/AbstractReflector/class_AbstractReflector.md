> JulienBoudry \ [Enigma](../../readme.md) \ **AbstractReflector**
# Class AbstractReflector
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/AbstractReflector.php#L21)

## Description
After passing through the plugboard and all rotors, the reflector redirects the signal
back through the rotors in reverse order. Because no letter connects to itself,
the signal always takes a different return path.

This reciprocal property enables the Enigma to work for both encryption and decryption
using the same settings—encoding the same message twice returns the original text.
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | __ |
| [processLetter(...)](method_processLetter.md) | _Because pins are connected in pairs, there is no difference if processLetter1stPass() or processLetter2ndPass() is used._ |


## Public Representation
```php
abstract class JulienBoudry\Enigma\Reflector\AbstractReflector
{

    // Methods
    public function __clone( ): void;
    public function __construct( );
    public function processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```

## Full Representation
```php
abstract class JulienBoudry\Enigma\Reflector\AbstractReflector
{

    // Properties
    private JulienBoudry\Enigma\EnigmaWiring $wiring;

    // Methods
    public function __clone( ): void;
    public function __construct( );
    public function processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```