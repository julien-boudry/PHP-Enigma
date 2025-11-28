> JulienBoudry \ [RotorType](enum_RotorType.md)
# Method getCompatibleRotorsForModel()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/RotorType.php#L247)

```php
public static function RotorType::getCompatibleRotorsForModel( JulienBoudry\EnigmaMachine\EnigmaModel $model ): array
```

## Description
Get all non-Greek rotor types compatible with a given Enigma model.

This method dynamically filters rotors based on their getCompatibleModels() method,
excluding Greek rotors (Beta/Gamma) which have special positioning rules.

## Parameters

### **model:**
```php
JulienBoudry\EnigmaMachine\EnigmaModel $model
```
**Type:** [`JulienBoudry\EnigmaMachine\EnigmaModel`](../EnigmaModel/enum_EnigmaModel.md)

The Enigma model to get compatible rotors for

## Return
**Type:** `array`

List of compatible non-Greek rotor types
