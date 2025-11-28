> JulienBoudry \ [Enigma](../../readme.md) \ **ReflectorTirpitz**
# Class ReflectorTirpitz
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorTirpitz.php#L17)

## Description
The Enigma T was used for German-Japanese military communications during WW2.
It has a unique reflector wiring and uses the Tirpitz entry wheel.
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
final class JulienBoudry\Enigma\Reflector\ReflectorTirpitz extends JulienBoudry\Enigma\Reflector\AbstractReflector
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
final class JulienBoudry\Enigma\Reflector\ReflectorTirpitz extends JulienBoudry\Enigma\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\Enigma\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```