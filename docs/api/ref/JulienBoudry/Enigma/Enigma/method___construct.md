> JulienBoudry \ [Enigma](class_Enigma.md)
# Method __construct()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L77)

```php
public function Enigma->__construct( JulienBoudry\Enigma\EnigmaModel $model, JulienBoudry\Enigma\RotorConfiguration $rotors, JulienBoudry\Enigma\ReflectorType $reflector, [ bool $strictMode = true ] )
```

## Description
The initital rotors and reflectros are mounted.

## Parameters

### **model:**
```php
JulienBoudry\Enigma\EnigmaModel $model
```
**Type:** [`JulienBoudry\Enigma\EnigmaModel`](../EnigmaModel/enum_EnigmaModel.md)

ID for the model to emulate

### **rotors:**
```php
JulienBoudry\Enigma\RotorConfiguration $rotors
```
**Type:** [`JulienBoudry\Enigma\RotorConfiguration`](../RotorConfiguration/class_RotorConfiguration.md)

The rotor configuration

### **reflector:**
```php
JulienBoudry\Enigma\ReflectorType $reflector
```
**Type:** [`JulienBoudry\Enigma\ReflectorType`](../ReflectorType/enum_ReflectorType.md)

ID for the reflector for the initial setup

### **strictMode:**
```php
bool $strictMode = true
```
**Type:** `bool`

Whether to enforce compatibility checks (default: true)
