> JulienBoudry \ **EnigmaTextConverter**
# Class EnigmaTextConverter
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaTextConverter.php#L21)

## Description
Converts arbitrary text to Enigma-compatible format (A-Z only).

Historical Enigma machines could only process the 26 letters A-Z.
This class provides conversion utilities to transform any input text
into a format suitable for Enigma encryption.

Common historical conventions:
- Numbers were spelled out in German (e.g., 1 → EINS)
- Spaces were represented as X
- Special characters were spelled out or omitted
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| ACCENT_MAP | `private const array ACCENT_MAP = ['À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'AE', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'OE', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'UE', 'Ý' => 'Y', 'Þ' => 'TH', 'ß' => 'SS', 'à' => 'A', 'á' => 'A', 'â' => 'A', 'ã' => 'A', 'ä' => 'AE', 'å' => 'A', 'æ' => 'AE', 'ç' => 'C', 'è' => 'E', 'é' => 'E', 'ê' => 'E', 'ë' => 'E', 'ì' => 'I', 'í' => 'I', 'î' => 'I', 'ï' => 'I', 'ð' => 'D', 'ñ' => 'N', 'ò' => 'O', 'ó' => 'O', 'ô' => 'O', 'õ' => 'O', 'ö' => 'OE', 'ø' => 'O', 'ù' => 'U', 'ú' => 'U', 'û' => 'U', 'ü' => 'UE', 'ý' => 'Y', 'þ' => 'TH', 'ÿ' => 'Y']` | _Character normalization map for accented characters._ |
| GERMAN_NUMBERS | `private const array GERMAN_NUMBERS = ['NULL', 'EINS', 'ZWEI', 'DREI', 'VIER', 'FUENF', 'SECHS', 'SIEBEN', 'ACHT', 'NEUN']` | _German number words (0-9) as used historically with Enigma._ |
| PUNCTUATION_MAP | `private const array PUNCTUATION_MAP = ['.' => 'X', ',' => 'ZZ', ':' => 'XX', ';' => 'YY', '?' => 'UD', '!' => 'X', '-' => 'YY', '(' => 'KK', ')' => 'KK', '"' => 'X', ''' => 'X', '/' => 'X', '@' => 'AT', '&' => 'UND', '+' => 'PLUS', '=' => 'GLEICH', '%' => 'PROZENT']` | _Common punctuation replacements._ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [binaryToEnigmaFormat(...)](method_binaryToEnigmaFormat.md) | _Convert binary data to Enigma format using base64-like encoding._ |
| [enigmaFormatToBinary(...)](method_enigmaFormatToBinary.md) | _Convert Enigma format back to binary data._ |
| [formatInGroups(...)](method_formatInGroups.md) | _Format Enigma output into traditional 5-letter groups._ |
| [isValidEnigmaFormat(...)](method_isValidEnigmaFormat.md) | _Check if a string is already in valid Enigma format (A-Z only)._ |
| [latinToEnigmaFormat(...)](method_latinToEnigmaFormat.md) | _Convert Latin text to Enigma-compatible format._ |
| [removeGroupFormatting(...)](method_removeGroupFormatting.md) | _Remove group formatting (spaces) from Enigma text._ |


## Public Representation
```php
final class JulienBoudry\EnigmaMachine\EnigmaTextConverter
{

    // Static Methods
    public static function binaryToEnigmaFormat( string $binaryData ): string;
    public static function enigmaFormatToBinary( string $enigmaText ): ?string;
    public static function formatInGroups( string $text, [ int $groupSize = 5 ] ): string;
    public static function isValidEnigmaFormat( string $text ): bool;
    public static function latinToEnigmaFormat( string $text, [ string $spaceReplacement = 'X', bool $keepUnknownAsX = true ] ): string;
    public static function removeGroupFormatting( string $text ): string;

}
```

## Full Representation
```php
final class JulienBoudry\EnigmaMachine\EnigmaTextConverter
{
    // Constants
    private const array ACCENT_MAP = ['À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'AE', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'OE', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'UE', 'Ý' => 'Y', 'Þ' => 'TH', 'ß' => 'SS', 'à' => 'A', 'á' => 'A', 'â' => 'A', 'ã' => 'A', 'ä' => 'AE', 'å' => 'A', 'æ' => 'AE', 'ç' => 'C', 'è' => 'E', 'é' => 'E', 'ê' => 'E', 'ë' => 'E', 'ì' => 'I', 'í' => 'I', 'î' => 'I', 'ï' => 'I', 'ð' => 'D', 'ñ' => 'N', 'ò' => 'O', 'ó' => 'O', 'ô' => 'O', 'õ' => 'O', 'ö' => 'OE', 'ø' => 'O', 'ù' => 'U', 'ú' => 'U', 'û' => 'U', 'ü' => 'UE', 'ý' => 'Y', 'þ' => 'TH', 'ÿ' => 'Y'];
    private const array GERMAN_NUMBERS = ['NULL', 'EINS', 'ZWEI', 'DREI', 'VIER', 'FUENF', 'SECHS', 'SIEBEN', 'ACHT', 'NEUN'];
    private const array PUNCTUATION_MAP = ['.' => 'X', ',' => 'ZZ', ':' => 'XX', ';' => 'YY', '?' => 'UD', '!' => 'X', '-' => 'YY', '(' => 'KK', ')' => 'KK', '"' => 'X', ''' => 'X', '/' => 'X', '@' => 'AT', '&' => 'UND', '+' => 'PLUS', '=' => 'GLEICH', '%' => 'PROZENT'];

    // Static Methods
    public static function binaryToEnigmaFormat( string $binaryData ): string;
    public static function enigmaFormatToBinary( string $enigmaText ): ?string;
    public static function formatInGroups( string $text, [ int $groupSize = 5 ] ): string;
    public static function isValidEnigmaFormat( string $text ): bool;
    public static function latinToEnigmaFormat( string $text, [ string $spaceReplacement = 'X', bool $keepUnknownAsX = true ] ): string;
    public static function removeGroupFormatting( string $text ): string;

}
```