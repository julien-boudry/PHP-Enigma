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
| B | `public const B = \JulienBoudry\Enigma\ReflectorType::B` | __ |
| BTHIN | `public const BTHIN = \JulienBoudry\Enigma\ReflectorType::BTHIN` | __ |
| C | `public const C = \JulienBoudry\Enigma\ReflectorType::C` | __ |
| CTHIN | `public const CTHIN = \JulienBoudry\Enigma\ReflectorType::CTHIN` | __ |
| DORA | `public const DORA = \JulienBoudry\Enigma\ReflectorType::DORA` | _Only available in Wehrmacht/Luftwaffe model. Use createDoraReflector() to create with custom wiring._ |

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
enum JulienBoudry\Enigma\ReflectorType implements UnitEnum
{
    case B;
    case C;
    case BTHIN;
    case CTHIN;
    case DORA;
    // Constants
    public const B = \JulienBoudry\Enigma\ReflectorType::B;
    public const BTHIN = \JulienBoudry\Enigma\ReflectorType::BTHIN;
    public const C = \JulienBoudry\Enigma\ReflectorType::C;
    public const CTHIN = \JulienBoudry\Enigma\ReflectorType::CTHIN;
    public const DORA = \JulienBoudry\Enigma\ReflectorType::DORA;

    // Properties
    public protected(set) readonly protected(set) string $name;

    // Static Methods
    public static function createDoraReflector( array $pairs ): JulienBoudry\Enigma\Reflector\ReflectorDora;
    public static function createDoraReflectorFromString( string $pairsString ): JulienBoudry\Enigma\Reflector\ReflectorDora;

    // Methods
    public function createReflector( ): JulienBoudry\Enigma\Reflector\AbstractReflector;

}
```

## Full Representation
```php
enum JulienBoudry\Enigma\ReflectorType implements UnitEnum
{
    case B;
    case C;
    case BTHIN;
    case CTHIN;
    case DORA;
    // Constants
    public const B = \JulienBoudry\Enigma\ReflectorType::B;
    public const BTHIN = \JulienBoudry\Enigma\ReflectorType::BTHIN;
    public const C = \JulienBoudry\Enigma\ReflectorType::C;
    public const CTHIN = \JulienBoudry\Enigma\ReflectorType::CTHIN;
    public const DORA = \JulienBoudry\Enigma\ReflectorType::DORA;

    // Properties
    public protected(set) readonly protected(set) string $name;

    // Static Methods
    public static function createDoraReflector( array $pairs ): JulienBoudry\Enigma\Reflector\ReflectorDora;
    public static function createDoraReflectorFromString( string $pairsString ): JulienBoudry\Enigma\Reflector\ReflectorDora;

    // Methods
    public function createReflector( ): JulienBoudry\Enigma\Reflector\AbstractReflector;

}
```