> JulienBoudry \ [Enigma](class_Enigma.md)
# Method encodeLetters()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L202)

```php
public function Enigma->encodeLetters( string $letters ): string
```

## Description
This method processes each character in the input through the Enigma machine.
The input must contain only valid Enigma alphabet characters (A-Z).
Use encodeText() for arbitrary text that needs conversion first.

## Parameters

### **letters:**
```php
string $letters
```
**Type:** `string`

The letters to encode (A-Z only, no spaces or other characters)

## Return
**Type:** `string`

The encoded letters

## Throws
- **[\ValueError]()** _If the input contains invalid characters_

## Related
- **[\JulienBoudry\Enigma\Enigma::encodeLatinText()](method_encodeLatinText.md)** _For encoding arbitrary text with automatic conversion_
