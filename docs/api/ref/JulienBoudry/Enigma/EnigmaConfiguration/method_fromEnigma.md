> JulienBoudry \ [EnigmaConfiguration](class_EnigmaConfiguration.md)
# Method fromEnigma()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaConfiguration.php#L47)

```php
public static function EnigmaConfiguration::fromEnigma( JulienBoudry\Enigma\Enigma $enigma ): JulienBoudry\Enigma\EnigmaConfiguration
```

## Description
Extracts the current state of the Enigma machine including
rotor types, ring settings, positions, reflector, and plugboard.

## Parameters

### **enigma:**
```php
JulienBoudry\Enigma\Enigma $enigma
```
**Type:** [`JulienBoudry\Enigma\Enigma`](../Enigma/class_Enigma.md)

The Enigma machine to extract configuration from

## Return
**Type:** [`JulienBoudry\Enigma\EnigmaConfiguration`](class_EnigmaConfiguration.md)

The extracted configuration
