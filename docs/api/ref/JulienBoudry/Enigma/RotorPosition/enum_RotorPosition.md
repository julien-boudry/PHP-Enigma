> JulienBoudry \ **RotorPosition**
# Enum RotorPosition
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorPosition.php#L15)

## Description
Defines the slots where rotors can be mounted. Most Enigma models have 3 positions (P1, P2, P3),
while the Kriegsmarine M4 has an additional fourth "Greek" position that never rotates.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| GREEK | `public const GREEK = \JulienBoudry\Enigma\RotorPosition::GREEK` | __ |
| P1 | `public const P1 = \JulienBoudry\Enigma\RotorPosition::P1` | __ |
| P2 | `public const P2 = \JulienBoudry\Enigma\RotorPosition::P2` | __ |
| P3 | `public const P3 = \JulienBoudry\Enigma\RotorPosition::P3` | __ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [getPositionIntValue(...)](method_getPositionIntValue.md) | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |
| [value(...)](property_value.md) | __ |


## Public Representation
```php
enum JulienBoudry\Enigma\RotorPosition: int implements UnitEnum, BackedEnum
{
    case P1 = 0;
    case P2 = 1;
    case P3 = 2;
    case GREEK = 3;
    // Constants
    public const GREEK = \JulienBoudry\Enigma\RotorPosition::GREEK;
    public const P1 = \JulienBoudry\Enigma\RotorPosition::P1;
    public const P2 = \JulienBoudry\Enigma\RotorPosition::P2;
    public const P3 = \JulienBoudry\Enigma\RotorPosition::P3;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) int $value;

    // Static Methods
    public static function getPositionIntValue( JulienBoudry\Enigma\RotorPosition $position ): int;

}
```

## Full Representation
```php
enum JulienBoudry\Enigma\RotorPosition: int implements UnitEnum, BackedEnum
{
    case P1 = 0;
    case P2 = 1;
    case P3 = 2;
    case GREEK = 3;
    // Constants
    public const GREEK = \JulienBoudry\Enigma\RotorPosition::GREEK;
    public const P1 = \JulienBoudry\Enigma\RotorPosition::P1;
    public const P2 = \JulienBoudry\Enigma\RotorPosition::P2;
    public const P3 = \JulienBoudry\Enigma\RotorPosition::P3;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) int $value;

    // Static Methods
    public static function getPositionIntValue( JulienBoudry\Enigma\RotorPosition $position ): int;

}
```