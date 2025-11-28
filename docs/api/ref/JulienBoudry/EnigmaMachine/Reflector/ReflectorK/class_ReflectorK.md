> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **ReflectorK**
# Class ReflectorK
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorK.php#L20)

## Description
Commercial Enigma K (A27) Reflector (Umkehrwalze).

Standard commercial wiring (handelsübliche Schaltung).
Also used by Swiss-K (the Swiss only rewired the rotors, not the reflector).

Note: The commercial models use QWERTZ entry wheel, but the reflector wiring
is measured relative to the entry wheel contacts.
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractReflector/method___clone.md) | _Deep clone the reflector._ |
| [__construct(...)](../AbstractReflector/method___construct.md) | _Constructor creates a new Wiring with the setup from the concrete class._ |
| [getType(...)](method_getType.md) | __ |
| [processLetter(...)](../AbstractReflector/method_processLetter.md) | _Send a letter through the wiring._ |


## Public Representation
```php
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorK extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```

## Full Representation
```php
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorK extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```