> JulienBoudry \ **EnigmaModel**
# Enum EnigmaModel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaModel.php#L13)

## Description
Defines the different historical Enigma machine variants that can be emulated.
Each model has its own specific set of available rotors and reflectors.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| KMM3 | `public const KMM3 = \JulienBoudry\Enigma\EnigmaModel::KMM3` | __ |
| KMM4 | `public const KMM4 = \JulienBoudry\Enigma\EnigmaModel::KMM4` | __ |
| WMLW | `public const WMLW = \JulienBoudry\Enigma\EnigmaModel::WMLW` | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [name(...)](property_name.md) | __ |


## Public Representation
```php
enum JulienBoudry\Enigma\EnigmaModel implements UnitEnum
{
    case WMLW;
    case KMM3;
    case KMM4;
    // Constants
    public const KMM3 = \JulienBoudry\Enigma\EnigmaModel::KMM3;
    public const KMM4 = \JulienBoudry\Enigma\EnigmaModel::KMM4;
    public const WMLW = \JulienBoudry\Enigma\EnigmaModel::WMLW;

    // Properties
    public protected(set) readonly protected(set) string $name;

}
```

## Full Representation
```php
enum JulienBoudry\Enigma\EnigmaModel implements UnitEnum
{
    case WMLW;
    case KMM3;
    case KMM4;
    // Constants
    public const KMM3 = \JulienBoudry\Enigma\EnigmaModel::KMM3;
    public const KMM4 = \JulienBoudry\Enigma\EnigmaModel::KMM4;
    public const WMLW = \JulienBoudry\Enigma\EnigmaModel::WMLW;

    // Properties
    public protected(set) readonly protected(set) string $name;

}
```