> JulienBoudry \ [EnigmaConfiguration](class_EnigmaConfiguration.md)
# Method __construct()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaConfiguration.php#L27)

```php
public function EnigmaConfiguration->__construct( JulienBoudry\EnigmaMachine\EnigmaModel $model, array $rotorTypes, array $ringstellungen, array $positions, JulienBoudry\EnigmaMachine\ReflectorType $reflector, array $plugboardPairs, [ ?array $doraWiringPairs = null ] )
```

## Parameters

### **model:**
```php
JulienBoudry\EnigmaMachine\EnigmaModel $model
```
**Type:** [`JulienBoudry\EnigmaMachine\EnigmaModel`](../EnigmaModel/enum_EnigmaModel.md)

The Enigma model

### **rotorTypes:**
```php
array $rotorTypes
```
**Type:** `array`

Rotor types keyed by position (p1, p2, p3, greek)

### **ringstellungen:**
```php
array $ringstellungen
```
**Type:** `array`

Ring settings keyed by position

### **positions:**
```php
array $positions
```
**Type:** `array`

Initial positions keyed by position

### **reflector:**
```php
JulienBoudry\EnigmaMachine\ReflectorType $reflector
```
**Type:** [`JulienBoudry\EnigmaMachine\ReflectorType`](../ReflectorType/enum_ReflectorType.md)

The reflector type

### **plugboardPairs:**
```php
array $plugboardPairs
```
**Type:** `array`

Plugboard letter pairs

### **doraWiringPairs:**
```php
?array $doraWiringPairs = null
```
**Type:** `?array`

Custom DORA wiring pairs (13 pairs), null for default
