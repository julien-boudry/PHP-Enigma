> JulienBoudry \ [RotorConfiguration](class_RotorConfiguration.md)
# Method get()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L138)

```php
public function RotorConfiguration->get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\Rotor\AbstractRotor
```

## Parameters

### **position:**
```php
JulienBoudry\Enigma\RotorPosition $position
```
**Type:** [`JulienBoudry\Enigma\RotorPosition`](../RotorPosition/enum_RotorPosition.md)

The position to get

## Return
**Type:** [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

The rotor at the given position

## Throws
- **[\InvalidArgumentException]()** _If no rotor is mounted at the given position_
