> JulienBoudry \ [EnigmaMachine](../../readme.md) \ [AbstractRotor](class_AbstractRotor.md)
# Method processLetter1stPass()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Rotor/AbstractRotor.php#L122)

```php
public function AbstractRotor->processLetter1stPass( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter
```

## Description
Send a letter from side A through the wiring to side B.

To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.
+ Letter::count() and % Letter::count() keep the value positive and in bounds.

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
