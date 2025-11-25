> Rafalmasiarek \ **Enigma**
# Class Enigma
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L22)

## Description
3 different models can be emulated with this class, each one has its own set of rotors and reflectors to be used with.
Depending on the model, 3 or 4 rotors are mounted, only the first three of them can be triggered by the advance mechanism.
A letter is encoded by sending its corresponding signal through the plugboard, rotor 1..3(4), the reflector,
rotor 3(4)..1 and the plugboard again.
After each encoded letter, the advance mechanism changes the internal setup by rotating the rotors.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| KEY_A | `public const KEY_A = 0` | __ |
| KEY_B | `public const KEY_B = 1` | __ |
| KEY_C | `public const KEY_C = 2` | __ |
| KEY_D | `public const KEY_D = 3` | __ |
| KEY_E | `public const KEY_E = 4` | __ |
| KEY_F | `public const KEY_F = 5` | __ |
| KEY_G | `public const KEY_G = 6` | __ |
| KEY_H | `public const KEY_H = 7` | __ |
| KEY_I | `public const KEY_I = 8` | __ |
| KEY_J | `public const KEY_J = 9` | __ |
| KEY_K | `public const KEY_K = 10` | __ |
| KEY_L | `public const KEY_L = 11` | __ |
| KEY_M | `public const KEY_M = 12` | __ |
| KEY_N | `public const KEY_N = 13` | __ |
| KEY_O | `public const KEY_O = 14` | __ |
| KEY_P | `public const KEY_P = 15` | __ |
| KEY_Q | `public const KEY_Q = 16` | __ |
| KEY_R | `public const KEY_R = 17` | __ |
| KEY_S | `public const KEY_S = 18` | __ |
| KEY_T | `public const KEY_T = 19` | __ |
| KEY_U | `public const KEY_U = 20` | __ |
| KEY_V | `public const KEY_V = 21` | __ |
| KEY_W | `public const KEY_W = 22` | __ |
| KEY_X | `public const KEY_X = 23` | __ |
| KEY_Y | `public const KEY_Y = 24` | __ |
| KEY_Z | `public const KEY_Z = 25` | __ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [enigma_l2p(...)](method_enigma_l2p.md) | __ |
| [enigma_p2l(...)](method_enigma_p2l.md) | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | _The initital rotors and reflectros are mounted._ |
| [encodeLetter(...)](method_encodeLetter.md) | _The letter passes the plugboard, the rotors, the reflector, the rotors in the opposite direction and again the plugboard. Every encoding triggers the advancemechanism._ |
| [getPosition(...)](method_getPosition.md) | __ |
| [mountReflector(...)](method_mountReflector.md) | _The previously used reflector will be replaced._ |
| [mountRotor(...)](method_mountRotor.md) | _A rotor may only be used in one position at a time, so if an rotor is already in use nothing is changed. The previously used rotor will be replaced._ |
| [plugLetters(...)](method_plugLetters.md) | _The letter are transformed to integer first_ |
| [setPosition(...)](method_setPosition.md) | __ |
| [setRingstellung(...)](method_setRingstellung.md) | __ |
| [unplugLetters(...)](method_unplugLetters.md) | _Because letters are connected in pairs, we only need to know one of them._ |


