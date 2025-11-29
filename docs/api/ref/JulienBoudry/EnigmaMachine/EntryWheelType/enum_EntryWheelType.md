> JulienBoudry \ **EntryWheelType**
# Enum EntryWheelType
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheelType.php#L15)

## Description
Types of Entry Wheels (Eintrittswalze, ETW) used in Enigma machines.

The entry wheel is the first component the signal passes through when entering
the rotor assembly. Different Enigma models use different entry wheel types.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| ALPHABETICAL | `public const ALPHABETICAL = \JulienBoudry\EnigmaMachine\EntryWheelType::ALPHABETICAL` | _Alphabetical order (A→0, B→1, C→2...) - used in military models._ |
| QWERTZ | `public const QWERTZ = \JulienBoudry\EnigmaMachine\EntryWheelType::QWERTZ` | _QWERTZ keyboard order (Q→0, W→1, E→2...) - used in commercial models._ |
| TIRPITZ | `public const TIRPITZ = \JulienBoudry\EnigmaMachine\EntryWheelType::TIRPITZ` | _Tirpitz order (K→0, Z→1, R→2...) - used in Enigma T (Tirpitz)._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |
| [value(...)](property_value.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [createEntryWheel(...)](method_createEntryWheel.md) | _Create the entry wheel instance for this type._ |


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
    public protected(set) readonly string $name;
    public protected(set) readonly string $value;

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
    public protected(set) readonly string $name;
    public protected(set) readonly string $value;

    // Methods
    public function createEntryWheel( ): JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel;

}
```