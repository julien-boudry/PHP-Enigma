> JulienBoudry \ [RotorConfiguration](class_RotorConfiguration.md)
# Method mountRotor()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L184)

```php
public function RotorConfiguration->mountRotor( JulienBoudry\Enigma\RotorPosition $position, JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $rotor, [ JulienBoudry\Enigma\Letter $ringstellung = \JulienBoudry\Enigma\Letter::A ] ): void
```

## Parameters

### **position:**
```php
JulienBoudry\Enigma\RotorPosition $position
```
**Type:** [`JulienBoudry\Enigma\RotorPosition`](../RotorPosition/enum_RotorPosition.md)

The position to mount the rotor

### **rotor:**
```php
JulienBoudry\Enigma\RotorType|JulienBoudry\Enigma\Rotor\AbstractRotor $rotor
```
**Type:** [`JulienBoudry\Enigma\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\Enigma\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

The rotor to mount

### **ringstellung:**
```php
JulienBoudry\Enigma\Letter $ringstellung = \JulienBoudry\Enigma\Letter::A
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

The ring setting (only used if $rotor is RotorType)

## Return
**Type:** `void`



## Throws
- **[\JulienBoudry\Enigma\Exception\EnigmaConfigurationException](../Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md)** _If the rotor type is already used or incompatible with position (when strictMode is enabled)_
