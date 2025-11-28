> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **EnigmaConfigurationException**
# Class EnigmaConfigurationException
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Exception/EnigmaConfigurationException.php#L18)

## Description
This includes:
- Incompatible rotor/model combinations
- Incompatible reflector/model combinations
- Invalid rotor positions (e.g., Greek rotor in wrong position)
- Duplicate rotors

These errors can be bypassed by setting strictMode to false.
## Elements


## Public Representation
```php
class JulienBoudry\EnigmaMachine\Exception\EnigmaConfigurationException extends Exception implements Throwable, Stringable
{

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\Exception\EnigmaConfigurationException extends Exception implements Throwable, Stringable
{

    // Inherited Properties
    protected  EnigmaConfigurationException->code = 0;
    protected string EnigmaConfigurationException->file = '';
    protected int EnigmaConfigurationException->line = 0;
    protected  EnigmaConfigurationException->message = '';

}
```