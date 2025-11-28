> JulienBoudry \ **EnigmaRandomConfigurator**
# Class EnigmaRandomConfigurator
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaRandomConfigurator.php#L24)

## Description
This class provides methods to generate cryptographically secure random
configurations compatible with specific Enigma models. For testing purposes,
a deterministic random engine can be injected.

Generated configurations include:
- Random rotor selection and order (compatible with model)
- Random ring settings (Ringstellung) for each rotor
- Random initial rotor positions (Grundstellung)
- Random plugboard connections (10 pairs, as per historical practice)
- Random reflector (compatible with model)
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| PLUGBOARD_PAIRS | `private const int PLUGBOARD_PAIRS = 10` | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |
| [generate(...)](method_generate.md) | __ |


## Public Representation
```php
final class JulienBoudry\EnigmaMachine\EnigmaRandomConfigurator
{

    // Methods
    public function __construct( [ ?Random\Engine $engine = null ] );
    public function generate( JulienBoudry\EnigmaMachine\EnigmaModel $model ): JulienBoudry\EnigmaMachine\EnigmaConfiguration;

}
```

## Full Representation
```php
final class JulienBoudry\EnigmaMachine\EnigmaRandomConfigurator
{
    // Constants
    private const int PLUGBOARD_PAIRS = 10;

    // Properties
    private Random\Randomizer $randomizer;

    // Methods
    public function __construct( [ ?Random\Engine $engine = null ] );
    public function generate( JulienBoudry\EnigmaMachine\EnigmaModel $model ): JulienBoudry\EnigmaMachine\EnigmaConfiguration;

}
```