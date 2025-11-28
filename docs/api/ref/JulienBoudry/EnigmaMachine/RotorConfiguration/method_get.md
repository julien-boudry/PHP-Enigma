> JulienBoudry \ [RotorConfiguration](class_RotorConfiguration.md)
# Method get()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L154)

```php
public function RotorConfiguration->get( JulienBoudry\EnigmaMachine\RotorPosition $position ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor
```

## Description
Get a rotor by its position.

## Parameters

### **position:**
```php
JulienBoudry\EnigmaMachine\RotorPosition $position
```
**Type:** [`JulienBoudry\EnigmaMachine\RotorPosition`](../RotorPosition/enum_RotorPosition.md)

The position to get

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

The rotor at the given position

## Throws
- **[\InvalidArgumentException]()** _If no rotor is mounted at the given position_
