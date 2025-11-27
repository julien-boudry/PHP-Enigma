> JulienBoudry \ [Enigma](class_Enigma.md)
# Method mountRotor()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L146)

```php
public function Enigma->mountRotor( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\RotorType $rotor ): void
```

## Description
A rotor may only be used in one position at a time, so if an rotor is already in use nothing is changed.
The previously used rotor will be replaced.

## Parameters

### **position:**
```php
JulienBoudry\Enigma\RotorPosition $position
```
**Type:** [`JulienBoudry\Enigma\RotorPosition`](../RotorPosition/enum_RotorPosition.md)

ID of the position to set the rotor

### **rotor:**
```php
JulienBoudry\Enigma\RotorType $rotor
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md)

ID of the rotor to use

## Return
**Type:** `void`


