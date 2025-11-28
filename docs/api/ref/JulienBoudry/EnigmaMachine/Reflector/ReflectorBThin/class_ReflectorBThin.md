> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **ReflectorBThin**
# Class ReflectorBThin
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorBThin.php#L15)

## Description
Thin reflector used exclusively with the Kriegsmarine M4 model.
The thin design allows space for the fourth rotor.
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
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorBThin extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
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
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorBThin extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```