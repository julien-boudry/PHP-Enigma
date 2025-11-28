> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **ReflectorDora**
# Class ReflectorDora
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorDora.php#L36)

## Description
UKW-D (Umkehrwalze Dora) - Rewirable Reflector.

The UKW-D was a rewirable reflector introduced by the Wehrmacht/Luftwaffe in January 1944.
Unlike fixed reflectors (B, C), operators could configure their own wiring using plug cables.

The physical device had 12 plug cables connecting 24 sockets. The remaining 2 positions
(B and O in Bletchley Park notation, or J and Y) were occupied by spring-loaded balls holding the
inner core in place, creating a fixed B↔O (or J↔Y) pair on the physical device.

Mapping between Bletchley Park (BP) notation and German (DE) index ring:
BP: A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
DE: A - Z X W V U T S R Q P O N - M L K I H G F E D C B

In BP notation (standard A-Z), the fixed pair is B↔O.
In German notation, the letters J and Y are omitted from the ring, and the
physical gaps (marked '-') correspond to the fixed connections.

This software implementation allows full flexibility with 13 configurable pairs,
though the default wiring includes the historical B↔O pair.

The wiring was typically changed every 10 days as per the key sheets.
This reflector was compatible with 3-rotor Enigma models (Wehrmacht/Luftwaffe).
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [fromString(...)](method_fromString.md) | _Create a ReflectorDora from a simple string of pairs._ |
| [withDefaultWiring(...)](method_withDefaultWiring.md) | _Get a default wiring configuration._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractReflector/method___clone.md) | _Deep clone the reflector._ |
| [__construct(...)](method___construct.md) | _Create a UKW-D reflector with custom wiring._ |
| [getType(...)](method_getType.md) | _Get the reflector type._ |
| [getWiringPairs(...)](method_getWiringPairs.md) | _Get the wiring pairs as an array of Letter tuples._ |
| [processLetter(...)](../AbstractReflector/method_processLetter.md) | _Send a letter through the wiring._ |


## Public Representation
```php
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorDora extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Static Methods
    public static function fromString( string $pairsString ): self;
    public static function withDefaultWiring( ): self;

    // Methods
    public function __construct( array $pairs );
    public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;
    public function getWiringPairs( ): array;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```

## Full Representation
```php
final class JulienBoudry\EnigmaMachine\Reflector\ReflectorDora extends JulienBoudry\EnigmaMachine\Reflector\AbstractReflector
{

    // Properties
    private string $customWiring;

    // Static Methods
    public static function fromString( string $pairsString ): self;
    public static function withDefaultWiring( ): self;

    // Methods
    public function __construct( array $pairs );
    public function getType( ): JulienBoudry\EnigmaMachine\ReflectorType;
    public function getWiringPairs( ): array;

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;

}
```