> JulienBoudry \ [Letter](enum_Letter.md)
# Method fromPosition()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Letter.php#L88)

```php
public static function Letter::fromPosition( int $position ): self
```

## Description
Get the letter at a given position (with modulo wrapping).

This is useful for rotor calculations where positions wrap around.

## Parameters

### **position:**
```php
int $position
```
**Type:** `int`

The position (will be wrapped to 0-25)

## Return
**Type:** `self`


