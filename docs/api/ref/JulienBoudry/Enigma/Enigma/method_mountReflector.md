> JulienBoudry \ [Enigma](class_Enigma.md)
# Method mountReflector()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L121)

```php
public function Enigma->mountReflector( JulienBoudry\Enigma\ReflectorType $reflector ): void
```

## Description
The previously used reflector will be replaced.

## Parameters

### **reflector:**
```php
JulienBoudry\Enigma\ReflectorType $reflector
```
**Type:** [`JulienBoudry\Enigma\ReflectorType`](../ReflectorType/enum_ReflectorType.md)

The reflector type to mount

## Return
**Type:** `void`



## Throws
- **[\InvalidArgumentException]()** _If the reflector is not compatible with this model_
