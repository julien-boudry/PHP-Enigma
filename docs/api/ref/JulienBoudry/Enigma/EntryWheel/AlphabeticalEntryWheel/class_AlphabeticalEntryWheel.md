> JulienBoudry \ [Enigma](../../readme.md) \ **AlphabeticalEntryWheel**
# Class AlphabeticalEntryWheel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheel/AlphabeticalEntryWheel.php#L17)

## Description
Military Enigma models (Wehrmacht, Kriegsmarine) use alphabetical order:
A→0, B→1, C→2, ... (identity mapping)

This is effectively a pass-through - the letter position equals the contact position.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| WIRING | `public const string WIRING = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'` | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractEntryWheel/method___clone.md) | __ |
| [__construct(...)](../AbstractEntryWheel/method___construct.md) | __ |
| [processInward(...)](../AbstractEntryWheel/method_processInward.md) | __ |
| [processOutward(...)](../AbstractEntryWheel/method_processOutward.md) | __ |


## Public Representation
```php
class JulienBoudry\Enigma\EntryWheel\AlphabeticalEntryWheel extends JulienBoudry\Enigma\EntryWheel\AbstractEntryWheel
{
    // Constants
    public const string WIRING = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Inherited Methods
    public function AbstractEntryWheel->__clone( ): void;
    public function AbstractEntryWheel->__construct( );
    public function AbstractEntryWheel->processInward( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function AbstractEntryWheel->processOutward( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\EntryWheel\AlphabeticalEntryWheel extends JulienBoudry\Enigma\EntryWheel\AbstractEntryWheel
{
    // Constants
    public const string WIRING = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Inherited Properties
    protected JulienBoudry\Enigma\EnigmaWiring AbstractEntryWheel->wiring;

    // Inherited Methods
    public function AbstractEntryWheel->__clone( ): void;
    public function AbstractEntryWheel->__construct( );
    public function AbstractEntryWheel->processInward( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function AbstractEntryWheel->processOutward( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```