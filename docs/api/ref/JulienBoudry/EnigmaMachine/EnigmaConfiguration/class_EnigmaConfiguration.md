> JulienBoudry \ **EnigmaConfiguration**
# Class EnigmaConfiguration
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaConfiguration.php#L16)

## Description
Represents an Enigma machine configuration.

This immutable value object holds all the configuration parameters
needed to set up an Enigma machine. It can be created from scratch,
generated randomly, or extracted from an existing Enigma machine.
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [fromEnigma(...)](method_fromEnigma.md) | _Create a configuration from an existing Enigma machine._ |

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
| [createEnigma(...)](method_createEnigma.md) | _Create and configure a complete Enigma machine from this configuration._ |
| [createRotorConfiguration(...)](method_createRotorConfiguration.md) | _Create a RotorConfiguration from this configuration._ |
| [getSummary(...)](method_getSummary.md) | _Get a human-readable summary of the configuration._ |


## Public Representation
```php
final readonly class JulienBoudry\EnigmaMachine\EnigmaConfiguration
{

    // Properties
    public protected(set) readonly ?array $doraWiringPairs;
    public protected(set) readonly JulienBoudry\EnigmaMachine\EnigmaModel $model;
    public protected(set) readonly array $plugboardPairs;
    public protected(set) readonly array $positions;
    public protected(set) readonly JulienBoudry\EnigmaMachine\ReflectorType $reflector;
    public protected(set) readonly array $ringstellungen;
    public protected(set) readonly array $rotorTypes;

    // Static Methods
    public static function fromEnigma( JulienBoudry\EnigmaMachine\Enigma $enigma ): self;

    // Methods
    public function __construct( JulienBoudry\EnigmaMachine\EnigmaModel $model, array $rotorTypes, array $ringstellungen, array $positions, JulienBoudry\EnigmaMachine\ReflectorType $reflector, array $plugboardPairs, [ ?array $doraWiringPairs = null ] );
    public function createEnigma( ): JulienBoudry\EnigmaMachine\Enigma;
    public function createRotorConfiguration( ): JulienBoudry\EnigmaMachine\RotorConfiguration;
    public function getSummary( ): string;

}
```

## Full Representation
```php
final readonly class JulienBoudry\EnigmaMachine\EnigmaConfiguration
{

    // Properties
    public protected(set) readonly ?array $doraWiringPairs;
    public protected(set) readonly JulienBoudry\EnigmaMachine\EnigmaModel $model;
    public protected(set) readonly array $plugboardPairs;
    public protected(set) readonly array $positions;
    public protected(set) readonly JulienBoudry\EnigmaMachine\ReflectorType $reflector;
    public protected(set) readonly array $ringstellungen;
    public protected(set) readonly array $rotorTypes;

    // Static Methods
    public static function fromEnigma( JulienBoudry\EnigmaMachine\Enigma $enigma ): self;

    // Methods
    public function __construct( JulienBoudry\EnigmaMachine\EnigmaModel $model, array $rotorTypes, array $ringstellungen, array $positions, JulienBoudry\EnigmaMachine\ReflectorType $reflector, array $plugboardPairs, [ ?array $doraWiringPairs = null ] );
    public function createEnigma( ): JulienBoudry\EnigmaMachine\Enigma;
    public function createRotorConfiguration( ): JulienBoudry\EnigmaMachine\RotorConfiguration;
    public function getSummary( ): string;

}
```