> JulienBoudry \ [Enigma](class_Enigma.md)
# Method plugLetters()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L281)

```php
public function Enigma->plugLetters( JulienBoudry\EnigmaMachine\Letter $letter1, JulienBoudry\EnigmaMachine\Letter $letter2 ): void
```

## Description
Connect 2 letters on the plugboard.

Only available on military models (Wehrmacht, Kriegsmarine).
Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.

## Parameters

### **letter1:**
```php
JulienBoudry\EnigmaMachine\Letter $letter1
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

letter 1 to connect

### **letter2:**
```php
JulienBoudry\EnigmaMachine\Letter $letter2
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

letter 2 to connect

## Return
**Type:** `void`



## Throws
- **[\JulienBoudry\EnigmaMachine\Exception\EnigmaConfigurationException](../Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md)** _If this model does not have a plugboard_
