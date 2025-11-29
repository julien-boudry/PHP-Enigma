> JulienBoudry \ [Enigma](class_Enigma.md)
# Method encodeBinary()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L410)

```php
public function Enigma->encodeBinary( string $binaryData, [ bool $formatOutput = false ] ): string
```

## Description
Encode binary data through the Enigma machine.

This method converts binary data to Enigma-compatible format and encodes it.
Useful for encoding arbitrary data that isn't text.

## Parameters

### **binaryData:**
```php
string $binaryData
```
**Type:** `string`

Raw binary data to encode

### **formatOutput:**
```php
bool $formatOutput = false
```
**Type:** `bool`

Whether to format output in 5-letter groups (default: false)

## Return
**Type:** `string`

The encoded data in Enigma format

## Related
- **[\JulienBoudry\EnigmaMachine\EnigmaTextConverter::binaryToEnigmaFormat()](../EnigmaTextConverter/method_binaryToEnigmaFormat.md)** _For the encoding scheme_
