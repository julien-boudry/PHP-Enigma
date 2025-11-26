> JulienBoudry \ **EnigmaWiring**
# Class EnigmaWiring
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaWiring.php#L27)

## Description
This class implements the wiring used by rotors, reflectors, and the plugboard.
Each wiring provides a monoalphabetical substitution, mapping each input letter
to a different output letter.

Example wiring:
<pre>
ABCDEFGHIJKLMNOPQRSTUVWXYZ
||||||||||||||||||||||||||
EKMFLGDQVZNTOWYHXUSPAIBRCJ
</pre>

The wiring can be traversed in both directions (side A to B, or B to A).
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | _example string EKMFLGDQVZNTOWYHXUSPAIBRCJ leads to [0]=4, [1]=10, [2]=12, ..._ |
| [connect(...)](method_connect.md) | __ |
| [connectsTo(...)](method_connectsTo.md) | __ |
| [processLetter1stPass(...)](method_processLetter1stPass.md) | __ |
| [processLetter2ndPass(...)](method_processLetter2ndPass.md) | __ |


## Public Representation
```php
class JulienBoudry\Enigma\EnigmaWiring
{

    // Methods
    public function __clone( ): void;
    public function __construct( string $wiring );
    public function connect( int $pin1, int $pin2 ): void;
    public function connectsTo( int $pin ): int;
    public function processLetter1stPass( int $pin ): int;
    public function processLetter2ndPass( int $pin ): int;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\EnigmaWiring
{

    // Properties
    private array $wiring;

    // Methods
    public function __clone( ): void;
    public function __construct( string $wiring );
    public function connect( int $pin1, int $pin2 ): void;
    public function connectsTo( int $pin ): int;
    public function processLetter1stPass( int $pin ): int;
    public function processLetter2ndPass( int $pin ): int;

}
```