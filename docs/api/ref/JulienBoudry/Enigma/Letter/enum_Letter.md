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
| A | `public const A = \JulienBoudry\Enigma\Letter::A` | __ |
| B | `public const B = \JulienBoudry\Enigma\Letter::B` | __ |
| C | `public const C = \JulienBoudry\Enigma\Letter::C` | __ |
| D | `public const D = \JulienBoudry\Enigma\Letter::D` | __ |
| E | `public const E = \JulienBoudry\Enigma\Letter::E` | __ |
| F | `public const F = \JulienBoudry\Enigma\Letter::F` | __ |
| G | `public const G = \JulienBoudry\Enigma\Letter::G` | __ |
| H | `public const H = \JulienBoudry\Enigma\Letter::H` | __ |
| I | `public const I = \JulienBoudry\Enigma\Letter::I` | __ |
| J | `public const J = \JulienBoudry\Enigma\Letter::J` | __ |
| K | `public const K = \JulienBoudry\Enigma\Letter::K` | __ |
| L | `public const L = \JulienBoudry\Enigma\Letter::L` | __ |
| M | `public const M = \JulienBoudry\Enigma\Letter::M` | __ |
| N | `public const N = \JulienBoudry\Enigma\Letter::N` | __ |
| O | `public const O = \JulienBoudry\Enigma\Letter::O` | __ |
| P | `public const P = \JulienBoudry\Enigma\Letter::P` | __ |
| Q | `public const Q = \JulienBoudry\Enigma\Letter::Q` | __ |
| R | `public const R = \JulienBoudry\Enigma\Letter::R` | __ |
| S | `public const S = \JulienBoudry\Enigma\Letter::S` | __ |
| T | `public const T = \JulienBoudry\Enigma\Letter::T` | __ |
| U | `public const U = \JulienBoudry\Enigma\Letter::U` | __ |
| V | `public const V = \JulienBoudry\Enigma\Letter::V` | __ |
| W | `public const W = \JulienBoudry\Enigma\Letter::W` | __ |
| X | `public const X = \JulienBoudry\Enigma\Letter::X` | __ |
| Y | `public const Y = \JulienBoudry\Enigma\Letter::Y` | __ |
| Z | `public const Z = \JulienBoudry\Enigma\Letter::Z` | __ |

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
enum JulienBoudry\Enigma\Letter: int implements UnitEnum, BackedEnum
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
    public const A = \JulienBoudry\Enigma\Letter::A;
    public const B = \JulienBoudry\Enigma\Letter::B;
    public const C = \JulienBoudry\Enigma\Letter::C;
    public const D = \JulienBoudry\Enigma\Letter::D;
    public const E = \JulienBoudry\Enigma\Letter::E;
    public const F = \JulienBoudry\Enigma\Letter::F;
    public const G = \JulienBoudry\Enigma\Letter::G;
    public const H = \JulienBoudry\Enigma\Letter::H;
    public const I = \JulienBoudry\Enigma\Letter::I;
    public const J = \JulienBoudry\Enigma\Letter::J;
    public const K = \JulienBoudry\Enigma\Letter::K;
    public const L = \JulienBoudry\Enigma\Letter::L;
    public const M = \JulienBoudry\Enigma\Letter::M;
    public const N = \JulienBoudry\Enigma\Letter::N;
    public const O = \JulienBoudry\Enigma\Letter::O;
    public const P = \JulienBoudry\Enigma\Letter::P;
    public const Q = \JulienBoudry\Enigma\Letter::Q;
    public const R = \JulienBoudry\Enigma\Letter::R;
    public const S = \JulienBoudry\Enigma\Letter::S;
    public const T = \JulienBoudry\Enigma\Letter::T;
    public const U = \JulienBoudry\Enigma\Letter::U;
    public const V = \JulienBoudry\Enigma\Letter::V;
    public const W = \JulienBoudry\Enigma\Letter::W;
    public const X = \JulienBoudry\Enigma\Letter::X;
    public const Y = \JulienBoudry\Enigma\Letter::Y;
    public const Z = \JulienBoudry\Enigma\Letter::Z;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) int $value;

    // Static Methods
    public static function count( ): int;
    public static function fromChar( string $char ): JulienBoudry\Enigma\Letter;
    public static function fromPosition( int $position ): JulienBoudry\Enigma\Letter;

    // Methods
    public function toChar( ): string;

}
```

## Full Representation
```php
enum JulienBoudry\Enigma\Letter: int implements UnitEnum, BackedEnum
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
    public const A = \JulienBoudry\Enigma\Letter::A;
    public const B = \JulienBoudry\Enigma\Letter::B;
    public const C = \JulienBoudry\Enigma\Letter::C;
    public const D = \JulienBoudry\Enigma\Letter::D;
    public const E = \JulienBoudry\Enigma\Letter::E;
    public const F = \JulienBoudry\Enigma\Letter::F;
    public const G = \JulienBoudry\Enigma\Letter::G;
    public const H = \JulienBoudry\Enigma\Letter::H;
    public const I = \JulienBoudry\Enigma\Letter::I;
    public const J = \JulienBoudry\Enigma\Letter::J;
    public const K = \JulienBoudry\Enigma\Letter::K;
    public const L = \JulienBoudry\Enigma\Letter::L;
    public const M = \JulienBoudry\Enigma\Letter::M;
    public const N = \JulienBoudry\Enigma\Letter::N;
    public const O = \JulienBoudry\Enigma\Letter::O;
    public const P = \JulienBoudry\Enigma\Letter::P;
    public const Q = \JulienBoudry\Enigma\Letter::Q;
    public const R = \JulienBoudry\Enigma\Letter::R;
    public const S = \JulienBoudry\Enigma\Letter::S;
    public const T = \JulienBoudry\Enigma\Letter::T;
    public const U = \JulienBoudry\Enigma\Letter::U;
    public const V = \JulienBoudry\Enigma\Letter::V;
    public const W = \JulienBoudry\Enigma\Letter::W;
    public const X = \JulienBoudry\Enigma\Letter::X;
    public const Y = \JulienBoudry\Enigma\Letter::Y;
    public const Z = \JulienBoudry\Enigma\Letter::Z;

    // Properties
    public protected(set) readonly protected(set) string $name;
    public protected(set) readonly protected(set) int $value;

    // Static Methods
    public static function count( ): int;
    public static function fromChar( string $char ): JulienBoudry\Enigma\Letter;
    public static function fromPosition( int $position ): JulienBoudry\Enigma\Letter;

    // Methods
    public function toChar( ): string;

}
```