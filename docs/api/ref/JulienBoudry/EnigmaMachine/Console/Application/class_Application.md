> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **Application**
# Class Application
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Console/Application.php#L12)

## Description
Enigma Machine Console Application.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| NAME | `public const NAME = 'Enigma Machine'` | __ |
| VERSION | `public const VERSION = '1.0.0'` | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\Console\Application extends Symfony\Component\Console\Application implements Symfony\Contracts\Service\ResetInterface
{
    // Constants
    public const NAME = 'Enigma Machine';
    public const VERSION = '1.0.0';

    // Methods
    public function __construct( );

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\Console\Application extends Symfony\Component\Console\Application implements Symfony\Contracts\Service\ResetInterface
{
    // Constants
    public const NAME = 'Enigma Machine';
    public const VERSION = '1.0.0';

    // Static Methods
    public static function getAbbreviations( array $names ): array;

    // Methods
    public function __construct( );

}
```