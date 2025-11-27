> JulienBoudry \ [EnigmaRotor](class_EnigmaRotor.md)
# Method processLetter1stPass()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaRotor.php#L142)

```php
public function EnigmaRotor->processLetter1stPass( int $letter ): int
```

## Description
To get the right pin of the wiring, we have to take the current position and the offset given by the ringstellung into account.<br>
+ ENIGMA_ALPHABET_SIZE and % ENIGMA_ALPHABET_SIZE keep the value positive and in bounds.

## Parameters

### **letter:**
```php
int $letter
```
**Type:** `int`

letter to process

## Return
**Type:** `int`

resulting letter
