> JulienBoudry \ **Letter**
# Enum Letter
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Letter.php#L15)

## Description
This backed enum provides type-safe letter handling for all Enigma operations.
The integer backing values (0-25) are used internally for efficient wiring calculations.

Note: PHP enums cannot implement Stringable. Use ->toChar() for string conversion.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| A | `public const A = \JulienBoudry\EnigmaMachine\Letter::A` | __ |
| B | `public const B = \JulienBoudry\EnigmaMachine\Letter::B` | __ |
| C | `public const C = \JulienBoudry\EnigmaMachine\Letter::C` | __ |
| D | `public const D = \JulienBoudry\EnigmaMachine\Letter::D` | __ |
| E | `public const E = \JulienBoudry\EnigmaMachine\Letter::E` | __ |
| F | `public const F = \JulienBoudry\EnigmaMachine\Letter::F` | __ |
| G | `public const G = \JulienBoudry\EnigmaMachine\Letter::G` | __ |
| H | `public const H = \JulienBoudry\EnigmaMachine\Letter::H` | __ |
| I | `public const I = \JulienBoudry\EnigmaMachine\Letter::I` | __ |
| J | `public const J = \JulienBoudry\EnigmaMachine\Letter::J` | __ |
| K | `public const K = \JulienBoudry\EnigmaMachine\Letter::K` | __ |
| L | `public const L = \JulienBoudry\EnigmaMachine\Letter::L` | __ |
| M | `public const M = \JulienBoudry\EnigmaMachine\Letter::M` | __ |
| N | `public const N = \JulienBoudry\EnigmaMachine\Letter::N` | __ |
| O | `public const O = \JulienBoudry\EnigmaMachine\Letter::O` | __ |
| P | `public const P = \JulienBoudry\EnigmaMachine\Letter::P` | __ |
| Q | `public const Q = \JulienBoudry\EnigmaMachine\Letter::Q` | __ |
| R | `public const R = \JulienBoudry\EnigmaMachine\Letter::R` | __ |
| S | `public const S = \JulienBoudry\EnigmaMachine\Letter::S` | __ |
| T | `public const T = \JulienBoudry\EnigmaMachine\Letter::T` | __ |
| U | `public const U = \JulienBoudry\EnigmaMachine\Letter::U` | __ |
| V | `public const V = \JulienBoudry\EnigmaMachine\Letter::V` | __ |
| W | `public const W = \JulienBoudry\EnigmaMachine\Letter::W` | __ |
| X | `public const X = \JulienBoudry\EnigmaMachine\Letter::X` | __ |
| Y | `public const Y = \JulienBoudry\EnigmaMachine\Letter::Y` | __ |
| Z | `public const Z = \JulienBoudry\EnigmaMachine\Letter::Z` | __ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [count(...)](method_count.md) | __ |
| [fromChar(...)](method_fromChar.md) | __ |
| [fromPosition(...)](method_fromPosition.md) | _This is useful for rotor calculations where positions wrap around._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |
| [value(...)](property_value.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [toChar(...)](method_toChar.md) | __ |


## Public Representation
```php
enum JulienBoudry\EnigmaMachine\Letter: int implements UnitEnum, BackedEnum
{
    case A = 0;
    case B = 1;
    case C = 2;
    case D = 3;
    case E = 4;
    case F = 5;
    case G = 6;
    case H = 7;
    case I = 8;
    case J = 9;
    case K = 10;
    case L = 11;
    case M = 12;
    case N = 13;
    case O = 14;
    case P = 15;
    case Q = 16;
    case R = 17;
    case S = 18;
    case T = 19;
    case U = 20;
    case V = 21;
    case W = 22;
    case X = 23;
    case Y = 24;
    case Z = 25;
    // Constants
    public const A = \JulienBoudry\EnigmaMachine\Letter::A;
    public const B = \JulienBoudry\EnigmaMachine\Letter::B;
    public const C = \JulienBoudry\EnigmaMachine\Letter::C;
    public const D = \JulienBoudry\EnigmaMachine\Letter::D;
    public const E = \JulienBoudry\EnigmaMachine\Letter::E;
    public const F = \JulienBoudry\EnigmaMachine\Letter::F;
    public const G = \JulienBoudry\EnigmaMachine\Letter::G;
    public const H = \JulienBoudry\EnigmaMachine\Letter::H;
    public const I = \JulienBoudry\EnigmaMachine\Letter::I;
    public const J = \JulienBoudry\EnigmaMachine\Letter::J;
    public const K = \JulienBoudry\EnigmaMachine\Letter::K;
    public const L = \JulienBoudry\EnigmaMachine\Letter::L;
    public const M = \JulienBoudry\EnigmaMachine\Letter::M;
    public const N = \JulienBoudry\EnigmaMachine\Letter::N;
    public const O = \JulienBoudry\EnigmaMachine\Letter::O;
    public const P = \JulienBoudry\EnigmaMachine\Letter::P;
    public const Q = \JulienBoudry\EnigmaMachine\Letter::Q;
    public const R = \JulienBoudry\EnigmaMachine\Letter::R;
    public const S = \JulienBoudry\EnigmaMachine\Letter::S;
    public const T = \JulienBoudry\EnigmaMachine\Letter::T;
    public const U = \JulienBoudry\EnigmaMachine\Letter::U;
    public const V = \JulienBoudry\EnigmaMachine\Letter::V;
    public const W = \JulienBoudry\EnigmaMachine\Letter::W;
    public const X = \JulienBoudry\EnigmaMachine\Letter::X;
    public const Y = \JulienBoudry\EnigmaMachine\Letter::Y;
    public const Z = \JulienBoudry\EnigmaMachine\Letter::Z;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) int $value;

    // Static Methods
    public static function count( ): int;
    public static function fromChar( string $char ): JulienBoudry\EnigmaMachine\Letter;
    public static function fromPosition( int $position ): JulienBoudry\EnigmaMachine\Letter;

    // Methods
    public function toChar( ): string;

}
```

## Full Representation
```php
enum JulienBoudry\EnigmaMachine\Letter: int implements UnitEnum, BackedEnum
{
    case A = 0;
    case B = 1;
    case C = 2;
    case D = 3;
    case E = 4;
    case F = 5;
    case G = 6;
    case H = 7;
    case I = 8;
    case J = 9;
    case K = 10;
    case L = 11;
    case M = 12;
    case N = 13;
    case O = 14;
    case P = 15;
    case Q = 16;
    case R = 17;
    case S = 18;
    case T = 19;
    case U = 20;
    case V = 21;
    case W = 22;
    case X = 23;
    case Y = 24;
    case Z = 25;
    // Constants
    public const A = \JulienBoudry\EnigmaMachine\Letter::A;
    public const B = \JulienBoudry\EnigmaMachine\Letter::B;
    public const C = \JulienBoudry\EnigmaMachine\Letter::C;
    public const D = \JulienBoudry\EnigmaMachine\Letter::D;
    public const E = \JulienBoudry\EnigmaMachine\Letter::E;
    public const F = \JulienBoudry\EnigmaMachine\Letter::F;
    public const G = \JulienBoudry\EnigmaMachine\Letter::G;
    public const H = \JulienBoudry\EnigmaMachine\Letter::H;
    public const I = \JulienBoudry\EnigmaMachine\Letter::I;
    public const J = \JulienBoudry\EnigmaMachine\Letter::J;
    public const K = \JulienBoudry\EnigmaMachine\Letter::K;
    public const L = \JulienBoudry\EnigmaMachine\Letter::L;
    public const M = \JulienBoudry\EnigmaMachine\Letter::M;
    public const N = \JulienBoudry\EnigmaMachine\Letter::N;
    public const O = \JulienBoudry\EnigmaMachine\Letter::O;
    public const P = \JulienBoudry\EnigmaMachine\Letter::P;
    public const Q = \JulienBoudry\EnigmaMachine\Letter::Q;
    public const R = \JulienBoudry\EnigmaMachine\Letter::R;
    public const S = \JulienBoudry\EnigmaMachine\Letter::S;
    public const T = \JulienBoudry\EnigmaMachine\Letter::T;
    public const U = \JulienBoudry\EnigmaMachine\Letter::U;
    public const V = \JulienBoudry\EnigmaMachine\Letter::V;
    public const W = \JulienBoudry\EnigmaMachine\Letter::W;
    public const X = \JulienBoudry\EnigmaMachine\Letter::X;
    public const Y = \JulienBoudry\EnigmaMachine\Letter::Y;
    public const Z = \JulienBoudry\EnigmaMachine\Letter::Z;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) int $value;

    // Static Methods
    public static function count( ): int;
    public static function fromChar( string $char ): JulienBoudry\EnigmaMachine\Letter;
    public static function fromPosition( int $position ): JulienBoudry\EnigmaMachine\Letter;

    // Methods
    public function toChar( ): string;

}
```