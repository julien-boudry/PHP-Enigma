> JulienBoudry \ [RotorConfiguration](class_RotorConfiguration.md)
# Method __construct()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L54)

```php
public function RotorConfiguration->__construct( JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p1, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p2, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p3, [ JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor|null $greek = null, JulienBoudry\Enigma\Letter $ringstellungP1 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungP2 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungP3 = \JulienBoudry\Enigma\Letter::A, JulienBoudry\Enigma\Letter $ringstellungGreek = \JulienBoudry\Enigma\Letter::A, bool $strictMode = true ] )
```

## Description
Each rotor can be specified as:
- A RotorType enum (will be created with the corresponding ringstellung parameter)
- An AbstractRotor instance (for pre-configured rotors, ringstellung parameter is ignored)

## Parameters

### **p1:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p1
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

Position 1 rotor (rightmost, fastest rotating)

### **p2:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p2
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

Position 2 rotor (middle)

### **p3:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $p3
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

Position 3 rotor (leftmost in 3-rotor models)

### **greek:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor|null $greek = null
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md) | `?null`

Greek position rotor (M4 only, never rotates)

### **ringstellungP1:**
```php
JulienBoudry\Enigma\Letter $ringstellungP1 = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

Ring setting for P1 rotor (only used if $p1 is RotorType)

### **ringstellungP2:**
```php
JulienBoudry\Enigma\Letter $ringstellungP2 = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

Ring setting for P2 rotor (only used if $p2 is RotorType)

### **ringstellungP3:**
```php
JulienBoudry\Enigma\Letter $ringstellungP3 = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

Ring setting for P3 rotor (only used if $p3 is RotorType)

### **ringstellungGreek:**
```php
JulienBoudry\Enigma\Letter $ringstellungGreek = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

Ring setting for Greek rotor (only used if $greek is RotorType)

### **strictMode:**
```php
bool $strictMode = true
```
**Type:** `bool`

Whether to enforce configuration checks (default: true)
