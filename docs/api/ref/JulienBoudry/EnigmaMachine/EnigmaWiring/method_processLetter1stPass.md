> JulienBoudry \ [EnigmaWiring](class_EnigmaWiring.md)
# Method processLetter1stPass()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaWiring.php#L84)

```php
public function EnigmaWiring->processLetter1stPass( JulienBoudry\EnigmaMachine\Letter $pin ): JulienBoudry\EnigmaMachine\Letter
```

## Description
Pass the given letter form side A to side B by following the connection of the pins.

## Parameters

### **pin:**
```php
JulienBoudry\EnigmaMachine\Letter $pin
```
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

pin that got activated

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Letter`](../Letter/enum_Letter.md)

pin that gets activated
