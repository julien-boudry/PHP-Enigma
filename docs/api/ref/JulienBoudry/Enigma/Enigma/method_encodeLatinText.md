> JulienBoudry \ [Enigma](class_Enigma.md)
# Method encodeLatinText()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L354)

```php
public function Enigma->encodeLatinText( string $text, [ string $spaceReplacement = 'X', bool $formatOutput = false ] ): string
```

## Description
This method accepts Latin-based text (including numbers, accented characters,
punctuation, spaces, etc.) and converts it to Enigma-compatible format
before encoding. Non-Latin characters (Cyrillic, Chinese, etc.) will be
converted to X or skipped.

Numbers are converted to German words (historical convention):
0=NULL, 1=EINS, 2=ZWEI, 3=DREI, 4=VIER, 5=FUENF, 6=SECHS, 7=SIEBEN, 8=ACHT, 9=NEUN

## Parameters

### **text:**
```php
string $text
```
**Type:** `string`

The text to encode (Latin characters, numbers, accents, punctuation)

### **spaceReplacement:**
```php
string $spaceReplacement = 'X'
```
**Type:** `string`

Character(s) to replace spaces with (default: 'X')

### **formatOutput:**
```php
bool $formatOutput = false
```
**Type:** `bool`

Whether to format output in 5-letter groups (default: false)

## Return
**Type:** `string`

The encoded text

## Related
- **[\JulienBoudry\Enigma\EnigmaTextConverter::latinToEnigmaFormat()](../EnigmaTextConverter/method_latinToEnigmaFormat.md)** _For the conversion rules_
