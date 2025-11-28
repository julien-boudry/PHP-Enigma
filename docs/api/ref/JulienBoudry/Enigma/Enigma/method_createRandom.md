> JulienBoudry \ [Enigma](class_Enigma.md)
# Method createRandom()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L111)

```php
public static function Enigma::createRandom( JulienBoudry\Enigma\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): JulienBoudry\Enigma\Enigma
```

## Description
Generates cryptographically secure random settings including:
- Random rotor selection and order (compatible with model)
- Random ring settings (Ringstellung)
- Random initial positions (Grundstellung)
- Random plugboard connections (10 pairs)
- Random reflector (compatible with model)

## Parameters

### **model:**
```php
JulienBoudry\Enigma\EnigmaModel $model
```
**Type:** [`JulienBoudry\Enigma\EnigmaModel`](../EnigmaModel/enum_EnigmaModel.md)

The Enigma model to create

### **randomEngine:**
```php
?Random\Engine $randomEngine = null
```
**Type:** `?Random\Engine`

Random engine for testing (null = secure random)

## Return
**Type:** [`JulienBoudry\Enigma\Enigma`](class_Enigma.md)

A fully configured Enigma machine
