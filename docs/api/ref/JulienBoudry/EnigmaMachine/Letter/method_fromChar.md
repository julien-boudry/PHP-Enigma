> JulienBoudry \ [Letter](enum_Letter.md)
# Method fromChar()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Letter.php#L65)

```php
public static function Letter::fromChar( string $char ): self
```

## Description
Create a Letter from a single character string.

## Parameters

### **char:**
```php
string $char
```
**Type:** `string`

A single character (A-Z, case-insensitive)

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](enum_Letter.md)



## Throws
- **[\ValueError]()** _If the character is not a valid letter_
