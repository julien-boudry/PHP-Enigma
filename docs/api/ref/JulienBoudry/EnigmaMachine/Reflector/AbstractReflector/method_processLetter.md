> JulienBoudry \ [EnigmaMachine](../../readme.md) \ [AbstractReflector](class_AbstractReflector.md)
# Method processLetter()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Reflector/AbstractReflector.php#L59)

```php
public function AbstractReflector->processLetter( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter
```

## Description
Send a letter through the wiring.

Because pins are connected in pairs, there is no difference if
processLetter1stPass() or processLetter2ndPass() is used.

## Parameters

### **letter:**
```php
JulienBoudry\EnigmaMachine\Letter $letter
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../../Letter/enum_Letter.md)

letter to process

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../../Letter/enum_Letter.md)

resulting letter
