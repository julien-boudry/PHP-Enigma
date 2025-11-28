> JulienBoudry \ **RotorConfiguration**
# Class RotorConfiguration
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L19)

## Description
Represents the configuration of rotors for an Enigma machine.

This class encapsulates the collection of rotors and provides type-safe access
to rotors by their position. It accepts either RotorType enums (which will be
converted to AbstractRotor instances) or pre-configured AbstractRotor objects.
## Elements

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [strictMode(...)](property_strictMode.md) | _Whether to enforce configuration checks._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](method___clone.md) | _Deep clone all rotors._ |
| [__construct(...)](method___construct.md) | _Creates a new rotor configuration._ |
| [count(...)](method_count.md) | _Get the number of mounted rotors._ |
| [get(...)](method_get.md) | _Get a rotor by its position._ |
| [getGreek(...)](method_getGreek.md) | _Get the Greek rotor (M4 only, never rotates)._ |
| [getIterator(...)](method_getIterator.md) | _Iterate over the rotors in order (P1, P2, P3, [GREEK])._ |
| [getP1(...)](method_getP1.md) | _Get the P1 rotor (rightmost, fastest rotating)._ |
| [getP2(...)](method_getP2.md) | _Get the P2 rotor (middle)._ |
| [getP3(...)](method_getP3.md) | _Get the P3 rotor (leftmost in 3-rotor models)._ |
| [has(...)](method_has.md) | _Check if a rotor is mounted at the given position._ |
| [hasGreekRotor(...)](method_hasGreekRotor.md) | _Check if a Greek rotor is configured (M4 model)._ |
| [mountRotor(...)](method_mountRotor.md) | _Mount a rotor at the given position, replacing any existing rotor._ |
| [toArray(...)](method_toArray.md) | _Get all rotors as an array indexed by position value._ |
| [validateForModel(...)](method_validateForModel.md) | _Validate that the configuration is complete for the given model._ |


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