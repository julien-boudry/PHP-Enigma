> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **RotorI**
# Class RotorI
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Rotor/RotorI.php#L14)

## Description
Notch at position Q (turnover at R).
## Elements

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [getCompatibleModels(...)](method_getCompatibleModels.md) | __ |
| [getNotches(...)](method_getNotches.md) | __ |

### Public Properties
| Property Name | Description |
| ------------- | ------------- |
| [inUse(...)](../AbstractRotor/property_inUse.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__clone(...)](../AbstractRotor/method___clone.md) | __ |
| [__construct(...)](../AbstractRotor/method___construct.md) | __ |
| [advance(...)](../AbstractRotor/method_advance.md) | _When position reaches Letter::count(), it is reset to 0._ |
| [getPosition(...)](../AbstractRotor/method_getPosition.md) | __ |
| [getRingstellung(...)](../AbstractRotor/method_getRingstellung.md) | __ |
| [getType(...)](method_getType.md) | __ |
| [isCompatibleWithModel(...)](../AbstractRotor/method_isCompatibleWithModel.md) | __ |
| [isGreekRotor(...)](../AbstractRotor/method_isGreekRotor.md) | __ |
| [isNotchOpen(...)](../AbstractRotor/method_isNotchOpen.md) | _Returns true if the rotor is in a turnover position for the next rotor._ |
| [processLetter1stPass(...)](../AbstractRotor/method_processLetter1stPass.md) | _To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account. + Letter::count() and % Letter::count() keep the value positive and in b..._ |
| [processLetter2ndPass(...)](../AbstractRotor/method_processLetter2ndPass.md) | _To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account. + Letter::count() and % Letter::count() keep the value positive and in b..._ |
| [setPosition(...)](../AbstractRotor/method_setPosition.md) | __ |
| [setRingstellung(...)](../AbstractRotor/method_setRingstellung.md) | __ |


## Public Representation
```php
final class JulienBoudry\EnigmaMachine\Rotor\RotorI extends JulienBoudry\EnigmaMachine\Rotor\AbstractRotor
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
final class JulienBoudry\EnigmaMachine\Rotor\RotorI extends JulienBoudry\EnigmaMachine\Rotor\AbstractRotor
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