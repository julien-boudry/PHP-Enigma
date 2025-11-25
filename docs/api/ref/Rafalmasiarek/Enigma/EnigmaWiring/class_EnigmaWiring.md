> Rafalmasiarek \ **EnigmaWiring**
# Class EnigmaWiring
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaWiring.php#L25)
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | _example string EKMFLGDQVZNTOWYHXUSPAIBRCJ leads to [0]=4, [1]=10, [2]=12, ..._ |
| [connect(...)](method_connect.md) | __ |
| [connectsTo(...)](method_connectsTo.md) | __ |
| [processLetter1stPass(...)](method_processLetter1stPass.md) | __ |
| [processLetter2ndPass(...)](method_processLetter2ndPass.md) | __ |


## Public Representation
```php
class Rafalmasiarek\Enigma\EnigmaWiring
{

    // Methods
    public function __construct( string $wiring );
    public function connect( int $pin1, int $pin2 ): void;
    public function connectsTo( int $pin ): int;
    public function processLetter1stPass( int $pin ): int;
    public function processLetter2ndPass( int $pin ): int;

}
```

## Full Representation
```php
class Rafalmasiarek\Enigma\EnigmaWiring
{

    // Properties
    private array $wiring;

    // Methods
    public function __construct( string $wiring );
    public function connect( int $pin1, int $pin2 ): void;
    public function connectsTo( int $pin ): int;
    public function processLetter1stPass( int $pin ): int;
    public function processLetter2ndPass( int $pin ): int;

}
```