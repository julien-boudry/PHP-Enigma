> JulienBoudry \ **ReflectorType**
# Enum ReflectorType
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/ReflectorType.php#L15)

## Description
Enumeration of available reflector types.

Defines the different reflector variants (Umkehrwalze) available for Enigma machines.
Different Enigma models support different reflector types.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| B | `public const B = \JulienBoudry\EnigmaMachine\ReflectorType::B` | __ |
| BTHIN | `public const BTHIN = \JulienBoudry\EnigmaMachine\ReflectorType::BTHIN` | _ID Reflector B Thin only available in model Kriegsmarine M4._ |
| C | `public const C = \JulienBoudry\EnigmaMachine\ReflectorType::C` | __ |
| CTHIN | `public const CTHIN = \JulienBoudry\EnigmaMachine\ReflectorType::CTHIN` | _ID Reflector C Thin only available in model Kriegsmarine M4._ |
| DORA | `public const DORA = \JulienBoudry\EnigmaMachine\ReflectorType::DORA` | _UKW-D (Umkehrwalze Dora) - Rewirable reflector._ |
| K | `public const K = \JulienBoudry\EnigmaMachine\ReflectorType::K` | _Commercial Enigma K (A27) reflector._ |
| RAILWAY | `public const RAILWAY = \JulienBoudry\EnigmaMachine\ReflectorType::RAILWAY` | _Railway Enigma (Rocket) reflector._ |
| SWISS_K | `public const SWISS_K = \JulienBoudry\EnigmaMachine\ReflectorType::SWISS_K` | _Swiss Enigma K reflector._ |
| TIRPITZ | `public const TIRPITZ = \JulienBoudry\EnigmaMachine\ReflectorType::TIRPITZ` | _Enigma T (Tirpitz) reflector._ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [createDoraReflector(...)](method_createDoraReflector.md) | _Create a UKW-D (Dora) reflector with custom wiring._ |
| [createDoraReflectorFromString(...)](method_createDoraReflectorFromString.md) | _Create a UKW-D (Dora) reflector from a pairs string._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [createReflector(...)](method_createReflector.md) | _Create a reflector instance for this type._ |
| [getDescription(...)](method_getDescription.md) | _Get a human-readable description of this reflector type._ |


## Public Representation
```php
enum JulienBoudry\EnigmaMachine\ReflectorType implements UnitEnum
{
    case B;
    case C;
    case BTHIN;
    case CTHIN;
    case DORA;
    case K;
    case SWISS_K;
    case RAILWAY;
    case TIRPITZ;
    // Constants
    public const B = \JulienBoudry\EnigmaMachine\ReflectorType::B;
    public const BTHIN = \JulienBoudry\EnigmaMachine\ReflectorType::BTHIN;
    public const C = \JulienBoudry\EnigmaMachine\ReflectorType::C;
    public const CTHIN = \JulienBoudry\EnigmaMachine\ReflectorType::CTHIN;
    public const DORA = \JulienBoudry\EnigmaMachine\ReflectorType::DORA;
    public const K = \JulienBoudry\EnigmaMachine\ReflectorType::K;
    public const RAILWAY = \JulienBoudry\EnigmaMachine\ReflectorType::RAILWAY;
    public const SWISS_K = \JulienBoudry\EnigmaMachine\ReflectorType::SWISS_K;
    public const TIRPITZ = \JulienBoudry\EnigmaMachine\ReflectorType::TIRPITZ;

    // Properties
    public protected(set) readonly string $name;

    // Static Methods
    public static function createDoraReflector( array $pairs ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;
    public static function createDoraReflectorFromString( string $pairsString ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;

    // Methods
    public function createReflector( ): JulienBoudry\EnigmaMachine\Reflector\AbstractReflector;
    public function getDescription( ): string;

}
```

## Full Representation
```php
enum JulienBoudry\EnigmaMachine\ReflectorType implements UnitEnum
{
    case B;
    case C;
    case BTHIN;
    case CTHIN;
    case DORA;
    case K;
    case SWISS_K;
    case RAILWAY;
    case TIRPITZ;
    // Constants
    public const B = \JulienBoudry\EnigmaMachine\ReflectorType::B;
    public const BTHIN = \JulienBoudry\EnigmaMachine\ReflectorType::BTHIN;
    public const C = \JulienBoudry\EnigmaMachine\ReflectorType::C;
    public const CTHIN = \JulienBoudry\EnigmaMachine\ReflectorType::CTHIN;
    public const DORA = \JulienBoudry\EnigmaMachine\ReflectorType::DORA;
    public const K = \JulienBoudry\EnigmaMachine\ReflectorType::K;
    public const RAILWAY = \JulienBoudry\EnigmaMachine\ReflectorType::RAILWAY;
    public const SWISS_K = \JulienBoudry\EnigmaMachine\ReflectorType::SWISS_K;
    public const TIRPITZ = \JulienBoudry\EnigmaMachine\ReflectorType::TIRPITZ;

    // Properties
    public protected(set) readonly string $name;

    // Static Methods
    public static function createDoraReflector( array $pairs ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;
    public static function createDoraReflectorFromString( string $pairsString ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;

    // Methods
    public function createReflector( ): JulienBoudry\EnigmaMachine\Reflector\AbstractReflector;
    public function getDescription( ): string;

}
```