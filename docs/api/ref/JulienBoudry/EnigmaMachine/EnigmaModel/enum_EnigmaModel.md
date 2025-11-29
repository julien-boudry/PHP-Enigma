> JulienBoudry \ **EnigmaModel**
# Enum EnigmaModel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaModel.php#L13)

## Description
Enumeration of Enigma machine models.

Defines the different historical Enigma machine variants that can be emulated.
Each model has its own specific set of available rotors and reflectors.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| ENIGMA_K | `public const ENIGMA_K = \JulienBoudry\EnigmaMachine\EnigmaModel::ENIGMA_K` | _Enigma K Commercial (A27) - 3-rotor model without plugboard._ |
| KMM3 | `public const KMM3 = \JulienBoudry\EnigmaMachine\EnigmaModel::KMM3` | _Kriegsmarine M3 (3-rotor model)._ |
| KMM4 | `public const KMM4 = \JulienBoudry\EnigmaMachine\EnigmaModel::KMM4` | _Kriegsmarine M4 (4-rotor model)._ |
| RAILWAY | `public const RAILWAY = \JulienBoudry\EnigmaMachine\EnigmaModel::RAILWAY` | _Railway Enigma (Rocket) - 3-rotor model without plugboard._ |
| SWISS_K | `public const SWISS_K = \JulienBoudry\EnigmaMachine\EnigmaModel::SWISS_K` | _Swiss Enigma K - 3-rotor model without plugboard._ |
| TIRPITZ | `public const TIRPITZ = \JulienBoudry\EnigmaMachine\EnigmaModel::TIRPITZ` | _Enigma T (Tirpitz) - 3-rotor model without plugboard._ |
| WMLW | `public const WMLW = \JulienBoudry\EnigmaMachine\EnigmaModel::WMLW` | _Wehrmacht/Luftwaffe (3-rotor model)._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [getCompatibleReflectors(...)](method_getCompatibleReflectors.md) | _Get the compatible reflector types for this model._ |
| [getEntryWheelType(...)](method_getEntryWheelType.md) | _Get the entry wheel type for this model._ |
| [getExpectedRotorCount(...)](method_getExpectedRotorCount.md) | _Get the expected number of rotors for this model._ |
| [hasPlugboard(...)](method_hasPlugboard.md) | _Check if this model has a plugboard._ |
| [isReflectorCompatible(...)](method_isReflectorCompatible.md) | _Check if a reflector type is compatible with this model._ |
| [requiresGreekRotor(...)](method_requiresGreekRotor.md) | _Check if this model requires a Greek rotor._ |


## Public Representation
```php
enum JulienBoudry\EnigmaMachine\EnigmaModel implements UnitEnum
{
    case WMLW;
    case KMM3;
    case KMM4;
    case ENIGMA_K;
    case SWISS_K;
    case RAILWAY;
    case TIRPITZ;
    // Constants
    public const ENIGMA_K = \JulienBoudry\EnigmaMachine\EnigmaModel::ENIGMA_K;
    public const KMM3 = \JulienBoudry\EnigmaMachine\EnigmaModel::KMM3;
    public const KMM4 = \JulienBoudry\EnigmaMachine\EnigmaModel::KMM4;
    public const RAILWAY = \JulienBoudry\EnigmaMachine\EnigmaModel::RAILWAY;
    public const SWISS_K = \JulienBoudry\EnigmaMachine\EnigmaModel::SWISS_K;
    public const TIRPITZ = \JulienBoudry\EnigmaMachine\EnigmaModel::TIRPITZ;
    public const WMLW = \JulienBoudry\EnigmaMachine\EnigmaModel::WMLW;

    // Properties
    public protected(set) readonly string $name;

    // Methods
    public function getCompatibleReflectors( ): array;
    public function getEntryWheelType( ): JulienBoudry\EnigmaMachine\EntryWheelType;
    public function getExpectedRotorCount( ): int;
    public function hasPlugboard( ): bool;
    public function isReflectorCompatible( JulienBoudry\EnigmaMachine\ReflectorType $reflector ): bool;
    public function requiresGreekRotor( ): bool;

}
```

## Full Representation
```php
enum JulienBoudry\EnigmaMachine\EnigmaModel implements UnitEnum
{
    case WMLW;
    case KMM3;
    case KMM4;
    case ENIGMA_K;
    case SWISS_K;
    case RAILWAY;
    case TIRPITZ;
    // Constants
    public const ENIGMA_K = \JulienBoudry\EnigmaMachine\EnigmaModel::ENIGMA_K;
    public const KMM3 = \JulienBoudry\EnigmaMachine\EnigmaModel::KMM3;
    public const KMM4 = \JulienBoudry\EnigmaMachine\EnigmaModel::KMM4;
    public const RAILWAY = \JulienBoudry\EnigmaMachine\EnigmaModel::RAILWAY;
    public const SWISS_K = \JulienBoudry\EnigmaMachine\EnigmaModel::SWISS_K;
    public const TIRPITZ = \JulienBoudry\EnigmaMachine\EnigmaModel::TIRPITZ;
    public const WMLW = \JulienBoudry\EnigmaMachine\EnigmaModel::WMLW;

    // Properties
    public protected(set) readonly string $name;

    // Methods
    public function getCompatibleReflectors( ): array;
    public function getEntryWheelType( ): JulienBoudry\EnigmaMachine\EntryWheelType;
    public function getExpectedRotorCount( ): int;
    public function hasPlugboard( ): bool;
    public function isReflectorCompatible( JulienBoudry\EnigmaMachine\ReflectorType $reflector ): bool;
    public function requiresGreekRotor( ): bool;

}
```