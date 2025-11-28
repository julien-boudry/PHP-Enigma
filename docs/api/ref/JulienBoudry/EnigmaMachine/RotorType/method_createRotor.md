> JulienBoudry \ [RotorType](enum_RotorType.md)
# Method createRotor()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorType.php#L184)

```php
public function RotorType->createRotor( [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] ): JulienBoudry\EnigmaMachine\Rotor\AbstractRotor
```

## Description
Create a rotor instance for this type.

## Parameters

### **ringstellung:**
```php
JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

The ring setting (default: A)

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

The rotor instance
