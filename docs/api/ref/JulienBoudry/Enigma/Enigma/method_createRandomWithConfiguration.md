> JulienBoudry \ [Enigma](class_Enigma.md)
# Method createRandomWithConfiguration()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L116)

```php
public static function Enigma::createRandomWithConfiguration( JulienBoudry\Enigma\EnigmaModel $model, [ ?Random\Engine $randomEngine = null ] ): array
```

## Description
Same as createRandom() but also returns the configuration object,
which is useful for logging, debugging, or recreating the same setup.

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
**Type:** `array`

The Enigma and its configuration
