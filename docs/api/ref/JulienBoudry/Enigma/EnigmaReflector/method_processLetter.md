> JulienBoudry \ [EnigmaReflector](class_EnigmaReflector.md)
# Method processLetter()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaReflector.php#L77)

```php
public function EnigmaReflector->processLetter( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter
```

## Description
Because pins are connected in pairs, there is no difference if
processLetter1stPass() or processLetter2ndPass() is used.

## Parameters

### **letter:**
```php
JulienBoudry\Enigma\Letter $letter
```
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

letter to process

## Return
**Type:** [`JulienBoudry\Enigma\Letter`](../Letter/enum_Letter.md)

resulting letter
