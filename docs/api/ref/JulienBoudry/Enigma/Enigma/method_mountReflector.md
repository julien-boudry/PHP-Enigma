> JulienBoudry \ [Enigma](class_Enigma.md)
# Method mountReflector()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L199)

```php
public function Enigma->mountReflector( JulienBoudry\Enigma\ReflectorType|JulienBoudry\Enigma\Reflector\AbstractReflector $reflector ): void
```

## Description
The previously used reflector will be replaced.

## Parameters

### **reflector:**
```php
JulienBoudry\Enigma\ReflectorType|JulienBoudry\Enigma\Reflector\AbstractReflector $reflector
```
**Type:** [`JulienBoudry\Enigma\ReflectorType`](../ReflectorType/enum_ReflectorType.md) | [`JulienBoudry\Enigma\Reflector\AbstractReflector`](../Reflector/AbstractReflector/class_AbstractReflector.md)

The reflector type or instance to mount

## Return
**Type:** `void`



## Throws
- **[\InvalidArgumentException]()** _If the reflector is not compatible with this model (when strictMode is enabled)_
