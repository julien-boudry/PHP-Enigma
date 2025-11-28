> JulienBoudry \ [Enigma](../../readme.md) \ **ReflectorRailway**
# Class ReflectorRailway
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorRailway.php#L17)

## Description
Rewired reflector used by the German Reichsbahn (Railway).
Wiring recovered in 2023 from physical measurement of UKW K456.
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
final class JulienBoudry\Enigma\Reflector\ReflectorRailway extends JulienBoudry\Enigma\Reflector\AbstractReflector
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
final class JulienBoudry\Enigma\Reflector\ReflectorRailway extends JulienBoudry\Enigma\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\Enigma\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```