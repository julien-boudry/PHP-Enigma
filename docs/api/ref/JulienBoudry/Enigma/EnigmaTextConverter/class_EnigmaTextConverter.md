> JulienBoudry \ **EnigmaTextConverter**
# Class EnigmaTextConverter
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaTextConverter.php#L21)

## Description
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
| ACCENT_MAP | `private const array ACCENT_MAP = ['À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'AE', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'OE', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'UE', 'Ý' => 'Y', 'Þ' => 'TH', 'ß' => 'SS', 'à' => 'A', 'á' => 'A', 'â' => 'A', 'ã' => 'A', 'ä' => 'AE', 'å' => 'A', 'æ' => 'AE', 'ç' => 'C', 'è' => 'E', 'é' => 'E', 'ê' => 'E', 'ë' => 'E', 'ì' => 'I', 'í' => 'I', 'î' => 'I', 'ï' => 'I', 'ð' => 'D', 'ñ' => 'N', 'ò' => 'O', 'ó' => 'O', 'ô' => 'O', 'õ' => 'O', 'ö' => 'OE', 'ø' => 'O', 'ù' => 'U', 'ú' => 'U', 'û' => 'U', 'ü' => 'UE', 'ý' => 'Y', 'þ' => 'TH', 'ÿ' => 'Y']` | __ |
| GERMAN_NUMBERS | `private const array GERMAN_NUMBERS = ['NULL', 'EINS', 'ZWEI', 'DREI', 'VIER', 'FUENF', 'SECHS', 'SIEBEN', 'ACHT', 'NEUN']` | __ |
| PUNCTUATION_MAP | `private const array PUNCTUATION_MAP = ['.' => 'X', ',' => 'ZZ', ':' => 'XX', ';' => 'YY', '?' => 'UD', '!' => 'X', '-' => 'YY', '(' => 'KK', ')' => 'KK', '"' => 'X', ''' => 'X', '/' => 'X', '@' => 'AT', '&' => 'UND', '+' => 'PLUS', '=' => 'GLEICH', '%' => 'PROZENT']` | __ |

### Public Static Methods
| Method Name | Description |
| ------------- | ------------- |
| [binaryToEnigmaFormat(...)](method_binaryToEnigmaFormat.md) | _This encodes arbitrary binary data into A-Z characters only. Each byte is converted to a 2-3 letter representation._ |
| [enigmaFormatToBinary(...)](method_enigmaFormatToBinary.md) | _This is the reverse of binaryToEnigmaFormat()._ |
| [formatInGroups(...)](method_formatInGroups.md) | __ |
| [isValidEnigmaFormat(...)](method_isValidEnigmaFormat.md) | __ |
| [latinToEnigmaFormat(...)](method_latinToEnigmaFormat.md) | _Handles Latin alphabet, accented characters (é, ü, ß, etc.), numbers, and common punctuation. Non-Latin scripts (Cyrillic, Chinese, Arabic, etc.) will be converted to X or skipped depending on $keepUn..._ |
| [removeGroupFormatting(...)](method_removeGroupFormatting.md) | __ |


## Public Representation
```php
final class JulienBoudry\Enigma\EnigmaTextConverter
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
final class JulienBoudry\Enigma\EnigmaTextConverter
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