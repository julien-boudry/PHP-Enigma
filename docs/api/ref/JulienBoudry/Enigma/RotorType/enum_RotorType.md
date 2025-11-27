> JulienBoudry \ **RotorType**
# Enum RotorType
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorType.php#L16)

## Description
Defines the different rotor variants (Walzen) available for Enigma machines.
Each rotor has unique internal wiring and notch positions.
Different Enigma models support different subsets of these rotors.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| BETA | `public const BETA = \JulienBoudry\Enigma\RotorType::BETA` | __ |
| GAMMA | `public const GAMMA = \JulienBoudry\Enigma\RotorType::GAMMA` | __ |
| I | `public const I = \JulienBoudry\Enigma\RotorType::I` | __ |
| II | `public const II = \JulienBoudry\Enigma\RotorType::II` | __ |
| III | `public const III = \JulienBoudry\Enigma\RotorType::III` | __ |
| IV | `public const IV = \JulienBoudry\Enigma\RotorType::IV` | __ |
| V | `public const V = \JulienBoudry\Enigma\RotorType::V` | __ |
| VI | `public const VI = \JulienBoudry\Enigma\RotorType::VI` | __ |
| VII | `public const VII = \JulienBoudry\Enigma\RotorType::VII` | __ |
| VIII | `public const VIII = \JulienBoudry\Enigma\RotorType::VIII` | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [createRotor(...)](method_createRotor.md) | __ |
| [isGreekRotor(...)](method_isGreekRotor.md) | __ |


## Public Representation
```php
enum JulienBoudry\Enigma\RotorType implements UnitEnum
{
    case I;
    case II;
    case III;
    case IV;
    case V;
    case VI;
    case VII;
    case VIII;
    case BETA;
    case GAMMA;
    // Constants
    public const BETA = \JulienBoudry\Enigma\RotorType::BETA;
    public const GAMMA = \JulienBoudry\Enigma\RotorType::GAMMA;
    public const I = \JulienBoudry\Enigma\RotorType::I;
    public const II = \JulienBoudry\Enigma\RotorType::II;
    public const III = \JulienBoudry\Enigma\RotorType::III;
    public const IV = \JulienBoudry\Enigma\RotorType::IV;
    public const V = \JulienBoudry\Enigma\RotorType::V;
    public const VI = \JulienBoudry\Enigma\RotorType::VI;
    public const VII = \JulienBoudry\Enigma\RotorType::VII;
    public const VIII = \JulienBoudry\Enigma\RotorType::VIII;

    // Properties
    public protected(set) readonly protected(set) string $name;

    // Methods
    public function createRotor( [ JulienBoudry\Enigma\Letter $ringstellung = \JulienBoudry\Enigma\Letter::A ] ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function isGreekRotor( ): bool;

}
```

## Full Representation
```php
enum JulienBoudry\Enigma\RotorType implements UnitEnum
{
    case I;
    case II;
    case III;
    case IV;
    case V;
    case VI;
    case VII;
    case VIII;
    case BETA;
    case GAMMA;
    // Constants
    public const BETA = \JulienBoudry\Enigma\RotorType::BETA;
    public const GAMMA = \JulienBoudry\Enigma\RotorType::GAMMA;
    public const I = \JulienBoudry\Enigma\RotorType::I;
    public const II = \JulienBoudry\Enigma\RotorType::II;
    public const III = \JulienBoudry\Enigma\RotorType::III;
    public const IV = \JulienBoudry\Enigma\RotorType::IV;
    public const V = \JulienBoudry\Enigma\RotorType::V;
    public const VI = \JulienBoudry\Enigma\RotorType::VI;
    public const VII = \JulienBoudry\Enigma\RotorType::VII;
    public const VIII = \JulienBoudry\Enigma\RotorType::VIII;

    // Properties
    public protected(set) readonly protected(set) string $name;

    // Methods
    public function createRotor( [ JulienBoudry\Enigma\Letter $ringstellung = \JulienBoudry\Enigma\Letter::A ] ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function isGreekRotor( ): bool;

}
```