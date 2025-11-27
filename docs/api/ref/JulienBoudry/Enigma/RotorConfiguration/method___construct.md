> JulienBoudry \ [RotorConfiguration](class_RotorConfiguration.md)
# Method __construct()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L33)

```php
public function RotorConfiguration->__construct( [ ?JulienBoudry\Enigma\EnigmaRotor $right = null, ?JulienBoudry\Enigma\EnigmaRotor $middle = null, ?JulienBoudry\Enigma\EnigmaRotor $left = null, ?JulienBoudry\Enigma\EnigmaRotor $greek = null ] )
```

## Parameters

### **right:**
```php
?JulienBoudry\Enigma\EnigmaRotor $right = null
```
**Type:** [`?JulienBoudry\Enigma\EnigmaRotor`](../EnigmaRotor/class_EnigmaRotor.md)

The right rotor (P1) - fastest rotating

### **middle:**
```php
?JulienBoudry\Enigma\EnigmaRotor $middle = null
```
**Type:** [`?JulienBoudry\Enigma\EnigmaRotor`](../EnigmaRotor/class_EnigmaRotor.md)

The middle rotor (P2)

### **left:**
```php
?JulienBoudry\Enigma\EnigmaRotor $left = null
```
**Type:** [`?JulienBoudry\Enigma\EnigmaRotor`](../EnigmaRotor/class_EnigmaRotor.md)

The left rotor (P3) - slowest rotating

### **greek:**
```php
?JulienBoudry\Enigma\EnigmaRotor $greek = null
```
**Type:** [`?JulienBoudry\Enigma\EnigmaRotor`](../EnigmaRotor/class_EnigmaRotor.md)

The Greek rotor (P4) - only for M4 model, never rotates
