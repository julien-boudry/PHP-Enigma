> Rafalmasiarek \ [Enigma](class_Enigma.md)
# Method mountRotor()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L206)

```php
public function Enigma->mountRotor( Rafalmasiarek\Enigma\RotorPosition|int $position, Rafalmasiarek\Enigma\RotorType $rotor ): void
```

## Description
A rotor may only be used in one position at a time, so if an rotor is already in use nothing is changed.
The previously used rotor will be replaced.

## Parameters

### **position:**
```php
Rafalmasiarek\Enigma\RotorPosition|int $position
```
**Type:** [`Rafalmasiarek\Enigma\RotorPosition`](../RotorPosition/enum_RotorPosition.md) | `int`

ID of the position to set the rotor

### **rotor:**
```php
Rafalmasiarek\Enigma\RotorType $rotor
```
**Type:** [`Rafalmasiarek\Enigma\RotorType`](../RotorType/enum_RotorType.md)

ID of the rotor to use

## Return
**Type:** `void`


