> JulienBoudry \ [Enigma](class_Enigma.md)
# Method plugLettersFromPairs()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L299)

```php
public function Enigma->plugLettersFromPairs( array|string $pairs ): void
```

## Description
Only available on military models (Wehrmacht, Kriegsmarine).
Commercial models (Enigma K, Swiss-K, Railway) do not have a plugboard.

Accepts pairs in various formats:
- Space-separated string: "AV BS CG DL FU HZ IN KM OW RX"
- Array of pairs: ['AV', 'BS', 'CG', 'DL', 'FU', 'HZ', 'IN', 'KM', 'OW', 'RX']

## Parameters

### **pairs:**
```php
array|string $pairs
```
**Type:** `array` | `string`

Pairs to connect

## Return
**Type:** `void`



## Throws
- **[\JulienBoudry\Enigma\Exception\EnigmaConfigurationException](../Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md)** _If this model does not have a plugboard_
