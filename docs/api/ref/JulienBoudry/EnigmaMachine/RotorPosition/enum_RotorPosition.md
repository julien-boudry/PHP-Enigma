> JulienBoudry \ **RotorPosition**
# Enum RotorPosition
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorPosition.php#L21)

## Description
Enumeration of rotor positions in the Enigma machine.

Defines the slots where rotors can be mounted. Most Enigma models have 3 positions (P1, P2, P3),
while the Kriegsmarine M4 has an additional fourth "Greek" position that never rotates.

Signal flow: Keyboard → Plugboard → P1 → P2 → P3 [→ GREEK] → Reflector → [GREEK →] P3 → P2 → P1 → Plugboard → Lampboard

Rotation behavior:
- P1 (rightmost): Rotates on every keypress
- P2 (middle): Rotates when P1 reaches its notch, or when P3 rotates (double-stepping)
- P3 (leftmost): Rotates when P2 reaches its notch
- GREEK: Never rotates (M4 only)
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| GREEK | `public const GREEK = \JulienBoudry\EnigmaMachine\RotorPosition::GREEK` | _Greek position - Leftmost rotor in Kriegsmarine M4 model only._ |
| P1 | `public const P1 = \JulienBoudry\EnigmaMachine\RotorPosition::P1` | _Position 1 - Rightmost rotor, fastest rotating._ |
| P2 | `public const P2 = \JulienBoudry\EnigmaMachine\RotorPosition::P2` | _Position 2 - Middle rotor._ |
| P3 | `public const P3 = \JulienBoudry\EnigmaMachine\RotorPosition::P3` | _Position 3 - Leftmost rotor in 3-rotor models, slowest rotating._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |
| [value(...)](property_value.md) | __ |


## Public Representation
```php
enum JulienBoudry\EnigmaMachine\RotorPosition: int implements UnitEnum, BackedEnum
{
    case P1 = 0;
    case P2 = 1;
    case P3 = 2;
    case GREEK = 3;
    // Constants
    public const GREEK = \JulienBoudry\EnigmaMachine\RotorPosition::GREEK;
    public const P1 = \JulienBoudry\EnigmaMachine\RotorPosition::P1;
    public const P2 = \JulienBoudry\EnigmaMachine\RotorPosition::P2;
    public const P3 = \JulienBoudry\EnigmaMachine\RotorPosition::P3;

    // Properties
    public readonly protected(set) string $name;
    public readonly protected(set) int $value;

}
```

## Full Representation
```php
enum JulienBoudry\EnigmaMachine\RotorPosition: int implements UnitEnum, BackedEnum
{
    case P1 = 0;
    case P2 = 1;
    case P3 = 2;
    case GREEK = 3;
    // Constants
    public const GREEK = \JulienBoudry\EnigmaMachine\RotorPosition::GREEK;
    public const P1 = \JulienBoudry\EnigmaMachine\RotorPosition::P1;
    public const P2 = \JulienBoudry\EnigmaMachine\RotorPosition::P2;
    public const P3 = \JulienBoudry\EnigmaMachine\RotorPosition::P3;

    // Properties
    public readonly protected(set) string $name;
    public readonly protected(set) int $value;

}
```