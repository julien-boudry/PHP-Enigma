> JulienBoudry \ **EnigmaModel**
# Enum EnigmaModel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaModel.php#L13)

## Description
Defines the different historical Enigma machine variants that can be emulated.
Each model has its own specific set of available rotors and reflectors.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| ENIGMA_K | `public const ENIGMA_K = \JulienBoudry\Enigma\EnigmaModel::ENIGMA_K` | _The commercial Enigma K was sold to various customers from 1927-1944. Features QWERTZ entry wheel and settable reflector._ |
| KMM3 | `public const KMM3 = \JulienBoudry\Enigma\EnigmaModel::KMM3` | __ |
| KMM4 | `public const KMM4 = \JulienBoudry\Enigma\EnigmaModel::KMM4` | __ |
| RAILWAY | `public const RAILWAY = \JulienBoudry\Enigma\EnigmaModel::RAILWAY` | _Special variant of Enigma K used by the German Reichsbahn (Railway). Features rewired rotors and reflector._ |
| SWISS_K | `public const SWISS_K = \JulienBoudry\Enigma\EnigmaModel::SWISS_K` | _Modified version of Enigma K used by the Swiss Army, Air Force, and Foreign Ministry. Rotors were rewired by the Swiss for additional security._ |
| TIRPITZ | `public const TIRPITZ = \JulienBoudry\Enigma\EnigmaModel::TIRPITZ` | _Used for communications between Germany and Japan during WW2. Features a unique entry wheel, 8 rotors with 5 notches each, and unique reflector._ |
| WMLW | `public const WMLW = \JulienBoudry\Enigma\EnigmaModel::WMLW` | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [getCompatibleReflectors(...)](method_getCompatibleReflectors.md) | __ |
| [getEntryWheelType(...)](method_getEntryWheelType.md) | _Commercial models use QWERTZ keyboard order for the entry wheel. Enigma T uses its own unique entry wheel order. Military models use alphabetical (ABCDEF...) order._ |
| [getExpectedRotorCount(...)](method_getExpectedRotorCount.md) | __ |
| [hasPlugboard(...)](method_hasPlugboard.md) | _Military Enigma models (Wehrmacht, Kriegsmarine) have plugboards. Commercial models (Enigma K, Swiss-K, Railway) and Enigma T do not._ |
| [isReflectorCompatible(...)](method_isReflectorCompatible.md) | __ |
| [requiresGreekRotor(...)](method_requiresGreekRotor.md) | __ |


## Public Representation
```php
enum JulienBoudry\Enigma\EnigmaModel implements UnitEnum
{
    case WMLW;
    case KMM3;
    case KMM4;
    case ENIGMA_K;
    case SWISS_K;
    case RAILWAY;
    case TIRPITZ;
    // Constants
    public const ENIGMA_K = \JulienBoudry\Enigma\EnigmaModel::ENIGMA_K;
    public const KMM3 = \JulienBoudry\Enigma\EnigmaModel::KMM3;
    public const KMM4 = \JulienBoudry\Enigma\EnigmaModel::KMM4;
    public const RAILWAY = \JulienBoudry\Enigma\EnigmaModel::RAILWAY;
    public const SWISS_K = \JulienBoudry\Enigma\EnigmaModel::SWISS_K;
    public const TIRPITZ = \JulienBoudry\Enigma\EnigmaModel::TIRPITZ;
    public const WMLW = \JulienBoudry\Enigma\EnigmaModel::WMLW;

    // Properties
    public protected(set) readonly protected(set) string $name;

    // Methods
    public function getCompatibleReflectors( ): array;
    public function getEntryWheelType( ): JulienBoudry\Enigma\EntryWheelType;
    public function getExpectedRotorCount( ): int;
    public function hasPlugboard( ): bool;
    public function isReflectorCompatible( JulienBoudry\Enigma\ReflectorType $reflector ): bool;
    public function requiresGreekRotor( ): bool;

}
```

## Full Representation
```php
enum JulienBoudry\Enigma\EnigmaModel implements UnitEnum
{
    case WMLW;
    case KMM3;
    case KMM4;
    case ENIGMA_K;
    case SWISS_K;
    case RAILWAY;
    case TIRPITZ;
    // Constants
    public const ENIGMA_K = \JulienBoudry\Enigma\EnigmaModel::ENIGMA_K;
    public const KMM3 = \JulienBoudry\Enigma\EnigmaModel::KMM3;
    public const KMM4 = \JulienBoudry\Enigma\EnigmaModel::KMM4;
    public const RAILWAY = \JulienBoudry\Enigma\EnigmaModel::RAILWAY;
    public const SWISS_K = \JulienBoudry\Enigma\EnigmaModel::SWISS_K;
    public const TIRPITZ = \JulienBoudry\Enigma\EnigmaModel::TIRPITZ;
    public const WMLW = \JulienBoudry\Enigma\EnigmaModel::WMLW;

    // Properties
    public protected(set) readonly protected(set) string $name;

    // Methods
    public function getCompatibleReflectors( ): array;
    public function getEntryWheelType( ): JulienBoudry\Enigma\EntryWheelType;
    public function getExpectedRotorCount( ): int;
    public function hasPlugboard( ): bool;
    public function isReflectorCompatible( JulienBoudry\Enigma\ReflectorType $reflector ): bool;
    public function requiresGreekRotor( ): bool;

}
```