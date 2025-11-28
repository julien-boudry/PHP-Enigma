> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **ReflectorSwissK**
# Class ReflectorSwissK
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorSwissK.php#L17)

## Description
Swiss-K Reflector (Umkehrwalze).

The Swiss used the same reflector wiring as the commercial Enigma K.
They only modified the rotor wirings for additional security.
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
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorSwissK extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
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
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorSwissK extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```