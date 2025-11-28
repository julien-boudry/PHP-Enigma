> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **RotorTirpitzVII**
# Class RotorTirpitzVII
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Rotor/RotorTirpitzVII.php#L15)

## Description
Rotor VII for Enigma T (Tirpitz).

Used for German-Japanese military communications during WW2.
Has 5 notches at positions E, H, K, N, Q.
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [getCompatibleModels(...)](method_getCompatibleModels.md) | __ |
| [getNotches(...)](method_getNotches.md) | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [inUse(...)](../AbstractRotor/property_inUse.md) | _A rotor is in use or available._ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractRotor/method___clone.md) | _Deep clone the rotor._ |
| [__construct(...)](../AbstractRotor/method___construct.md) | _Constructor creates a new Wiring with the setup from the WIRING constant._ |
| [advance(...)](../AbstractRotor/method_advance.md) | _Advance the rotor by 1 step._ |
| [getPosition(...)](../AbstractRotor/method_getPosition.md) | _Retrieve current position of the rotor._ |
| [getRingstellung(...)](../AbstractRotor/method_getRingstellung.md) | _Retrieve current ringstellung (ring setting) of the rotor._ |
| [getType(...)](method_getType.md) | __ |
| [isCompatibleWithModel(...)](../AbstractRotor/method_isCompatibleWithModel.md) | _Check if this rotor is compatible with the given Enigma model._ |
| [isGreekRotor(...)](../AbstractRotor/method_isGreekRotor.md) | _Check if this rotor is a Greek rotor (BETA or GAMMA)._ |
| [isNotchOpen(...)](../AbstractRotor/method_isNotchOpen.md) | _A notch is open._ |
| [processLetter1stPass(...)](../AbstractRotor/method_processLetter1stPass.md) | _Send a letter from side A through the wiring to side B._ |
| [processLetter2ndPass(...)](../AbstractRotor/method_processLetter2ndPass.md) | _Send a letter from side B through the wiring to side A._ |
| [setPosition(...)](../AbstractRotor/method_setPosition.md) | _Set the rotor to a given position._ |
| [setRingstellung(...)](../AbstractRotor/method_setRingstellung.md) | _Sets the ringstellung to a given position._ |


## Public Representation
```php
final class JulienBoudry\EnigmaMachine\Rotor\RotorTirpitzVII extends JulienBoudry\EnigmaMachine\Rotor\AbstractRotor
{

    // Inherited Properties
    public bool AbstractRotor->inUse = false;

    // Static Methods
    public static function getCompatibleModels( ): array;
    public static function getNotches( ): array;

    // Methods
    public function getType( ): JulienBoudry\EnigmaMachine\RotorType;

    // Inherited Methods
    public function AbstractRotor->__clone( ): void;
    public function AbstractRotor->__construct( [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] );
    public function AbstractRotor->advance( ): void;
    public function AbstractRotor->getPosition( ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractRotor->getRingstellung( ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractRotor->isCompatibleWithModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): bool;
    public function AbstractRotor->isGreekRotor( ): bool;
    public function AbstractRotor->isNotchOpen( ): bool;
    public function AbstractRotor->processLetter1stPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractRotor->processLetter2ndPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractRotor->setPosition( JulienBoudry\EnigmaMachine\Letter $letter ): void;
    public function AbstractRotor->setRingstellung( JulienBoudry\EnigmaMachine\Letter $letter ): void;

}
```

## Full Representation
```php
final class JulienBoudry\EnigmaMachine\Rotor\RotorTirpitzVII extends JulienBoudry\EnigmaMachine\Rotor\AbstractRotor
{

    // Inherited Properties
    public bool AbstractRotor->inUse = false;

    // Static Methods
    public static function getCompatibleModels( ): array;
    public static function getNotches( ): array;
    protected static function getWiring( ): string;

    // Methods
    public function getType( ): JulienBoudry\EnigmaMachine\RotorType;

    // Inherited Methods
    public function AbstractRotor->__clone( ): void;
    public function AbstractRotor->__construct( [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] );
    public function AbstractRotor->advance( ): void;
    public function AbstractRotor->getPosition( ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractRotor->getRingstellung( ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractRotor->isCompatibleWithModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): bool;
    public function AbstractRotor->isGreekRotor( ): bool;
    public function AbstractRotor->isNotchOpen( ): bool;
    public function AbstractRotor->processLetter1stPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractRotor->processLetter2ndPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter;
    public function AbstractRotor->setPosition( JulienBoudry\EnigmaMachine\Letter $letter ): void;
    public function AbstractRotor->setRingstellung( JulienBoudry\EnigmaMachine\Letter $letter ): void;

}
```