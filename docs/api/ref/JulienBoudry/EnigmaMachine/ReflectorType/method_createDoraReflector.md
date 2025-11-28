> JulienBoudry \ [ReflectorType](enum_ReflectorType.md)
# Method createDoraReflector()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/ReflectorType.php#L96)

```php
public static function ReflectorType::createDoraReflector( array $pairs ): JulienBoudry\EnigmaMachine\Reflector\ReflectorDora
```

## Parameters

### **pairs:**
```php
array $pairs
```
**Type:** `array`

Array of 12 letter pairs, e.g., ['A' => 'B', 'C' => 'D', ...]
The J↔Y pair is fixed and added automatically.

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Reflector\ReflectorDora`](../Reflector/ReflectorDora/class_ReflectorDora.md)

The configured reflector
