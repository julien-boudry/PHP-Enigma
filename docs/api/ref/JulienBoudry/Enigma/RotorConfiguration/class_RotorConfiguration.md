> JulienBoudry \ **RotorConfiguration**
# Class RotorConfiguration
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L18)

## Description
This class encapsulates the collection of rotors and provides type-safe access
to rotors by their position. It accepts either RotorType enums (which will be
converted to AbstractRotor instances) or pre-configured AbstractRotor objects.
## Elements

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
class JulienBoudry\Enigma\RotorConfiguration implements Countable, IteratorAggregate, Traversable
{

    // Methods
    public function __clone( ): void;
    public function __construct( JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p1, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p2, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p3, [ JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor|null $greek = null, JulienBoudry\Enigma\Letter $ringstellungP1 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungP2 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungP3 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungGreek = \JulienBoudry\Enigma\Letter::A ] );
    public function count( ): int;
    public function get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function getGreek( ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function getIterator( ): Traversable;
    public function getP1( ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function getP2( ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function getP3( ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function has( JulienBoudry\Enigma\RotorPosition $position ): bool;
    public function hasGreekRotor( ): bool;
    public function mountRotor( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $rotor, [ JulienBoudry\Enigma\Letter $ringstellung = \JulienBoudry\Enigma\Letter::A ] ): void;
    public function toArray( ): array;
    public function validateForModel( JulienBoudry\Enigma\EnigmaModel $model ): void;

}
```

## Full Representation
```php
class JulienBoudry\Enigma\RotorConfiguration implements Countable, IteratorAggregate, Traversable
{

    // Properties
    private array $rotors = [];

    // Methods
    public function __clone( ): void;
    public function __construct( JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p1, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p2, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p3, [ JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor|null $greek = null, JulienBoudry\Enigma\Letter $ringstellungP1 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungP2 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungP3 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungGreek = \JulienBoudry\Enigma\Letter::A ] );
    public function count( ): int;
    public function get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function getGreek( ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function getIterator( ): Traversable;
    public function getP1( ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function getP2( ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function getP3( ): JulienBoudry\Enigma\Rotor\AbstractRotor;
    public function has( JulienBoudry\Enigma\RotorPosition $position ): bool;
    public function hasGreekRotor( ): bool;
    public function mountRotor( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $rotor, [ JulienBoudry\Enigma\Letter $ringstellung = \JulienBoudry\Enigma\Letter::A ] ): void;
    public function toArray( ): array;
    public function validateForModel( JulienBoudry\Enigma\EnigmaModel $model ): void;

}
```