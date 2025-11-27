> JulienBoudry \ **RotorSelection**
# Class RotorSelection
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorSelection.php#L16)

## Description
This class encapsulates the choice of which rotors to use in each position
before they are actually mounted in the machine. It provides type-safe
access to rotor types by their position.
## Elements

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [greek(...)](property_greek.md) | __ |
| [left(...)](property_left.md) | __ |
| [middle(...)](property_middle.md) | __ |
| [right(...)](property_right.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |
| [count(...)](method_count.md) | __ |
| [get(...)](method_get.md) | __ |
| [getIterator(...)](method_getIterator.md) | __ |
| [has(...)](method_has.md) | __ |
| [hasGreekRotor(...)](method_hasGreekRotor.md) | __ |
| [validateForModel(...)](method_validateForModel.md) | __ |


## Public Representation
```php
readonly class JulienBoudry\Enigma\RotorSelection implements Countable, IteratorAggregate, Traversable
{

    // Properties
    public protected(set) readonly protected(set) ?JulienBoudry\Enigma\RotorType $greek;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\RotorType $left;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\RotorType $middle;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\RotorType $right;

    // Methods
    public function __construct( JulienBoudry\Enigma\RotorType $right, JulienBoudry\Enigma\RotorType $middle, JulienBoudry\Enigma\RotorType $left, [ ?JulienBoudry\Enigma\RotorType $greek = null ] );
    public function count( ): int;
    public function get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\RotorType;
    public function getIterator( ): Traversable;
    public function has( JulienBoudry\Enigma\RotorPosition $position ): bool;
    public function hasGreekRotor( ): bool;
    public function validateForModel( JulienBoudry\Enigma\EnigmaModel $model ): void;

}
```

## Full Representation
```php
readonly class JulienBoudry\Enigma\RotorSelection implements Countable, IteratorAggregate, Traversable
{

    // Properties
    public protected(set) readonly protected(set) ?JulienBoudry\Enigma\RotorType $greek;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\RotorType $left;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\RotorType $middle;
    public protected(set) readonly protected(set) JulienBoudry\Enigma\RotorType $right;

    // Methods
    public function __construct( JulienBoudry\Enigma\RotorType $right, JulienBoudry\Enigma\RotorType $middle, JulienBoudry\Enigma\RotorType $left, [ ?JulienBoudry\Enigma\RotorType $greek = null ] );
    public function count( ): int;
    public function get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\RotorType;
    public function getIterator( ): Traversable;
    public function has( JulienBoudry\Enigma\RotorPosition $position ): bool;
    public function hasGreekRotor( ): bool;
    public function validateForModel( JulienBoudry\Enigma\EnigmaModel $model ): void;

}
```