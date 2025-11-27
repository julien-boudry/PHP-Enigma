> JulienBoudry \ [RotorConfiguration](class_RotorConfiguration.md)
# Method get()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L62)

```php
public function RotorConfiguration->get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\EnigmaRotor
```

## Parameters

### **position:**
```php
JulienBoudry\Enigma\RotorPosition $position
```
**Type:** [`JulienBoudry\Enigma\RotorPosition`](../RotorPosition/enum_RotorPosition.md)

The position to get

## Return
**Type:** [`JulienBoudry\Enigma\EnigmaRotor`](../EnigmaRotor/class_EnigmaRotor.md)

The rotor at the given position

## Throws
- **[\InvalidArgumentException]()** _If no rotor is mounted at the given position_
