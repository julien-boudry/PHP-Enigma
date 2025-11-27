> JulienBoudry \ **EnigmaConfiguration**
# Class EnigmaConfiguration
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaConfiguration.php#L16)

## Description
This immutable value object holds all the configuration parameters
needed to set up an Enigma machine. It can be created from scratch,
generated randomly, or extracted from an existing Enigma machine.
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [fromEnigma(...)](method_fromEnigma.md) | _Extracts the current state of the Enigma machine including rotor types, ring settings, positions, reflector, and plugboard._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [doraWiringPairs(...)](property_doraWiringPairs.md) | __ |
| [model(...)](property_model.md) | __ |
| [plugboardPairs(...)](property_plugboardPairs.md) | __ |
| [positions(...)](property_positions.md) | __ |
| [reflector(...)](property_reflector.md) | __ |
| [ringstellungen(...)](property_ringstellungen.md) | __ |
| [rotorTypes(...)](property_rotorTypes.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |
| [createEnigma(...)](method_createEnigma.md) | __ |
| [createRotorConfiguration(...)](method_createRotorConfiguration.md) | __ |
| [getSummary(...)](method_getSummary.md) | __ |


## Public Representation
```php
final readonly class JulienBoudry\Enigma\EnigmaConfiguration
{

    // Properties
    public protected(set) readonly protected(set) ?array $doraWiringPairs;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\EnigmaModel $model;
    public protected(set) readonly protected(set) array $plugboardPairs;
    public protected(set) readonly protected(set) array $positions;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\ReflectorType $reflector;
    public protected(set) readonly protected(set) array $ringstellungen;
    public protected(set) readonly protected(set) array $rotorTypes;

    // Static Methods
    public static function fromEnigma( JulienBoudry\Enigma\Enigma $enigma ): JulienBoudry\Enigma\EnigmaConfiguration;

    // Methods
    public function __construct( JulienBoudry\Enigma\EnigmaModel $model, array $rotorTypes, array $ringstellungen, array $positions, JulienBoudry\Enigma\ReflectorType $reflector, array $plugboardPairs, [ ?array $doraWiringPairs = null ] );
    public function createEnigma( ): JulienBoudry\Enigma\Enigma;
    public function createRotorConfiguration( ): JulienBoudry\Enigma\RotorConfiguration;
    public function getSummary( ): string;

}
```

## Full Representation
```php
final readonly class JulienBoudry\Enigma\EnigmaConfiguration
{

    // Properties
    public protected(set) readonly protected(set) ?array $doraWiringPairs;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\EnigmaModel $model;
    public protected(set) readonly protected(set) array $plugboardPairs;
    public protected(set) readonly protected(set) array $positions;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\ReflectorType $reflector;
    public protected(set) readonly protected(set) array $ringstellungen;
    public protected(set) readonly protected(set) array $rotorTypes;

    // Static Methods
    public static function fromEnigma( JulienBoudry\Enigma\Enigma $enigma ): JulienBoudry\Enigma\EnigmaConfiguration;

    // Methods
    public function __construct( JulienBoudry\Enigma\EnigmaModel $model, array $rotorTypes, array $ringstellungen, array $positions, JulienBoudry\Enigma\ReflectorType $reflector, array $plugboardPairs, [ ?array $doraWiringPairs = null ] );
    public function createEnigma( ): JulienBoudry\Enigma\Enigma;
    public function createRotorConfiguration( ): JulienBoudry\Enigma\RotorConfiguration;
    public function getSummary( ): string;

}
```