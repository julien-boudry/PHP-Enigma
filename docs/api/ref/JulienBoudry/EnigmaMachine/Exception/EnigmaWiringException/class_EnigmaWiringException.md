> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **EnigmaWiringException**
# Class EnigmaWiringException
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Exception/EnigmaWiringException.php#L18)

## Description
This exception is thrown for hardware-level wiring errors that cannot be
bypassed, such as:
- Invalid DORA reflector pairs (wrong count, duplicate letters, self-connections)
- Invalid rotor wiring configurations

Unlike EnigmaConfigurationException, this exception is NOT affected by strictMode
because invalid wiring would cause the machine to malfunction.
## Elements


## Public Representation
```php
class JulienBoudry\EnigmaMachine\Exception\EnigmaWiringException extends Exception implements Throwable, Stringable
{

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\Exception\EnigmaWiringException extends Exception implements Throwable, Stringable
{

    // Inherited Properties
    protected  EnigmaWiringException->code = 0;
    protected string EnigmaWiringException->file = '';
    protected int EnigmaWiringException->line = 0;
    protected  EnigmaWiringException->message = '';

}
```