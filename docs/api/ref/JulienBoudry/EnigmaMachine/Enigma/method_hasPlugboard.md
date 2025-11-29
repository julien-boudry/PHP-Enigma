> JulienBoudry \ [Enigma](class_Enigma.md)
# Method hasPlugboard()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L596)

```php
public function Enigma->hasPlugboard( ): bool
```

## Description
Check if this model historically has a plugboard.

Military models have plugboards, commercial models do not.
Note: The plugboard object always exists internally, but this method
indicates whether it should be used according to historical accuracy.

## Return
**Type:** `bool`


