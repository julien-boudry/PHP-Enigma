> Rafalmasiarek \ **RotorPosition**
# Enum RotorPosition
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorPosition.php#L7)
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| GREEK | `public const GREEK = \Rafalmasiarek\Enigma\RotorPosition::GREEK` | __ |
| P1 | `public const P1 = \Rafalmasiarek\Enigma\RotorPosition::P1` | __ |
| P2 | `public const P2 = \Rafalmasiarek\Enigma\RotorPosition::P2` | __ |
| P3 | `public const P3 = \Rafalmasiarek\Enigma\RotorPosition::P3` | __ |

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
enum Rafalmasiarek\Enigma\RotorPosition: int implements UnitEnum, BackedEnum
{
    case P1 = 0;
    case P2 = 1;
    case P3 = 2;
    case GREEK = 3;
    // Constants
    public const GREEK = \Rafalmasiarek\Enigma\RotorPosition::GREEK;
    public const P1 = \Rafalmasiarek\Enigma\RotorPosition::P1;
    public const P2 = \Rafalmasiarek\Enigma\RotorPosition::P2;
    public const P3 = \Rafalmasiarek\Enigma\RotorPosition::P3;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) int $value;

    // Static Methods
    public static function getPositionIntValue( Rafalmasiarek\Enigma\RotorPosition|int $position ): int;

}
```

## Full Representation
```php
enum Rafalmasiarek\Enigma\RotorPosition: int implements UnitEnum, BackedEnum
{
    case P1 = 0;
    case P2 = 1;
    case P3 = 2;
    case GREEK = 3;
    // Constants
    public const GREEK = \Rafalmasiarek\Enigma\RotorPosition::GREEK;
    public const P1 = \Rafalmasiarek\Enigma\RotorPosition::P1;
    public const P2 = \Rafalmasiarek\Enigma\RotorPosition::P2;
    public const P3 = \Rafalmasiarek\Enigma\RotorPosition::P3;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) int $value;

    // Static Methods
    public static function getPositionIntValue( Rafalmasiarek\Enigma\RotorPosition|int $position ): int;

}
```