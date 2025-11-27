> JulienBoudry \ [Enigma](class_Enigma.md)
# Method encodeLetter()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L94)

```php
public function Enigma->encodeLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter
```

## Description
The letter passes the plugboard, the rotors, the reflector, the rotors in the opposite direction and again the plugboard.
Every encoding triggers the advancemechanism.

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
