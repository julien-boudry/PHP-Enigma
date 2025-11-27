> JulienBoudry \ [Enigma](../../readme.md) \ [AbstractRotor](class_AbstractRotor.md)
# Method processLetter1stPass()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Rotor/AbstractRotor.php#L122)

```php
public function AbstractRotor->processLetter1stPass( JulienBoudry\Enigma\Letter $letter ): JulienBoudry\Enigma\Letter
```

## Description
To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.
+ Letter::count() and % Letter::count() keep the value positive and in bounds.

## Parameters

### **letter:**
```php
JulienBoudry\Enigma\Letter $letter
```
**Type:** [`JulienBoudry\Enigma\Letter`](../../Letter/enum_Letter.md)

letter to process

## Return
**Type:** [`JulienBoudry\Enigma\Letter`](../../Letter/enum_Letter.md)

resulting letter
