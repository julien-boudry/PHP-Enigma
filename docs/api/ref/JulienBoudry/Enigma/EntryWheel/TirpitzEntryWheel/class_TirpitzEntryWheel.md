> JulienBoudry \ [Enigma](../../readme.md) \ **TirpitzEntryWheel**
# Class TirpitzEntryWheel
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheel/TirpitzEntryWheel.php#L15)

## Description
The Enigma T was used for communication between Germany and Japan.
It uses a unique entry wheel order that is neither alphabetical nor QWERTZ:
K→0, Z→1, R→2, O→3, U→4, Q→5, H→6, Y→7, A→8, I→9, G→10, B→11, L→12, W→13,
V→14, S→15, T→16, D→17, X→18, F→19, P→20, N→21, M→22, C→23, J→24, E→25
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| WIRING | `public const string WIRING = 'KZROUQHYAIGBLWVSTDXFPNMCJE'` | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractEntryWheel/method___clone.md) | __ |
| [__construct(...)](../AbstractEntryWheel/method___construct.md) | __ |
| [processInward(...)](../AbstractEntryWheel/method_processInward.md) | __ |
| [processOutward(...)](../AbstractEntryWheel/method_processOutward.md) | __ |


## Public Representation
```php
class JulienBoudry\Enigma\EntryWheel\TirpitzEntryWheel extends JulienBoudry\Enigma\EntryWheel\AbstractEntryWheel
{
    // Constants
    public const string WIRING = 'KZROUQHYAIGBLWVSTDXFPNMCJE';

    // Inherited Methods
    public function AbstractEntryWheel->__clone( ): void;
    public function AbstractEntryWheel->__construct( );
    public function AbstractEntryWheel->processInward( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function AbstractEntryWheel->processOutward( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\EntryWheel\TirpitzEntryWheel extends JulienBoudry\Enigma\EntryWheel\AbstractEntryWheel
{
    // Constants
    public const string WIRING = 'KZROUQHYAIGBLWVSTDXFPNMCJE';

    // Inherited Properties
    protected JulienBoudry\Enigma\EnigmaWiring AbstractEntryWheel->wiring;

    // Inherited Methods
    public function AbstractEntryWheel->__clone( ): void;
    public function AbstractEntryWheel->__construct( );
    public function AbstractEntryWheel->processInward( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function AbstractEntryWheel->processOutward( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```