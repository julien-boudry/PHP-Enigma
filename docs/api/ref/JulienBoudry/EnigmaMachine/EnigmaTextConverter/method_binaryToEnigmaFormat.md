> JulienBoudry \ [EnigmaTextConverter](class_EnigmaTextConverter.md)
# Method binaryToEnigmaFormat()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaTextConverter.php#L192)

```php
public static function EnigmaTextConverter::binaryToEnigmaFormat( string $binaryData ): string
```

## Description
Convert binary data to Enigma format using base64-like encoding.

This encodes arbitrary binary data into A-Z characters only.
Each byte is converted to a 2-3 letter representation.

## Parameters

### **binaryData:**
```php
string $binaryData
```
**Type:** `string`

Raw binary data

## Return
**Type:** `string`

Enigma-compatible representation
