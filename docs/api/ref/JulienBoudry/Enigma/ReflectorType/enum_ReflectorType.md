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

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |


## Public Representation
```php
enum JulienBoudry\Enigma\ReflectorType implements UnitEnum
{
    case B;
    case C;
    case BTHIN;
    case CTHIN;
    // Constants
    public const B = \JulienBoudry\Enigma\ReflectorType::B;
    public const BTHIN = \JulienBoudry\Enigma\ReflectorType::BTHIN;
    public const C = \JulienBoudry\Enigma\ReflectorType::C;
    public const CTHIN = \JulienBoudry\Enigma\ReflectorType::CTHIN;

    // Properties
    public protected(set) readonly protected(set) string $name;

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
    // Constants
    public const B = \JulienBoudry\Enigma\ReflectorType::B;
    public const BTHIN = \JulienBoudry\Enigma\ReflectorType::BTHIN;
    public const C = \JulienBoudry\Enigma\ReflectorType::C;
    public const CTHIN = \JulienBoudry\Enigma\ReflectorType::CTHIN;

    // Properties
    public protected(set) readonly protected(set) string $name;

}
```