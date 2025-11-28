> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **ReflectorRailway**
# Class ReflectorRailway
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorRailway.php#L17)

## Description
Railway Enigma (Rocket) Reflector (Umkehrwalze).

Rewired reflector used by the German Reichsbahn (Railway).
Wiring recovered in 2023 from physical measurement of UKW K456.
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
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorRailway extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
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
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorRailway extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Methods
    public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->__construct( );
    public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```