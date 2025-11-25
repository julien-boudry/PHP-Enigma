> Rafalmasiarek \ **EnigmaPlugboard**
# Class EnigmaPlugboard
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaPlugboard.php#L35)
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |
| [plugLetters(...)](method_plugLetters.md) | __ |
| [processLetter(...)](method_processLetter.md) | _Because pins are connected in pairs, there is no difference if processLetter1stPass() or processLetter2ndPass() is used._ |
| [unplugLetters(...)](method_unplugLetters.md) | _Because letters are connected in pairs, we only need to know one of them._ |


## Public Representation
```php
class Rafalmasiarek\Enigma\EnigmaPlugboard
{

    // Methods
    public function __construct( );
    public function plugLetters( int $letter1, int $letter2 ): void;
    public function processLetter( int $letter ): int;
    public function unplugLetters( int $letter ): void;

}
```

## Full Representation
```php
class Rafalmasiarek\Enigma\EnigmaPlugboard
{

    // Properties
    private Rafalmasiarek\Enigma\EnigmaWiring $wiring;

    // Methods
    public function __construct( );
    public function plugLetters( int $letter1, int $letter2 ): void;
    public function processLetter( int $letter ): int;
    public function unplugLetters( int $letter ): void;

    // Methods
    public function __construct( );
    public function plugLetters( int $letter1, int $letter2 ): void;
    public function processLetter( int $letter ): int;
    public function unplugLetters( int $letter ): void;

}
```