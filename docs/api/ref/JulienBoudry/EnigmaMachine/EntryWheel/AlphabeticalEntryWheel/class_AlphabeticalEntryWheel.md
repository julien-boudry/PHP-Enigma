> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **AlphabeticalEntryWheel**
# Class AlphabeticalEntryWheel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheel/AlphabeticalEntryWheel.php#L17)

## Description
Alphabetical Entry Wheel used in military Enigma models.

Military Enigma models (Wehrmacht, Kriegsmarine) use alphabetical order:
A→0, B→1, C→2, ... (identity mapping)

This is effectively a pass-through - the letter position equals the contact position.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| WIRING | `public const string WIRING = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'` | _Alphabetical order (identity mapping)._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractEntryWheel/method___clone.md) | _Deep clone the entry wheel._ |
| [__construct(...)](../AbstractEntryWheel/method___construct.md) | _Constructor creates the entry wheel wiring._ |
| [processInward(...)](../AbstractEntryWheel/method_processInward.md) | _Process a letter entering the rotor assembly (keyboard → rotors)._ |
| [processOutward(...)](../AbstractEntryWheel/method_processOutward.md) | _Process a letter exiting the rotor assembly (rotors → lamps)._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\EntryWheel\AlphabeticalEntryWheel extends JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel
{
    // Constants
    public const string WIRING = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Inherited Methods
    public function AbstractEntryWheel->__clone( ): void;
    public function AbstractEntryWheel->__construct( );
    public function AbstractEntryWheel->processInward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractEntryWheel->processOutward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\EntryWheel\AlphabeticalEntryWheel extends JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel
{
    // Constants
    public const string WIRING = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Inherited Properties
    protected JulienBoudry\EnigmaMachine\EnigmaWiring AbstractEntryWheel->wiring;

    // Inherited Methods
    public function AbstractEntryWheel->__clone( ): void;
    public function AbstractEntryWheel->__construct( );
    public function AbstractEntryWheel->processInward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractEntryWheel->processOutward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```