> JulienBoudry \ [ReflectorType](enum_ReflectorType.md)
# Method createDoraReflectorFromString()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/ReflectorType.php#L109)

```php
public static function ReflectorType::createDoraReflectorFromString( string $pairsString ): JulienBoudry\Enigma\Reflector\ReflectorDora
```

## Parameters

### **pairsString:**
```php
string $pairsString
```
**Type:** `string`

12 pairs as a string, e.g., "AB CD EF GH IK LM NO PQ RS TU VW XZ"
(J↔Y is added automatically)

## Return
**Type:** [`JulienBoudry\Enigma\Reflector\ReflectorDora`](../Reflector/ReflectorDora/class_ReflectorDora.md)

The configured reflector
