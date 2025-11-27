> JulienBoudry \ **EnigmaWiring**
# Class EnigmaWiring
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaWiring.php#L25)

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
| [__construct(...)](method___construct.md) | _example string EKMFLGDQVZNTOWYHXUSPAIBRCJ leads to [0]=Letter::E, [1]=Letter::K, [2]=Letter::M, ..._ |
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
    public function connect( JulienBoudry\Enigma\Letter $pin1, JulienBoudry\Enigma\Letter $pin2 ): void;
    public function connectsTo( JulienBoudry\Enigma\Letter $pin ): JulienBoudry\Enigma\Letter;
    public function processLetter1stPass( JulienBoudry\Enigma\Letter $pin ): JulienBoudry\Enigma\Letter;
    public function processLetter2ndPass( JulienBoudry\Enigma\Letter $pin ): JulienBoudry\Enigma\Letter;

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
    public function connect( JulienBoudry\Enigma\Letter $pin1, JulienBoudry\Enigma\Letter $pin2 ): void;
    public function connectsTo( JulienBoudry\Enigma\Letter $pin ): JulienBoudry\Enigma\Letter;
    public function processLetter1stPass( JulienBoudry\Enigma\Letter $pin ): JulienBoudry\Enigma\Letter;
    public function processLetter2ndPass( JulienBoudry\Enigma\Letter $pin ): JulienBoudry\Enigma\Letter;

}
```