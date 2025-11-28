> JulienBoudry \ [Enigma](class_Enigma.md)
# Method unplugLetters()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L320)

```php
public function Enigma->unplugLetters( JulienBoudry\Enigma\Letter $letter ): void
```

## Description
Because letters are connected in pairs, we only need to know one of them.

Only available on military models (Wehrmacht, Kriegsmarine).
Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.

## Parameters

### **letter:**
```php
JulienBoudry\Enigma\Letter $letter
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

1 of the 2 letters to disconnect

## Return
**Type:** `void`



## Throws
- **[\JulienBoudry\Enigma\Exception\EnigmaConfigurationException](../Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md)** _If this model does not have a plugboard_
