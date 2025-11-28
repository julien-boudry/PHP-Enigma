> JulienBoudry \ **ReflectorType**
# Enum ReflectorType
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/ReflectorType.php#L15)

## Description
Defines the different reflector variants (Umkehrwalze) available for Enigma machines.
Different Enigma models support different reflector types.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| B | `public const B = \JulienBoudry\EnigmaMachine\ReflectorType::B` | __ |
| BTHIN | `public const BTHIN = \JulienBoudry\EnigmaMachine\ReflectorType::BTHIN` | __ |
| C | `public const C = \JulienBoudry\EnigmaMachine\ReflectorType::C` | __ |
| CTHIN | `public const CTHIN = \JulienBoudry\EnigmaMachine\ReflectorType::CTHIN` | __ |
| DORA | `public const DORA = \JulienBoudry\EnigmaMachine\ReflectorType::DORA` | _Only available in Wehrmacht/Luftwaffe model. Use createDoraReflector() to create with custom wiring._ |
| K | `public const K = \JulienBoudry\EnigmaMachine\ReflectorType::K` | _Standard commercial wiring (handelsübliche Schaltung). Used by various customers from 1927-1944._ |
| RAILWAY | `public const RAILWAY = \JulienBoudry\EnigmaMachine\ReflectorType::RAILWAY` | _Rewired reflector used by German Reichsbahn._ |
| SWISS_K | `public const SWISS_K = \JulienBoudry\EnigmaMachine\ReflectorType::SWISS_K` | _Same wiring as commercial K - the Swiss only rewired the rotors._ |
| TIRPITZ | `public const TIRPITZ = \JulienBoudry\EnigmaMachine\ReflectorType::TIRPITZ` | _Used for German-Japanese military communications._ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [createDoraReflector(...)](method_createDoraReflector.md) | __ |
| [createDoraReflectorFromString(...)](method_createDoraReflectorFromString.md) | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [createReflector(...)](method_createReflector.md) | _For DORA reflector, this creates an instance with default wiring. Use createDoraReflector() for custom wiring configurations._ |


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
    public protected(set) readonly protected(set) string $name;

    // Static Methods
    public static function createDoraReflector( array $pairs ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;
    public static function createDoraReflectorFromString( string $pairsString ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;

    // Methods
    public function createReflector( ): JulienBoudry\EnigmaMachine\Reflector\AbstractReflector;

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
    public protected(set) readonly protected(set) string $name;

    // Static Methods
    public static function createDoraReflector( array $pairs ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;
    public static function createDoraReflectorFromString( string $pairsString ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;

    // Methods
    public function createReflector( ): JulienBoudry\EnigmaMachine\Reflector\AbstractReflector;

}
```