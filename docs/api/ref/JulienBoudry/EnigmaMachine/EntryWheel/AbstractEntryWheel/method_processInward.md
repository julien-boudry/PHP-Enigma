> JulienBoudry \ [EnigmaMachine](../../readme.md) \ [AbstractEntryWheel](class_AbstractEntryWheel.md)
# Method processInward()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EntryWheel/AbstractEntryWheel.php#L46)

```php
public function AbstractEntryWheel->processInward( JulienBoudry\EnigmaMachine\Letter $letter ): JulienBoudry\EnigmaMachine\Letter
```

## Description
Process a letter entering the rotor assembly (keyboard → rotors).

## Parameters

### **letter:**
```php
JulienBoudry\EnigmaMachine\Letter $letter
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../../Letter/enum_Letter.md)

The letter from the keyboard/plugboard

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../../Letter/enum_Letter.md)

The letter mapped to rotor contact position
