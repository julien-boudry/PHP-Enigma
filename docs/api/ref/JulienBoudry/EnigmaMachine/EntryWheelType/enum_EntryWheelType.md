> JulienBoudry \ **EntryWheelType**
# Enum EntryWheelType
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheelType.php#L15)

## Description
The entry wheel is the first component the signal passes through when entering
the rotor assembly. Different Enigma models use different entry wheel types.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| ALPHABETICAL | `public const ALPHABETICAL = \JulienBoudry\EnigmaMachine\EntryWheelType::ALPHABETICAL` | __ |
| QWERTZ | `public const QWERTZ = \JulienBoudry\EnigmaMachine\EntryWheelType::QWERTZ` | __ |
| TIRPITZ | `public const TIRPITZ = \JulienBoudry\EnigmaMachine\EntryWheelType::TIRPITZ` | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |
| [value(...)](property_value.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [createEntryWheel(...)](method_createEntryWheel.md) | __ |


## Public Representation
```php
enum JulienBoudry\EnigmaMachine\EntryWheelType: string implements UnitEnum, BackedEnum
{
    case ALPHABETICAL = "ALPHABETICAL";
    case QWERTZ = "QWERTZ";
    case TIRPITZ = "TIRPITZ";
    // Constants
    public const ALPHABETICAL = \JulienBoudry\EnigmaMachine\EntryWheelType::ALPHABETICAL;
    public const QWERTZ = \JulienBoudry\EnigmaMachine\EntryWheelType::QWERTZ;
    public const TIRPITZ = \JulienBoudry\EnigmaMachine\EntryWheelType::TIRPITZ;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) string $value;

    // Methods
    public function createEntryWheel( ): JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel;

}
```

## Full Representation
```php
enum JulienBoudry\EnigmaMachine\EntryWheelType: string implements UnitEnum, BackedEnum
{
    case ALPHABETICAL = "ALPHABETICAL";
    case QWERTZ = "QWERTZ";
    case TIRPITZ = "TIRPITZ";
    // Constants
    public const ALPHABETICAL = \JulienBoudry\EnigmaMachine\EntryWheelType::ALPHABETICAL;
    public const QWERTZ = \JulienBoudry\EnigmaMachine\EntryWheelType::QWERTZ;
    public const TIRPITZ = \JulienBoudry\EnigmaMachine\EntryWheelType::TIRPITZ;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) string $value;

    // Methods
    public function createEntryWheel( ): JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel;

}
```