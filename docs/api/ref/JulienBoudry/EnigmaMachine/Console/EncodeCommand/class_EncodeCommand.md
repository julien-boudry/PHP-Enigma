> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **EncodeCommand**
# Class EncodeCommand
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Console/EncodeCommand.php#L29)

## Description
Command to encode text using the Enigma machine.

The Enigma cipher is reciprocal: encoding and decoding are the SAME operation.
To decode a message, simply run it through Enigma again with identical settings.
This is a fundamental property of the Enigma machine's electrical circuit design.

Example:
  encode("HELLO") → "MFNCZ"
  encode("MFNCZ") → "HELLO"  (same settings)
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| FAILURE | `public const FAILURE = 1` | __ |
| INVALID | `public const INVALID = 2` | __ |
| SUCCESS | `public const SUCCESS = 0` | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [setExplicitlyProvidedOptions(...)](method_setExplicitlyProvidedOptions.md) | _Store options that were explicitly provided (for testing with CommandTester)._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\Console\EncodeCommand extends Symfony\Component\Console\Command\Command implements Symfony\Component\Console\Command\SignalableCommandInterface
{

    // Methods
    public function setExplicitlyProvidedOptions( array $options ): void;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\Console\EncodeCommand extends Symfony\Component\Console\Command\Command implements Symfony\Component\Console\Command\SignalableCommandInterface
{
    // Inherited Constants
    public const EncodeCommand::FAILURE = 1;
    public const EncodeCommand::INVALID = 2;
    public const EncodeCommand::SUCCESS = 0;

    // Properties
    protected JulienBoudry\EnigmaMachine\Console\EnigmaStyle $io;
    protected bool $isInteractive = false;
    private array $explicitlyProvidedOptions = [];

    // Static Methods
    public static function getDefaultDescription( ): ?string;
    public static function getDefaultName( ): ?string;

    // Methods
    public function setExplicitlyProvidedOptions( array $options ): void;

}
```