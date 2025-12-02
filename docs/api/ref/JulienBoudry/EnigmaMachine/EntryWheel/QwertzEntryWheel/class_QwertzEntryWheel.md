> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **QwertzEntryWheel**
# Class QwertzEntryWheel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheel/QwertzEntryWheel.php#L16)

## Description
QWERTZ Entry Wheel used in commercial Enigma models.

Commercial models (Enigma K, Swiss-K, Railway) use QWERTZ keyboard order:
Q→0, W→1, E→2, R→3, T→4, Z→5, U→6, I→7, O→8, A→9, S→10, D→11, F→12, G→13,
H→14, J→15, K→16, P→17, Y→18, X→19, C→20, V→21, B→22, N→23, M→24, L→25

This maps the German QWERTZ keyboard layout to sequential rotor contact positions.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| WIRING | `public const string WIRING = 'QWERTZUIOASDFGHJKPYXCVBNML'` | _QWERTZ keyboard order as used in commercial Enigma models._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractEntryWheel/method___clone.md) | _Deep clone the entry wheel._ |
| [__construct(...)](../AbstractEntryWheel/method___construct.md) | _Constructor creates the entry wheel wiring._ |
| [getWiringString(...)](method_getWiringString.md) | __ |
| [processInward(...)](../AbstractEntryWheel/method_processInward.md) | _Process a letter entering the rotor assembly (keyboard → rotors)._ |
| [processOutward(...)](../AbstractEntryWheel/method_processOutward.md) | _Process a letter exiting the rotor assembly (rotors → lamps)._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\EntryWheel\QwertzEntryWheel extends JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel
{
    // Constants
    public const string WIRING = 'QWERTZUIOASDFGHJKPYXCVBNML';

    // Methods
    public function getWiringString( ): string;

    // Inherited Methods
    public function AbstractEntryWheel->__clone( ): void;
    public function AbstractEntryWheel->__construct( );
    public function AbstractEntryWheel->processInward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractEntryWheel->processOutward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\EntryWheel\QwertzEntryWheel extends JulienBoudry\EnigmaMachine\EntryWheel\AbstractEntryWheel
{
    // Constants
    public const string WIRING = 'QWERTZUIOASDFGHJKPYXCVBNML';

    // Inherited Properties
    protected JulienBoudry\EnigmaMachine\EnigmaWiring AbstractEntryWheel->wiring;

    // Methods
    public function getWiringString( ): string;

    // Inherited Methods
    public function AbstractEntryWheel->__clone( ): void;
    public function AbstractEntryWheel->__construct( );
    public function AbstractEntryWheel->processInward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractEntryWheel->processOutward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```