> JulienBoudry \ **EnigmaWiring**
# Class EnigmaWiring
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaWiring.php#L25)

## Description
Represents the internal wiring of Enigma components.

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
| [__clone(...)](method___clone.md) | _Clone the wiring array for deep cloning support._ |
| [__construct(...)](method___construct.md) | _Constructor connects the pins according to the list in $wiring._ |
| [connect(...)](method_connect.md) | _Manually connect 2 pins._ |
| [connectsTo(...)](method_connectsTo.md) | _Get the connected pin._ |
| [processLetter1stPass(...)](method_processLetter1stPass.md) | _Pass the given letter form side A to side B by following the connection of the pins._ |
| [processLetter2ndPass(...)](method_processLetter2ndPass.md) | _Pass the given letter form side B to side A by following the connection of the pins._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\EnigmaWiring
{

    // Methods
    public function __clone( ): void;
    public function __construct( string $wiring );
    public function connect( JulienBoudry\EnigmaMachine\Letter $pin1, JulienBoudry\EnigmaMachine\Letter $pin2 ): void;
    public function connectsTo( JulienBoudry\EnigmaMachine\Letter $pin ): JulienBoudry\EnigmaMachine\Letter;
    public function processLetter1stPass( JulienBoudry\EnigmaMachine\Letter $pin ): JulienBoudry\EnigmaMachine\Letter;
    public function processLetter2ndPass( JulienBoudry\EnigmaMachine\Letter $pin ): JulienBoudry\EnigmaMachine\Letter;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\EnigmaWiring
{

    // Properties
    private array $wiring;

    // Methods
    public function __clone( ): void;
    public function __construct( string $wiring );
    public function connect( JulienBoudry\EnigmaMachine\Letter $pin1, JulienBoudry\EnigmaMachine\Letter $pin2 ): void;
    public function connectsTo( JulienBoudry\EnigmaMachine\Letter $pin ): JulienBoudry\EnigmaMachine\Letter;
    public function processLetter1stPass( JulienBoudry\EnigmaMachine\Letter $pin ): JulienBoudry\EnigmaMachine\Letter;
    public function processLetter2ndPass( JulienBoudry\EnigmaMachine\Letter $pin ): JulienBoudry\EnigmaMachine\Letter;

}
```