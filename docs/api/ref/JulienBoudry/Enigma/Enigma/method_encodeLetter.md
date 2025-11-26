> JulienBoudry \ [Enigma](class_Enigma.md)
# Method encodeLetter()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L181)

```php
public function Enigma->encodeLetter( string $letter ): string
```

## Description
The letter passes the plugboard, the rotors, the reflector, the rotors in the opposite direction and again the plugboard.
Every encoding triggers the advancemechanism.

## Parameters

### **letter:**
```php
string $letter
```
**Type:** `string`

letter to encode

## Return
**Type:** `string`

encoded letter

## Related
- **[\JulienBoudry\Enigma\Enigma::advance()](method_advance.md)**
