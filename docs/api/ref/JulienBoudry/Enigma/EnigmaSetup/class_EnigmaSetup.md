> JulienBoudry \ **EnigmaSetup**
# Class EnigmaSetup
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaSetup.php#L14)

## Description
This class stores the wiring configuration, compatible Enigma models,
and notch positions for a specific rotor or reflector type.
It is used to initialize the available components of an Enigma machine.
## Elements

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [notches(...)](property_notches.md) | __ |
| [reflectorType(...)](property_reflectorType.md) | __ |
| [used(...)](property_used.md) | __ |
| [wiring(...)](property_wiring.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |


## Public Representation
```php
readonly class JulienBoudry\Enigma\EnigmaSetup
{

    // Properties
    public protected(set) readonly protected(set) ?array $notches;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\ReflectorType|JulienBoudry\Enigma\RotorType $reflectorType;
    public protected(set) readonly protected(set) array $used;
    public protected(set) readonly protected(set) string $wiring;

    // Methods
    public function __construct( JulienBoudry\Enigma\ReflectorType|JulienBoudry\Enigma\RotorType $reflectorType, string $wiring, array $used, [ ?array $notches = null ] );

}
```

## Full Representation
```php
readonly class JulienBoudry\Enigma\EnigmaSetup
{

    // Properties
    public protected(set) readonly protected(set) ?array $notches;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\ReflectorType|JulienBoudry\Enigma\RotorType $reflectorType;
    public protected(set) readonly protected(set) array $used;
    public protected(set) readonly protected(set) string $wiring;

    // Methods
    public function __construct( JulienBoudry\Enigma\ReflectorType|JulienBoudry\Enigma\RotorType $reflectorType, string $wiring, array $used, [ ?array $notches = null ] );

}
```