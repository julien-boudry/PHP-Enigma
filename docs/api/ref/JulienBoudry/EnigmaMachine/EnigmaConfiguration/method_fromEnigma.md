> JulienBoudry \ [EnigmaConfiguration](class_EnigmaConfiguration.md)
# Method fromEnigma()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaConfiguration.php#L47)

```php
public static function EnigmaConfiguration::fromEnigma( JulienBoudry\EnigmaMachine\Enigma $enigma ): self
```

## Description
Create a configuration from an existing Enigma machine.

Extracts the current state of the Enigma machine including
rotor types, ring settings, positions, reflector, and plugboard.

## Parameters

### **enigma:**
```php
JulienBoudry\EnigmaMachine\Enigma $enigma
```
**Type:** [`JulienBoudry\EnigmaMachine\Enigma`](../Enigma/class_Enigma.md)

The Enigma machine to extract configuration from

## Return
**Type:** [`JulienBoudry\EnigmaMachine\EnigmaConfiguration`](class_EnigmaConfiguration.md)

The extracted configuration
