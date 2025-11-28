> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **ReflectorB**
# Class ReflectorB
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorB.php#L14)

## Description
Standard reflector used with Wehrmacht/Luftwaffe and Kriegsmarine M3 models.
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
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorB extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
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
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorB extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```