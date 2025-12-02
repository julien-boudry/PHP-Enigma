> JulienBoudry \ [EnigmaMachine](../../readme.md) \ [ReflectorDora](class_ReflectorDora.md)
# Method fromString()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/ReflectorDora.php#L202)

```php
public static function ReflectorDora::fromString( string $pairsString ): self
```

## Description
Create a ReflectorDora from a simple string of pairs.

## Parameters

### **pairsString:**
```php
string $pairsString
```
**Type:** `string`

13 pairs as a string, e.g., "AC BO DE FG HI JK LM NP QR ST UV WX YZ"

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Reflector\ReflectorDora`](class_ReflectorDora.md)



## Throws
- **[\JulienBoudry\EnigmaMachine\Exception\EnigmaWiringException](../../Exception/EnigmaWiringException/class_EnigmaWiringException.md)** _If the string format is invalid_
