> JulienBoudry \ [Enigma](class_Enigma.md)
# Method createRandom()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L119)

```php
public static function Enigma::createRandom( JulienBoudry\EnigmaMachine\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): self
```

## Description
Create an Enigma machine with a random configuration.

Generates cryptographically secure random settings including:
- Random rotor selection and order (compatible with model)
- Random ring settings (Ringstellung)
- Random initial positions (Grundstellung)
- Random plugboard connections (10 pairs)
- Random reflector (compatible with model)

## Parameters

### **model:**
```php
JulienBoudry\EnigmaMachine\EnigmaModel $model
```
**Type:** [`JulienBoudry\EnigmaMachine\EnigmaModel`](../EnigmaModel/enum_EnigmaModel.md)

The Enigma model to create

### **randomEngine:**
```php
?Random\Engine $randomEngine = null
```
**Type:** `?Random\Engine`

Random engine for testing (null = secure random)

## Return
**Type:** [`JulienBoudry\EnigmaMachine\Enigma`](class_Enigma.md)

A fully configured Enigma machine
