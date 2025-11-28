> JulienBoudry \ **RotorConfiguration**
# Class RotorConfiguration
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L19)

## Description
This class encapsulates the collection of rotors and provides type-safe access
to rotors by their position. It accepts either RotorType enums (which will be
converted to AbstractRotor instances) or pre-configured AbstractRotor objects.
## Elements

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [strictMode(...)](property_strictMode.md) | _When true (default), validates that rotors are not duplicated and that Greek rotors are only in GREEK position. When false, bypasses these checks and allows any configuration._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | __ |
| [__construct(...)](method___construct.md) | _Each rotor can be specified as: - A RotorType enum (will be created with the corresponding ringstellung parameter) - An AbstractRotor instance (for pre-configured rotors, ringstellung parameter is ign..._ |
| [count(...)](method_count.md) | __ |
| [get(...)](method_get.md) | __ |
| [getGreek(...)](method_getGreek.md) | __ |
| [getIterator(...)](method_getIterator.md) | __ |
| [getP1(...)](method_getP1.md) | __ |
| [getP2(...)](method_getP2.md) | __ |
| [getP3(...)](method_getP3.md) | __ |
| [has(...)](method_has.md) | __ |
| [hasGreekRotor(...)](method_hasGreekRotor.md) | __ |
| [mountRotor(...)](method_mountRotor.md) | __ |
| [toArray(...)](method_toArray.md) | __ |
| [validateForModel(...)](method_validateForModel.md) | __ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\RotorConfiguration implements Countable, IteratorAggregate, Traversable
{

    // Properties
    public bool $strictMode;

    // Methods
    public function __clone( ): void;
    public function __construct( JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $p1, JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $p2, JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $p3, [ JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor|null $greek = null, JulienBoudry\EnigmaMachine\Letter $ringstellungP1 = \JulienBoudry\EnigmaMachine\Letter::A, JulienBoudry\EnigmaMachine\Letter $ringstellungP2 = \JulienBoudry\EnigmaMachine\Letter::A, JulienBoudry\EnigmaMachine\Letter $ringstellungP3 = \JulienBoudry\EnigmaMachine\Letter::A, JulienBoudry\EnigmaMachine\Letter $ringstellungGreek = \JulienBoudry\EnigmaMachine\Letter::A, bool $strictMode = true ] );
    public function count( ): int;
    public function get( JulienBoudry\EnigmaMachine\RotorPosition $position ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function getGreek( ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function getIterator( ): Traversable;
    public function getP1( ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function getP2( ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function getP3( ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function has( JulienBoudry\EnigmaMachine\RotorPosition $position ): bool;
    public function hasGreekRotor( ): bool;
    public function mountRotor( JulienBoudry\EnigmaMachine\RotorPosition $position, JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $rotor, [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] ): void;
    public function toArray( ): array;
    public function validateForModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): void;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\RotorConfiguration implements Countable, IteratorAggregate, Traversable
{

    // Properties
    public bool $strictMode;
    private array $rotors = [];

    // Methods
    public function __clone( ): void;
    public function __construct( JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $p1, JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $p2, JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $p3, [ JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor|null $greek = null, JulienBoudry\EnigmaMachine\Letter $ringstellungP1 = \JulienBoudry\EnigmaMachine\Letter::A, JulienBoudry\EnigmaMachine\Letter $ringstellungP2 = \JulienBoudry\EnigmaMachine\Letter::A, JulienBoudry\EnigmaMachine\Letter $ringstellungP3 = \JulienBoudry\EnigmaMachine\Letter::A, JulienBoudry\EnigmaMachine\Letter $ringstellungGreek = \JulienBoudry\EnigmaMachine\Letter::A, bool $strictMode = true ] );
    public function count( ): int;
    public function get( JulienBoudry\EnigmaMachine\RotorPosition $position ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function getGreek( ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function getIterator( ): Traversable;
    public function getP1( ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function getP2( ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function getP3( ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor;
    public function has( JulienBoudry\EnigmaMachine\RotorPosition $position ): bool;
    public function hasGreekRotor( ): bool;
    public function mountRotor( JulienBoudry\EnigmaMachine\RotorPosition $position, JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $rotor, [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] ): void;
    public function toArray( ): array;
    public function validateForModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): void;

}
```