> JulienBoudry \ [RotorConfiguration](class_RotorConfiguration.md)
# Method __construct()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L43)

```php
public function RotorConfiguration->__construct( JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $right, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $middle, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $left, [ JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor|null $greek = null, JulienBoudry\Enigma\Letter $ringstellungRight = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungMiddle = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungLeft = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungGreek = \JulienBoudry\Enigma\Letter::A ] )
```

## Description
Each rotor can be specified as:
- A RotorType enum (will be created with the corresponding ringstellung parameter)
- An AbstractRotor instance (for pre-configured rotors, ringstellung parameter is ignored)

## Parameters

### **right:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $right
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

The right rotor (P1) - fastest rotating

### **middle:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $middle
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

The middle rotor (P2)

### **left:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $left
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

The left rotor (P3) - slowest rotating

### **greek:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor|null $greek = null
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md) | `?null`

The Greek rotor (P4) - only for M4 model, never rotates

### **ringstellungRight:**
```php
JulienBoudry\Enigma\Letter $ringstellungRight = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

The ring setting for the right rotor (only used if $right is RotorType)

### **ringstellungMiddle:**
```php
JulienBoudry\Enigma\Letter $ringstellungMiddle = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

The ring setting for the middle rotor (only used if $middle is RotorType)

### **ringstellungLeft:**
```php
JulienBoudry\Enigma\Letter $ringstellungLeft = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

The ring setting for the left rotor (only used if $left is RotorType)

### **ringstellungGreek:**
```php
JulienBoudry\Enigma\Letter $ringstellungGreek = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

The ring setting for the Greek rotor (only used if $greek is RotorType)
