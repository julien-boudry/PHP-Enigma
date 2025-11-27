> JulienBoudry \ [Enigma](class_Enigma.md)
# Method __construct()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L125)

```php
public function Enigma->__construct( JulienBoudry\Enigma\EnigmaModel $model, array $rotors, JulienBoudry\Enigma\ReflectorType $reflector )
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
array $rotors
```
**Type:** `array`



### **reflector:**
```php
JulienBoudry\Enigma\ReflectorType $reflector
```
**Type:** [`JulienBoudry\Enigma\ReflectorType`](../ReflectorType/enum_ReflectorType.md)

ID for the reflector for the initial setup
