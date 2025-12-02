> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **EnigmaSimulator**
# Class EnigmaSimulator
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Console/EnigmaSimulator.php#L12)
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |
| [simulate(...)](method_simulate.md) | _Simulate the encoding of text with visual animation._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\Console\EnigmaSimulator
{

    // Methods
    public function __construct( Symfony\Component\Console\Output\OutputInterface $output, JulienBoudry\EnigmaMachine\Enigma $enigma );
    public function simulate( string $text, [ int $delayMs = 250 ] ): string;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\Console\EnigmaSimulator
{

    // Properties
    private Symfony\Component\Console\Cursor $cursor;
    private JulienBoudry\EnigmaMachine\Enigma $enigma;
    private int $frameHeight = 0;
    private Symfony\Component\Console\Output\OutputInterface $output;

    // Methods
    public function __construct( Symfony\Component\Console\Output\OutputInterface $output, JulienBoudry\EnigmaMachine\Enigma $enigma );
    public function simulate( string $text, [ int $delayMs = 250 ] ): string;

}
```