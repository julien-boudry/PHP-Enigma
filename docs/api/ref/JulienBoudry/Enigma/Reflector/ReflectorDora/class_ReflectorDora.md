> JulienBoudry \ [Enigma](../../readme.md) \ **ReflectorDora**
# Class ReflectorDora
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorDora.php#L25)

## Description
The UKW-D was a rewirable reflector introduced by the Wehrmacht/Luftwaffe in January 1944.
Unlike fixed reflectors (B, C), operators could configure their own wiring using plug cables.

The physical device had 12 plug cables connecting 24 sockets. The remaining 2 positions
(B and O in Bletchley Park notation) were occupied by spring-loaded balls holding the
inner core in place, creating a fixed B↔O pair on the physical device.

This software implementation allows full flexibility with 13 configurable pairs,
though the default wiring includes the historical B↔O pair.

The wiring was typically changed every 10 days as per the key sheets.
This reflector was compatible with 3-rotor Enigma models (Wehrmacht/Luftwaffe).
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [fromString(...)](method_fromString.md) | __ |
| [withDefaultWiring(...)](method_withDefaultWiring.md) | _This uses a historically plausible configuration including the B↔O pair which was fixed on the physical device due to mechanical constraints._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractReflector/method___clone.md) | __ |
| [__construct(...)](method___construct.md) | __ |
| [processLetter(...)](../AbstractReflector/method_processLetter.md) | _Because pins are connected in pairs, there is no difference if processLetter1stPass() or processLetter2ndPass() is used._ |


## Public Representation
```php
final class JulienBoudry\Enigma\Reflector\ReflectorDora extends JulienBoudry\Enigma\Reflector\AbstractReflector
{

    // Static Methods
    public static function fromString( string $pairsString ): JulienBoudry\Enigma\Reflector\ReflectorDora;
    public static function withDefaultWiring( ): JulienBoudry\Enigma\Reflector\ReflectorDora;

    // Methods
    public function __construct( array $pairs );

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```

## Full Representation
```php
final class JulienBoudry\Enigma\Reflector\ReflectorDora extends JulienBoudry\Enigma\Reflector\AbstractReflector
{

    // Properties
    private string $customWiring;

    // Static Methods
    public static function fromString( string $pairsString ): JulienBoudry\Enigma\Reflector\ReflectorDora;
    public static function withDefaultWiring( ): JulienBoudry\Enigma\Reflector\ReflectorDora;

    // Methods
    public function __construct( array $pairs );

    // Inherited Methods
    public function AbstractReflector->__clone( ): void;
    public function AbstractReflector->processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter;

}
```