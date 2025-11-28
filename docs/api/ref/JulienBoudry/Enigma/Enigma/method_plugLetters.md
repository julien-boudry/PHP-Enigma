> JulienBoudry \ [Enigma](class_Enigma.md)
# Method plugLetters()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L275)

```php
public function Enigma->plugLetters( JulienBoudry\Enigma\Letter $letter1, JulienBoudry\Enigma\Letter $letter2 ): void
```

## Description
Only available on military models (Wehrmacht, Kriegsmarine).
Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.

## Parameters

### **letter1:**
```php
JulienBoudry\Enigma\Letter $letter1
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

letter 1 to connect

### **letter2:**
```php
JulienBoudry\Enigma\Letter $letter2
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

letter 2 to connect

## Return
**Type:** `void`



## Throws
- **[\JulienBoudry\Enigma\Exception\EnigmaConfigurationException](../Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md)** _If this model does not have a plugboard_
