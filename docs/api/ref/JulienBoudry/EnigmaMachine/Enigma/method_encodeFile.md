> JulienBoudry \ [Enigma](class_Enigma.md)
# Method encodeFile()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Enigma.php#L444)

```php
public function Enigma->encodeFile( SplFileObject|string $source, SplFileObject|string $destination ): int
```

## Description
Encode a file through the Enigma machine, reading and writing sequentially.

This method processes the source file in chunks to minimize memory usage,
making it suitable for encoding large files. Each chunk is converted to
Enigma format and encoded before being written to the destination file.

Note: This method advances the machine state (rotor positions) as it encodes.
Calling this method twice on the same Enigma instance will produce different
results. To decode, use a fresh Enigma with the same initial configuration,
or clone the Enigma before encoding.

## Parameters

### **source:**
```php
SplFileObject|string $source
```
**Type:** `SplFileObject` | `string`

Source file path or SplFileObject to read from

### **destination:**
```php
SplFileObject|string $destination
```
**Type:** `SplFileObject` | `string`

Destination file path or SplFileObject to write to

## Return
**Type:** `int`

Total number of encoded letters written

## Throws
- **[\RuntimeException]()** _If the source file cannot be read or destination cannot be written_

## Related
- **[\JulienBoudry\EnigmaMachine\Enigma::encodeBinary()](method_encodeBinary.md)** _For the underlying encoding method_
- **[\JulienBoudry\EnigmaMachine\Enigma::$fileChunkSize](static_property_fileChunkSize.md)** _For configuring the chunk size_
