> JulienBoudry \ **EnigmaPlugboard**
# Class EnigmaPlugboard
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaPlugboard.php#L31)

## Description
The plugboard allows the operator to swap pairs of letters before and after
the signal passes through the rotors. This adds an additional layer of encryption.

The initial setup has no swaps (each letter connects to itself):
<pre>
ABCDEFGHIJKLMNOPQRSTUVWXYZ
||||||||||||||||||||||||||
ABCDEFGHIJKLMNOPQRSTUVWXYZ
</pre>

Plugging two letters (e.g., 'D' and 'F') results in:
<pre>
ABCDEFGHIJKLMNOPQRSTUVWXYZ
||||||||||||||||||||||||||
ABCFEDGHIJKLMNOPQRSTUVWXYZ
</pre>

Unplugging one of the two letters restores the original state.
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | __ |
| [getPluggedPairs(...)](method_getPluggedPairs.md) | _Returns pairs where the first letter is alphabetically before the second to avoid duplicates (e.g., returns [A, Z] not [Z, A])._ |
| [plugLetters(...)](method_plugLetters.md) | __ |
| [processLetter(...)](method_processLetter.md) | _Because pins are connected in pairs, there is no difference if processLetter1stPass() or processLetter2ndPass() is used._ |
| [unplugLetters(...)](method_unplugLetters.md) | _Because letters are connected in pairs, we only need to know one of them._ |


## Public Representation
```php
class JulienBoudry\Enigma\EnigmaPlugboard
{

    // Methods
    public function __clone( ): void;
    public function __construct( );
    public function getPluggedPairs( ): array;
    public function plugLetters( JulienBoudry\Enigma\Letter $letter1, JulienBoudry\Enigma\Letter $letter2 ): void;
    public function processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function unplugLetters( JulienBoudry\Enigma\Letter $letter ): void;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\EnigmaPlugboard
{

    // Properties
    private JulienBoudry\Enigma\EnigmaWiring $wiring;

    // Methods
    public function __clone( ): void;
    public function __construct( );
    public function getPluggedPairs( ): array;
    public function plugLetters( JulienBoudry\Enigma\Letter $letter1, JulienBoudry\Enigma\Letter $letter2 ): void;
    public function processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;
    public function unplugLetters( JulienBoudry\Enigma\Letter $letter ): void;

}
```