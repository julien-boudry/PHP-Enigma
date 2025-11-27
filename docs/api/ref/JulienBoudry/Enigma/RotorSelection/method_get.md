> JulienBoudry \ [RotorSelection](class_RotorSelection.md)
# Method get()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorSelection.php#L42)

```php
public function RotorSelection->get( JulienBoudry\Enigma\RotorPosition $position ): JulienBoudry\Enigma\RotorType
```

## Parameters

### **position:**
```php
JulienBoudry\Enigma\RotorPosition $position
```
**Type:** [`JulienBoudry\Enigma\RotorPosition`](../RotorPosition/enum_RotorPosition.md)

The position to get

## Return
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md)

The rotor type at the given position

## Throws
- **[\InvalidArgumentException]()** _If no rotor is selected for the given position_
