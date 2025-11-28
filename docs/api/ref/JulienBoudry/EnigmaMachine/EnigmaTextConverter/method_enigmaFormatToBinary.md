> JulienBoudry \ [EnigmaTextConverter](class_EnigmaTextConverter.md)
# Method enigmaFormatToBinary()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaTextConverter.php#L222)

```php
public static function EnigmaTextConverter::enigmaFormatToBinary( string $enigmaText ): ?string
```

## Description
This is the reverse of binaryToEnigmaFormat().

## Parameters

### **enigmaText:**
```php
string $enigmaText
```
**Type:** `string`

Text encoded with binaryToEnigmaFormat()

## Return
**Type:** `?string`

Decoded binary data, or null if invalid format
