> JulienBoudry \ [EnigmaTextConverter](class_EnigmaTextConverter.md)
# Method formatInGroups()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaTextConverter.php#L258)

```php
public static function EnigmaTextConverter::formatInGroups( string $text, [ int $groupSize = 5 ] ): string
```

## Description
Format Enigma output into traditional 5-letter groups.

## Parameters

### **text:**
```php
string $text
```
**Type:** `string`

The Enigma text

### **groupSize:**
```php
int $groupSize = 5
```
**Type:** `int`

Size of each group (default: 5)

## Return
**Type:** `string`

Formatted text with spaces between groups
