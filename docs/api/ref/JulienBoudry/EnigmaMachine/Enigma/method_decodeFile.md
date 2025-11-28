> JulienBoudry \ [Enigma](class_Enigma.md)
# Method decodeFile()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L503)

```php
public function Enigma->decodeFile( SplFileObject|string $source, SplFileObject|string $destination ): int
```

## Description
This method is the inverse of encodeFile(). It reads an Enigma-encoded file,
decodes it through the Enigma machine, and converts the result back to binary.

IMPORTANT: The Enigma machine must be in the exact same state (rotor positions)
as when the file was encoded. You cannot call decodeFile() on the same Enigma
instance that was just used to encodeFile(), as the rotor positions will have
advanced during encoding. Instead, clone the Enigma instance before encoding,
create a new instance with the same initial configuration, or manually reset
the rotor positions before decoding.

Note: This method advances the machine state (rotor positions) as it decodes.
Calling this method twice on the same Enigma instance will produce different
results. To decode the same file again, reset the rotor positions or use
a fresh Enigma with the same initial configuration.

## Parameters

### **source:**
```php
SplFileObject|string $source
```
**Type:** `SplFileObject` | `string`

Source file path or SplFileObject containing Enigma-encoded data

### **destination:**
```php
SplFileObject|string $destination
```
**Type:** `SplFileObject` | `string`

Destination file path or SplFileObject to write decoded binary to

## Return
**Type:** `int`

Total number of bytes written to destination

## Throws
- **[\RuntimeException]()** _If the source file cannot be read, destination cannot be written, or decoding fails_

## Related
- **[\JulienBoudry\EnigmaMachine\Enigma::encodeFile()](method_encodeFile.md)** _For the encoding method_
