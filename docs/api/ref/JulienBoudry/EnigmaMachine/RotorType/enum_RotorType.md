> JulienBoudry \ **RotorType**
# Enum RotorType
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorType.php#L18)

## Description
Defines the different rotor variants (Walzen) available for Enigma machines.
Each rotor has unique internal wiring and notch positions.
Different Enigma models support different subsets of these rotors.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| BETA | `public const BETA = \JulienBoudry\EnigmaMachine\RotorType::BETA` | __ |
| GAMMA | `public const GAMMA = \JulienBoudry\EnigmaMachine\RotorType::GAMMA` | __ |
| I | `public const I = \JulienBoudry\EnigmaMachine\RotorType::I` | __ |
| II | `public const II = \JulienBoudry\EnigmaMachine\RotorType::II` | __ |
| III | `public const III = \JulienBoudry\EnigmaMachine\RotorType::III` | __ |
| IV | `public const IV = \JulienBoudry\EnigmaMachine\RotorType::IV` | __ |
| K_I | `public const K_I = \JulienBoudry\EnigmaMachine\RotorType::K_I` | _Notch at G (turnover at Y)._ |
| K_II | `public const K_II = \JulienBoudry\EnigmaMachine\RotorType::K_II` | _Notch at M (turnover at E)._ |
| K_III | `public const K_III = \JulienBoudry\EnigmaMachine\RotorType::K_III` | _Notch at V (turnover at N)._ |
| RAILWAY_I | `public const RAILWAY_I = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_I` | _Notch at G (turnover at Y)._ |
| RAILWAY_II | `public const RAILWAY_II = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_II` | _Notch at M (turnover at E)._ |
| RAILWAY_III | `public const RAILWAY_III = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_III` | _Notch at V (turnover at N)._ |
| SWISS_K_I | `public const SWISS_K_I = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_I` | _Notch at G (turnover at Y)._ |
| SWISS_K_II | `public const SWISS_K_II = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_II` | _Notch at M (turnover at E)._ |
| SWISS_K_III | `public const SWISS_K_III = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_III` | _Notch at V (turnover at N)._ |
| TIRPITZ_I | `public const TIRPITZ_I = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_I` | _5 notches at E, H, K, N, Q._ |
| TIRPITZ_II | `public const TIRPITZ_II = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_II` | _5 notches at E, H, K, N, Q._ |
| TIRPITZ_III | `public const TIRPITZ_III = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_III` | _5 notches at E, H, K, N, Q._ |
| TIRPITZ_IV | `public const TIRPITZ_IV = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_IV` | _5 notches at E, H, K, N, Q._ |
| TIRPITZ_V | `public const TIRPITZ_V = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_V` | _5 notches at E, H, K, N, Q._ |
| TIRPITZ_VI | `public const TIRPITZ_VI = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VI` | _5 notches at E, H, K, N, Q._ |
| TIRPITZ_VII | `public const TIRPITZ_VII = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VII` | _5 notches at E, H, K, N, Q._ |
| TIRPITZ_VIII | `public const TIRPITZ_VIII = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VIII` | _5 notches at E, H, K, N, Q._ |
| V | `public const V = \JulienBoudry\EnigmaMachine\RotorType::V` | __ |
| VI | `public const VI = \JulienBoudry\EnigmaMachine\RotorType::VI` | __ |
| VII | `public const VII = \JulienBoudry\EnigmaMachine\RotorType::VII` | __ |
| VIII | `public const VIII = \JulienBoudry\EnigmaMachine\RotorType::VIII` | __ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [getCompatibleRotorsForModel(...)](method_getCompatibleRotorsForModel.md) | _This method dynamically filters rotors based on their getCompatibleModels() method, excluding Greek rotors (Beta/Gamma) which have special positioning rules._ |
| [getGreekRotors(...)](method_getGreekRotors.md) | __ |

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
enum JulienBoudry\EnigmaMachine\RotorType implements UnitEnum
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
    case K_I;
    case K_II;
    case K_III;
    case SWISS_K_I;
    case SWISS_K_II;
    case SWISS_K_III;
    case RAILWAY_I;
    case RAILWAY_II;
    case RAILWAY_III;
    case TIRPITZ_I;
    case TIRPITZ_II;
    case TIRPITZ_III;
    case TIRPITZ_IV;
    case TIRPITZ_V;
    case TIRPITZ_VI;
    case TIRPITZ_VII;
    case TIRPITZ_VIII;
    // Constants
    public const BETA = \JulienBoudry\EnigmaMachine\RotorType::BETA;
    public const GAMMA = \JulienBoudry\EnigmaMachine\RotorType::GAMMA;
    public const I = \JulienBoudry\EnigmaMachine\RotorType::I;
    public const II = \JulienBoudry\EnigmaMachine\RotorType::II;
    public const III = \JulienBoudry\EnigmaMachine\RotorType::III;
    public const IV = \JulienBoudry\EnigmaMachine\RotorType::IV;
    public const K_I = \JulienBoudry\EnigmaMachine\RotorType::K_I;
    public const K_II = \JulienBoudry\EnigmaMachine\RotorType::K_II;
    public const K_III = \JulienBoudry\EnigmaMachine\RotorType::K_III;
    public const RAILWAY_I = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_I;
    public const RAILWAY_II = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_II;
    public const RAILWAY_III = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_III;
    public const SWISS_K_I = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_I;
    public const SWISS_K_II = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_II;
    public const SWISS_K_III = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_III;
    public const TIRPITZ_I = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_I;
    public const TIRPITZ_II = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_II;
    public const TIRPITZ_III = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_III;
    public const TIRPITZ_IV = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_IV;
    public const TIRPITZ_V = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_V;
    public const TIRPITZ_VI = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VI;
    public const TIRPITZ_VII = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VII;
    public const TIRPITZ_VIII = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VIII;
    public const V = \JulienBoudry\EnigmaMachine\RotorType::V;
    public const VI = \JulienBoudry\EnigmaMachine\RotorType::VI;
    public const VII = \JulienBoudry\EnigmaMachine\RotorType::VII;
    public const VIII = \JulienBoudry\EnigmaMachine\RotorType::VIII;

    // Properties
    public protected(set) readonly protected(set) string $name;

    // Static Methods
    public static function getCompatibleRotorsForModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): array;
    public static function getGreekRotors( ): array;

    // Methods
    public function createRotor( [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function isGreekRotor( ): bool;

}
```

## Full Representation
```php
enum JulienBoudry\EnigmaMachine\RotorType implements UnitEnum
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
    case K_I;
    case K_II;
    case K_III;
    case SWISS_K_I;
    case SWISS_K_II;
    case SWISS_K_III;
    case RAILWAY_I;
    case RAILWAY_II;
    case RAILWAY_III;
    case TIRPITZ_I;
    case TIRPITZ_II;
    case TIRPITZ_III;
    case TIRPITZ_IV;
    case TIRPITZ_V;
    case TIRPITZ_VI;
    case TIRPITZ_VII;
    case TIRPITZ_VIII;
    // Constants
    public const BETA = \JulienBoudry\EnigmaMachine\RotorType::BETA;
    public const GAMMA = \JulienBoudry\EnigmaMachine\RotorType::GAMMA;
    public const I = \JulienBoudry\EnigmaMachine\RotorType::I;
    public const II = \JulienBoudry\EnigmaMachine\RotorType::II;
    public const III = \JulienBoudry\EnigmaMachine\RotorType::III;
    public const IV = \JulienBoudry\EnigmaMachine\RotorType::IV;
    public const K_I = \JulienBoudry\EnigmaMachine\RotorType::K_I;
    public const K_II = \JulienBoudry\EnigmaMachine\RotorType::K_II;
    public const K_III = \JulienBoudry\EnigmaMachine\RotorType::K_III;
    public const RAILWAY_I = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_I;
    public const RAILWAY_II = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_II;
    public const RAILWAY_III = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_III;
    public const SWISS_K_I = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_I;
    public const SWISS_K_II = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_II;
    public const SWISS_K_III = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_III;
    public const TIRPITZ_I = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_I;
    public const TIRPITZ_II = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_II;
    public const TIRPITZ_III = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_III;
    public const TIRPITZ_IV = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_IV;
    public const TIRPITZ_V = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_V;
    public const TIRPITZ_VI = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VI;
    public const TIRPITZ_VII = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VII;
    public const TIRPITZ_VIII = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VIII;
    public const V = \JulienBoudry\EnigmaMachine\RotorType::V;
    public const VI = \JulienBoudry\EnigmaMachine\RotorType::VI;
    public const VII = \JulienBoudry\EnigmaMachine\RotorType::VII;
    public const VIII = \JulienBoudry\EnigmaMachine\RotorType::VIII;

    // Properties
    public protected(set) readonly protected(set) string $name;

    // Static Methods
    public static function getCompatibleRotorsForModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): array;
    public static function getGreekRotors( ): array;

    // Methods
    public function createRotor( [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function isGreekRotor( ): bool;

}
```