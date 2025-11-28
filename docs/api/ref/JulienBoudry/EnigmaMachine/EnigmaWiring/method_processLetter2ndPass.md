> JulienBoudry \ [EnigmaWiring](class_EnigmaWiring.md)
# Method processLetter2ndPass()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaWiring.php#L96)

```php
public function EnigmaWiring->processLetter2ndPass( JulienBoudry\EnigmaMachine\Letter $pin ): JulienBoudry\EnigmaMachine\Letter
```

## Description
Pass the given letter form side B to side A by following the connection of the pins.

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
