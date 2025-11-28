> JulienBoudry \ [Enigma](../../readme.md) \ **ReflectorSwissK**
# Class ReflectorSwissK
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorSwissK.php#L17)

## Description
The Swiss used the same reflector wiring as the commercial Enigma K.
They only modified the rotor wirings for additional security.
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractReflector/method___clone.md) | __ |
| [__construct(...)](../AbstractReflector/method___construct.md) | __ |
| [getType(...)](method_getType.md) | __ |
| [processLetter(...)](../AbstractReflector/method_processLetter.md) | _Because pins are connected in pairs, there is no difference if processLetter1stPass() or processLetter2ndPass() is used._ |


## Public Representation
```php
final class JulienBoudry\Enigma\Reflector\ReflectorSwissK extends JulienBoudry\Enigma\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\Enigma\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```

## Full Representation
```php
final class JulienBoudry\Enigma\Reflector\ReflectorSwissK extends JulienBoudry\Enigma\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\Enigma\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```