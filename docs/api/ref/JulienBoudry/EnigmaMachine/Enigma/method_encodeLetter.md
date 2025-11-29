> JulienBoudry \ [Enigma](class_Enigma.md)
# Method encodeLetter()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L193)

```php
public function Enigma->encodeLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter
```

## Description
Encode a single letter.

The letter passes the plugboard (if available), entry wheel, rotors, reflector,
rotors in the opposite direction, entry wheel again, and plugboard (if available).
Every encoding triggers the advance mechanism.

## Parameters

### **letter:**
```php
JulienBoudry\EnigmaMachine\Letter $letter
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

letter to encode

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

encoded letter

## Related
- **[\JulienBoudry\EnigmaMachine\Enigma::advance()](method_advance.md)**
