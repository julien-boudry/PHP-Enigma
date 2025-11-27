> JulienBoudry \ **RotorConfiguration**
# Class RotorConfiguration
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L16)

## Description
This class encapsulates the collection of rotors and provides type-safe access
to rotors by their position. It also validates that the correct number of rotors
is configured for the given Enigma model.
## Elements

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | __ |
| [count(...)](method_count.md) | __ |
| [get(...)](method_get.md) | __ |
| [getGreek(...)](method_getGreek.md) | __ |
| [getIterator(...)](method_getIterator.md) | __ |
| [getLeft(...)](method_getLeft.md) | __ |
| [getMiddle(...)](method_getMiddle.md) | __ |
| [getRight(...)](method_getRight.md) | __ |
| [has(...)](method_has.md) | __ |
| [hasGreekRotor(...)](method_hasGreekRotor.md) | __ |
| [set(...)](method_set.md) | __ |
| [toArray(...)](method_toArray.md) | __ |
| [validateForModel(...)](method_validateForModel.md) | __ |
| [withRotor(...)](method_withRotor.md) | __ |


## Public Representation
```php
class JulienBoudry\Enigma\RotorConfiguration implements Countable, IteratorAggregate, Traversable
{

    // Methods
    public function __clone( ): void;
    public function __construct( [ ?JulienBoudry\Enigma\EnigmaRotor $right = null, ?JulienBoudry\Enigma\EnigmaRotor $middle = null, ?JulienBoudry\Enigma\EnigmaRotor $left = null, ?JulienBoudry\Enigma\EnigmaRotor $greek = null ] );
    public function count( ): int;
    public function get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\EnigmaRotor;
    public function getGreek( ): JulienBoudry\Enigma\EnigmaRotor;
    public function getIterator( ): Traversable;
    public function getLeft( ): JulienBoudry\Enigma\EnigmaRotor;
    public function getMiddle( ): JulienBoudry\Enigma\EnigmaRotor;
    public function getRight( ): JulienBoudry\Enigma\EnigmaRotor;
    public function has( JulienBoudry\Enigma\RotorPosition $position ): bool;
    public function hasGreekRotor( ): bool;
    public function set( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\EnigmaRotor $rotor ): void;
    public function toArray( ): array;
    public function validateForModel( JulienBoudry\Enigma\EnigmaModel $model ): void;
    public function withRotor( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\EnigmaRotor $rotor ): JulienBoudry\Enigma\RotorConfiguration;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\RotorConfiguration implements Countable, IteratorAggregate, Traversable
{

    // Properties
    private ?JulienBoudry\Enigma\EnigmaRotor $greek;
    private ?JulienBoudry\Enigma\EnigmaRotor $left;
    private ?JulienBoudry\Enigma\EnigmaRotor $middle;
    private ?JulienBoudry\Enigma\EnigmaRotor $right;
    private array $rotors = [];

    // Methods
    public function __clone( ): void;
    public function __construct( [ ?JulienBoudry\Enigma\EnigmaRotor $right = null, ?JulienBoudry\Enigma\EnigmaRotor $middle = null, ?JulienBoudry\Enigma\EnigmaRotor $left = null, ?JulienBoudry\Enigma\EnigmaRotor $greek = null ] );
    public function count( ): int;
    public function get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\EnigmaRotor;
    public function getGreek( ): JulienBoudry\Enigma\EnigmaRotor;
    public function getIterator( ): Traversable;
    public function getLeft( ): JulienBoudry\Enigma\EnigmaRotor;
    public function getMiddle( ): JulienBoudry\Enigma\EnigmaRotor;
    public function getRight( ): JulienBoudry\Enigma\EnigmaRotor;
    public function has( JulienBoudry\Enigma\RotorPosition $position ): bool;
    public function hasGreekRotor( ): bool;
    public function set( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\EnigmaRotor $rotor ): void;
    public function toArray( ): array;
    public function validateForModel( JulienBoudry\Enigma\EnigmaModel $model ): void;
    public function withRotor( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\EnigmaRotor $rotor ): JulienBoudry\Enigma\RotorConfiguration;

}
```