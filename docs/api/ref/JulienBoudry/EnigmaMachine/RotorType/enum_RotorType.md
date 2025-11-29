> JulienBoudry \ **RotorType**
# Enum RotorType
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorType.php#L18)

## Description
Enumeration of available rotor types.

Defines the different rotor variants (Walzen) available for Enigma machines.
Each rotor has unique internal wiring and notch positions.
Different Enigma models support different subsets of these rotors.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| BETA | `public const BETA = \JulienBoudry\EnigmaMachine\RotorType::BETA` | __ |
| GAMMA | `public const GAMMA = \JulienBoudry\EnigmaMachine\RotorType::GAMMA` | __ |
| I | `public const I = \JulienBoudry\EnigmaMachine\RotorType::I` | _ID Rotor I._ |
| II | `public const II = \JulienBoudry\EnigmaMachine\RotorType::II` | _ID Rotor II._ |
| III | `public const III = \JulienBoudry\EnigmaMachine\RotorType::III` | _ID Rotor III._ |
| IV | `public const IV = \JulienBoudry\EnigmaMachine\RotorType::IV` | _ID Rotor IV._ |
| K_I | `public const K_I = \JulienBoudry\EnigmaMachine\RotorType::K_I` | _Commercial Enigma K Rotor I._ |
| K_II | `public const K_II = \JulienBoudry\EnigmaMachine\RotorType::K_II` | _Commercial Enigma K Rotor II._ |
| K_III | `public const K_III = \JulienBoudry\EnigmaMachine\RotorType::K_III` | _Commercial Enigma K Rotor III._ |
| RAILWAY_I | `public const RAILWAY_I = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_I` | _Railway Enigma Rotor I._ |
| RAILWAY_II | `public const RAILWAY_II = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_II` | _Railway Enigma Rotor II._ |
| RAILWAY_III | `public const RAILWAY_III = \JulienBoudry\EnigmaMachine\RotorType::RAILWAY_III` | _Railway Enigma Rotor III._ |
| SWISS_K_I | `public const SWISS_K_I = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_I` | _Swiss-K Rotor I (Swiss Air Force wiring)._ |
| SWISS_K_II | `public const SWISS_K_II = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_II` | _Swiss-K Rotor II (Swiss Air Force wiring)._ |
| SWISS_K_III | `public const SWISS_K_III = \JulienBoudry\EnigmaMachine\RotorType::SWISS_K_III` | _Swiss-K Rotor III (Swiss Air Force wiring)._ |
| TIRPITZ_I | `public const TIRPITZ_I = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_I` | _Enigma T (Tirpitz) Rotor I._ |
| TIRPITZ_II | `public const TIRPITZ_II = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_II` | _Enigma T (Tirpitz) Rotor II._ |
| TIRPITZ_III | `public const TIRPITZ_III = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_III` | _Enigma T (Tirpitz) Rotor III._ |
| TIRPITZ_IV | `public const TIRPITZ_IV = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_IV` | _Enigma T (Tirpitz) Rotor IV._ |
| TIRPITZ_V | `public const TIRPITZ_V = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_V` | _Enigma T (Tirpitz) Rotor V._ |
| TIRPITZ_VI | `public const TIRPITZ_VI = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VI` | _Enigma T (Tirpitz) Rotor VI._ |
| TIRPITZ_VII | `public const TIRPITZ_VII = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VII` | _Enigma T (Tirpitz) Rotor VII._ |
| TIRPITZ_VIII | `public const TIRPITZ_VIII = \JulienBoudry\EnigmaMachine\RotorType::TIRPITZ_VIII` | _Enigma T (Tirpitz) Rotor VIII._ |
| V | `public const V = \JulienBoudry\EnigmaMachine\RotorType::V` | _ID Rotor V._ |
| VI | `public const VI = \JulienBoudry\EnigmaMachine\RotorType::VI` | _ID Rotor VI only available in model Kriegsmarine M3 and M4._ |
| VII | `public const VII = \JulienBoudry\EnigmaMachine\RotorType::VII` | _ID Rotor VII only available in model Kriegsmarine M3 and M4._ |
| VIII | `public const VIII = \JulienBoudry\EnigmaMachine\RotorType::VIII` | _ID Rotor VII only available in model Kriegsmarine M3 and M4._ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [getCompatibleRotorsForModel(...)](method_getCompatibleRotorsForModel.md) | _Get all non-Greek rotor types compatible with a given Enigma model._ |
| [getGreekRotors(...)](method_getGreekRotors.md) | _Get all Greek rotor types (BETA and GAMMA)._ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [createRotor(...)](method_createRotor.md) | _Create a rotor instance for this type._ |
| [isGreekRotor(...)](method_isGreekRotor.md) | _Check if this rotor type is a Greek rotor (BETA or GAMMA)._ |


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
    public protected(set) readonly string $name;

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
    public protected(set) readonly string $name;

    // Static Methods
    public static function getCompatibleRotorsForModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): array;
    public static function getGreekRotors( ): array;

    // Methods
    public function createRotor( [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function isGreekRotor( ): bool;

}
```