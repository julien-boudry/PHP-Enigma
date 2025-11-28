> JulienBoudry \ [Enigma](class_Enigma.md)
# Method __construct()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L85)

```php
public function Enigma->__construct( JulienBoudry\EnigmaMachine\EnigmaModel $model, JulienBoudry\EnigmaMachine\RotorConfiguration $rotors, JulienBoudry\EnigmaMachine\ReflectorType $reflector, [ bool $strictMode = true ] )
```

## Description
Constructor sets up the plugboard and creates the rotors and reflectros available for the given model.

The initital rotors and reflectros are mounted.

## Parameters

### **model:**
```php
JulienBoudry\EnigmaMachine\EnigmaModel $model
```
**Type:** [`JulienBoudry\EnigmaMachine\EnigmaModel`](../EnigmaModel/enum_EnigmaModel.md)

ID for the model to emulate

### **rotors:**
```php
JulienBoudry\EnigmaMachine\RotorConfiguration $rotors
```
**Type:** [`JulienBoudry\EnigmaMachine\RotorConfiguration`](../RotorConfiguration/class_RotorConfiguration.md)

The rotor configuration

### **reflector:**
```php
JulienBoudry\EnigmaMachine\ReflectorType $reflector
```
**Type:** [`JulienBoudry\EnigmaMachine\ReflectorType`](../ReflectorType/enum_ReflectorType.md)

ID for the reflector for the initial setup

### **strictMode:**
```php
bool $strictMode = true
```
**Type:** `bool`

Whether to enforce compatibility checks (default: true)
