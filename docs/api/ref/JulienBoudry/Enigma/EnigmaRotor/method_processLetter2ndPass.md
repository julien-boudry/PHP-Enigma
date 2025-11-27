> JulienBoudry \ [EnigmaRotor](class_EnigmaRotor.md)
# Method processLetter2ndPass()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaRotor.php#L166)

```php
public function EnigmaRotor->processLetter2ndPass( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter
```

## Description
To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br>
+ Letter::count() and % Letter::count() keep the value positive and in bounds.

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
