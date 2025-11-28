> JulienBoudry \ [Enigma](class_Enigma.md)
# Method mountReflector()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L226)

```php
public function Enigma->mountReflector( JulienBoudry\EnigmaMachine\ReflectorType|JulienBoudry\EnigmaMachine\Reflector\AbstractReflector $reflector ): void
```

## Description
The previously used reflector will be replaced.

## Parameters

### **reflector:**
```php
JulienBoudry\EnigmaMachine\ReflectorType|JulienBoudry\EnigmaMachine\Reflector\AbstractReflector $reflector
```
**Type:** [`JulienBoudry\EnigmaMachine\ReflectorType`](../ReflectorType/enum_ReflectorType.md) | [`JulienBoudry\EnigmaMachine\Reflector\AbstractReflector`](../Reflector/AbstractReflector/class_AbstractReflector.md)

The reflector type or instance to mount

## Return
**Type:** `void`



## Throws
- **[\InvalidArgumentException]()** _If the reflector is not compatible with this model (when strictMode is enabled)_
