> JulienBoudry \ [Enigma](class_Enigma.md)
# Method encodeLetter()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L187)

```php
public function Enigma->encodeLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter
```

## Description
The letter passes the plugboard (if available), entry wheel, rotors, reflector,
rotors in the opposite direction, entry wheel again, and plugboard (if available).
Every encoding triggers the advance mechanism.

## Parameters

### **letter:**
```php
JulienBoudry\Enigma\Letter $letter
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

letter to encode

## Return
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

encoded letter

## Related
- **[\JulienBoudry\Enigma\Enigma::advance()](method_advance.md)**
