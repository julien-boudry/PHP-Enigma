> JulienBoudry \ [RotorSelection](class_RotorSelection.md)
# Method __construct()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorSelection.php#L26)

```php
public function RotorSelection->__construct( JulienBoudry\Enigma\RotorType $right, JulienBoudry\Enigma\RotorType $middle, JulienBoudry\Enigma\RotorType $left, [ ?JulienBoudry\Enigma\RotorType $greek = null ] )
```

## Parameters

### **right:**
```php
JulienBoudry\Enigma\RotorType $right
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md)

The right rotor type (P1) - fastest rotating

### **middle:**
```php
JulienBoudry\Enigma\RotorType $middle
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md)

The middle rotor type (P2)

### **left:**
```php
JulienBoudry\Enigma\RotorType $left
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md)

The left rotor type (P3) - slowest rotating

### **greek:**
```php
?JulienBoudry\Enigma\RotorType $greek = null
```
**Type:** [`?JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md)

The Greek rotor type (P4) - only for M4 model, never rotates
