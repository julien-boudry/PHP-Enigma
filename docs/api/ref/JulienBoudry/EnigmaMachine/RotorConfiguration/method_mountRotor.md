> JulienBoudry \ [RotorConfiguration](class_RotorConfiguration.md)
# Method mountRotor()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorConfiguration.php#L184)

```php
public function RotorConfiguration->mountRotor( JulienBoudry\EnigmaMachine\RotorPosition $position, JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $rotor, [ JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A ] ): void
```

## Description
Mount a rotor at the given position, replacing any existing rotor.

## Parameters

### **position:**
```php
JulienBoudry\EnigmaMachine\RotorPosition $position
```
**Type:** [`JulienBoudry\EnigmaMachine\RotorPosition`](../RotorPosition/enum_RotorPosition.md)

The position to mount the rotor

### **rotor:**
```php
JulienBoudry\EnigmaMachine\RotorType|JulienBoudry\EnigmaMachine\Rotor\AbstractRotor $rotor
```
**Type:** [`JulienBoudry\EnigmaMachine\RotorType`](../RotorType/enum_RotorType.md) | [`JulienBoudry\EnigmaMachine\Rotor\AbstractRotor`](../Rotor/AbstractRotor/class_AbstractRotor.md)

The rotor to mount

### **ringstellung:**
```php
JulienBoudry\EnigmaMachine\Letter $ringstellung = \JulienBoudry\EnigmaMachine\Letter::A
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

The ring setting (only used if $rotor is RotorType)

## Return
**Type:** `void`



## Throws
- **[\JulienBoudry\EnigmaMachine\Exception\EnigmaConfigurationException](../Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md)** _If the rotor type is already used or incompatible with position (when strictMode is enabled)_