## Public Representation
```php
class Rafalmasiarek\Enigma\Enigma
{
    // Constants
    public const KEY_A = 0;
    public const KEY_B = 1;
    public const KEY_C = 2;
    public const KEY_D = 3;
    public const KEY_E = 4;
    public const KEY_F = 5;
    public const KEY_G = 6;
    public const KEY_H = 7;
    public const KEY_I = 8;
    public const KEY_J = 9;
    public const KEY_K = 10;
    public const KEY_L = 11;
    public const KEY_M = 12;
    public const KEY_N = 13;
    public const KEY_O = 14;
    public const KEY_P = 15;
    public const KEY_Q = 16;
    public const KEY_R = 17;
    public const KEY_S = 18;
    public const KEY_T = 19;
    public const KEY_U = 20;
    public const KEY_V = 21;
    public const KEY_W = 22;
    public const KEY_X = 23;
    public const KEY_Y = 24;
    public const KEY_Z = 25;

    // Methods
    public static function enigma_l2p( string $l ): int;
    public static function enigma_p2l( int $p ): string;

    // Methods
    public function __construct( Rafalmasiarek\Enigma\EnigmaModel $model, array $rotors, Rafalmasiarek\Enigma\ReflectorType $reflector );
    public function encodeLetter( string $letter ): string;
    public function getPosition( Rafalmasiarek\Enigma\RotorPosition|int $position ): string;
    public function mountReflector( Rafalmasiarek\Enigma\ReflectorType $reflector ): void;
    public function mountRotor( Rafalmasiarek\Enigma\RotorPosition|int $position, Rafalmasiarek\Enigma\RotorType $rotor ): void;
    public function plugLetters( string $letter1, string $letter2 ): void;
    public function setPosition( Rafalmasiarek\Enigma\RotorPosition $position, string $letter ): void;
    public function setRingstellung( Rafalmasiarek\Enigma\RotorPosition|int $position, string $letter ): void;
    public function unplugLetters( string $letter ): void;

}
```

## Full Representation
```php
class Rafalmasiarek\Enigma\Enigma
{
    // Constants
    public const KEY_A = 0;
    public const KEY_B = 1;
    public const KEY_C = 2;
    public const KEY_D = 3;
    public const KEY_E = 4;
    public const KEY_F = 5;
    public const KEY_G = 6;
    public const KEY_H = 7;
    public const KEY_I = 8;
    public const KEY_J = 9;
    public const KEY_K = 10;
    public const KEY_L = 11;
    public const KEY_M = 12;
    public const KEY_N = 13;
    public const KEY_O = 14;
    public const KEY_P = 15;
    public const KEY_Q = 16;
    public const KEY_R = 17;
    public const KEY_S = 18;
    public const KEY_T = 19;
    public const KEY_U = 20;
    public const KEY_V = 21;
    public const KEY_W = 22;
    public const KEY_X = 23;
    public const KEY_Y = 24;
    public const KEY_Z = 25;

    // Properties
    private array $availablereflectors;
    private array $availablerotors;
    private Rafalmasiarek\Enigma\EnigmaPlugboard $plugboard;
    private Rafalmasiarek\Enigma\EnigmaReflector $reflector;
    private array $rotors;

    // Methods
    public function __construct( Rafalmasiarek\Enigma\EnigmaModel $model, array $rotors, Rafalmasiarek\Enigma\ReflectorType $reflector );
    public function encodeLetter( string $letter ): string;
    public static function enigma_l2p( string $l ): int;
    public static function enigma_p2l( int $p ): string;
    public function getPosition( Rafalmasiarek\Enigma\RotorPosition|int $position ): string;
    public function mountReflector( Rafalmasiarek\Enigma\ReflectorType $reflector ): void;
    public function mountRotor( Rafalmasiarek\Enigma\RotorPosition|int $position, Rafalmasiarek\Enigma\RotorType $rotor ): void;
    public function plugLetters( string $letter1, string $letter2 ): void;
    public function setPosition( Rafalmasiarek\Enigma\RotorPosition $position, string $letter ): void;
    public function setRingstellung( Rafalmasiarek\Enigma\RotorPosition|int $position, string $letter ): void;
    public function unplugLetters( string $letter ): void;
    private function advance( ): void;

    // Methods
    public function __construct( Rafalmasiarek\Enigma\EnigmaModel $model, array $rotors, Rafalmasiarek\Enigma\ReflectorType $reflector );
    public function encodeLetter( string $letter ): string;
    public function getPosition( Rafalmasiarek\Enigma\RotorPosition|int $position ): string;
    public function mountReflector( Rafalmasiarek\Enigma\ReflectorType $reflector ): void;
    public function mountRotor( Rafalmasiarek\Enigma\RotorPosition|int $position, Rafalmasiarek\Enigma\RotorType $rotor ): void;
    public function plugLetters( string $letter1, string $letter2 ): void;
    public function setPosition( Rafalmasiarek\Enigma\RotorPosition $position, string $letter ): void;
    public function setRingstellung( Rafalmasiarek\Enigma\RotorPosition|int $position, string $letter ): void;
    public function unplugLetters( string $letter ): void;

}
```