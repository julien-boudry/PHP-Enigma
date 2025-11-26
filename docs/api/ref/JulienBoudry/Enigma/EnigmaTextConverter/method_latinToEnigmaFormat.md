> JulienBoudry \ [EnigmaTextConverter](class_EnigmaTextConverter.md)
# Method latinToEnigmaFormat()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaTextConverter.php#L102)

```php
public static function EnigmaTextConverter::latinToEnigmaFormat( string $text, [ string $spaceReplacement = 'X', bool $keepUnknownAsX = true ] ): string
```

## Description
Handles Latin alphabet, accented characters (é, ü, ß, etc.), numbers,
and common punctuation. Non-Latin scripts (Cyrillic, Chinese, Arabic, etc.)
will be converted to X or skipped depending on $keepUnknownAsX.

Numbers are converted to German words (historical convention):
0=NULL, 1=EINS, 2=ZWEI, 3=DREI, 4=VIER, 5=FUENF, 6=SECHS, 7=SIEBEN, 8=ACHT, 9=NEUN

## Parameters

### **text:**
```php
string $text
```
**Type:** `string`

The input text (Latin characters, numbers, accents, punctuation)

### **spaceReplacement:**
```php
string $spaceReplacement = 'X'
```
**Type:** `string`

Character(s) to replace spaces with (default: 'X')

### **keepUnknownAsX:**
```php
bool $keepUnknownAsX = true
```
**Type:** `bool`

Replace unknown/non-Latin characters with X (default: true)

## Return
**Type:** `string`

The converted text containing only A-Z characters
