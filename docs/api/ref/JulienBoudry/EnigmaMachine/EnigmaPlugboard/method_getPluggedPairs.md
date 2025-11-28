> JulienBoudry \ [EnigmaPlugboard](class_EnigmaPlugboard.md)
# Method getPluggedPairs()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaPlugboard.php#L123)

```php
public function EnigmaPlugboard->getPluggedPairs( ): array
```

## Description
Returns pairs where the first letter is alphabetically before the second
to avoid duplicates (e.g., returns [A, Z] not [Z, A]).

## Return
**Type:** `array`

List of letter pairs
