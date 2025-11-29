> JulienBoudry \ [Enigma](class_Enigma.md)
# Method unplugLetters()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L326)

```php
public function Enigma->unplugLetters( JulienBoudry\EnigmaMachine\Letter $letter ): void
```

## Description
Disconnects 2 letters on the plugboard.

Because letters are connected in pairs, we only need to know one of them.

Only available on military models (Wehrmacht, Kriegsmarine).
Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.

## Parameters

### **letter:**
```php
JulienBoudry\EnigmaMachine\Letter $letter
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

1 of the 2 letters to disconnect

## Return
**Type:** `void`



## Throws
- **[\JulienBoudry\EnigmaMachine\Exception\EnigmaConfigurationException](../Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md)** _If this model does not have a plugboard_
