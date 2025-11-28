> JulienBoudry \ **EnigmaPlugboard**
# Class EnigmaPlugboard
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaPlugboard.php#L31)

## Description
Represents the Plugboard (Steckerbrett) of an Enigma machine.

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
| [__clone(...)](method___clone.md) | _Deep clone the plugboard._ |
| [__construct(...)](method___construct.md) | _Constructor creates a new Wiring and connects the pins in pairs._ |
| [getPluggedPairs(...)](method_getPluggedPairs.md) | _Get all plugged letter pairs._ |
| [plugLetters(...)](method_plugLetters.md) | _Connect 2 letters._ |
| [plugLettersFromPairs(...)](method_plugLettersFromPairs.md) | _Connect multiple letter pairs from string notation._ |
| [processLetter(...)](method_processLetter.md) | _Send a letter through the wiring._ |
| [unplugLetters(...)](method_unplugLetters.md) | _Disconnect 2 letters._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\EnigmaPlugboard
{

    // Methods
    public function __clone( ): void;
    public function __construct( );
    public function getPluggedPairs( ): array;
    public function plugLetters( JulienBoudry\EnigmaMachine\Letter $letter1, JulienBoudry\EnigmaMachine\Letter $letter2 ): void;
    public function plugLettersFromPairs( array|string $pairs ): void;
    public function processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function unplugLetters( JulienBoudry\EnigmaMachine\Letter $letter ): void;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\EnigmaPlugboard
{

    // Properties
    private JulienBoudry\EnigmaMachine\EnigmaWiring $wiring;

    // Methods
    public function __clone( ): void;
    public function __construct( );
    public function getPluggedPairs( ): array;
    public function plugLetters( JulienBoudry\EnigmaMachine\Letter $letter1, JulienBoudry\EnigmaMachine\Letter $letter2 ): void;
    public function plugLettersFromPairs( array|string $pairs ): void;
    public function processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function unplugLetters( JulienBoudry\EnigmaMachine\Letter $letter ): void;

}
```