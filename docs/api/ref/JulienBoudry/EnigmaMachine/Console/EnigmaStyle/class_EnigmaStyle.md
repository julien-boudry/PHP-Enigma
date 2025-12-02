> JulienBoudry \ [EnigmaMachine](../../readme.md) \ **EnigmaStyle**
# Class EnigmaStyle
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/Console/EnigmaStyle.php#L21)

## Description
Military/submarine-themed console style for the Enigma Machine CLI.

Uses dark greens and grays reminiscent of WWII military equipment
and submarine control rooms.
## Elements

### Public Constants
| Constant Name | Signature | Description |
| ------------- | ------------- | ------------- |
| MAX_LINE_LENGTH | `public const MAX_LINE_LENGTH = 120` | __ |
| OUTPUT_NORMAL | `public const OUTPUT_NORMAL = 1` | __ |
| OUTPUT_PLAIN | `public const OUTPUT_PLAIN = 4` | __ |
| OUTPUT_RAW | `public const OUTPUT_RAW = 2` | __ |
| VERBOSITY_DEBUG | `public const VERBOSITY_DEBUG = 256` | __ |
| VERBOSITY_NORMAL | `public const VERBOSITY_NORMAL = 32` | __ |
| VERBOSITY_QUIET | `public const VERBOSITY_QUIET = 16` | __ |
| VERBOSITY_SILENT | `public const VERBOSITY_SILENT = 8` | __ |
| VERBOSITY_VERBOSE | `public const VERBOSITY_VERBOSE = 64` | __ |
| VERBOSITY_VERY_VERBOSE | `public const VERBOSITY_VERY_VERBOSE = 128` | __ |

### Public Methods
| Method Name | Description |
| ------------- | ------------- |
| [__construct(...)](method___construct.md) | __ |
| [configTable(...)](method_configTable.md) | _Display the Enigma configuration table from an Enigma instance._ |
| [configurationTable(...)](method_configurationTable.md) | _Display the Enigma configuration in a military-styled table._ |
| [encodedResult(...)](method_encodedResult.md) | _Display the encoded/decoded result with cipher styling._ |
| [enigmaTitle(...)](method_enigmaTitle.md) | _Display the Enigma machine title banner._ |
| [interactiveChoice(...)](method_interactiveChoice.md) | _Ask user to select from a list with visual styling._ |
| [interactiveConfirm(...)](method_interactiveConfirm.md) | _Ask for confirmation with styled prompt._ |
| [interactiveDivider(...)](method_interactiveDivider.md) | _Display a divider line._ |
| [interactiveHint(...)](method_interactiveHint.md) | _Display a hint/tip for the current step._ |
| [interactiveHints(...)](method_interactiveHints.md) | _Display multiple hints for the current step._ |
| [interactiveInput(...)](method_interactiveInput.md) | _Ask for text input with validation._ |
| [interactiveLetters(...)](method_interactiveLetters.md) | _Ask for letters input (A-Z) with validation._ |
| [interactiveMultiChoice(...)](method_interactiveMultiChoice.md) | _Ask user to select multiple items from a list._ |
| [interactivePlugboard(...)](method_interactivePlugboard.md) | _Ask for plugboard pairs input with validation._ |
| [interactiveSelected(...)](method_interactiveSelected.md) | _Display current selection indicator._ |
| [interactiveSkipped(...)](method_interactiveSkipped.md) | _Display skipped option indicator._ |
| [interactiveStep(...)](method_interactiveStep.md) | _Display a step header for interactive mode._ |
| [interactiveSummary(...)](method_interactiveSummary.md) | _Display a summary of selected configuration._ |
| [interactiveText(...)](method_interactiveText.md) | _Ask for text to encode._ |
| [interactiveWelcome(...)](method_interactiveWelcome.md) | _Display the interactive mode welcome header._ |
| [militaryError(...)](method_militaryError.md) | _Display an error with alert styling._ |
| [militaryInfo(...)](method_militaryInfo.md) | _Display an info message with military styling._ |
| [militaryNote(...)](method_militaryNote.md) | _Display a note with military styling._ |
| [militarySection(...)](method_militarySection.md) | _Display a military-style section header._ |
| [militaryWarning(...)](method_militaryWarning.md) | _Display a warning with amber/alert styling._ |
| [missionComplete(...)](method_missionComplete.md) | _Display success/completion message._ |
| [processing(...)](method_processing.md) | _Display a processing indicator._ |
| [processingDone(...)](method_processingDone.md) | _Complete the processing indicator._ |


## Public Representation
```php
class JulienBoudry\EnigmaMachine\Console\EnigmaStyle extends Symfony\Component\Console\Style\SymfonyStyle implements Symfony\Component\Console\Output\OutputInterface, Symfony\Component\Console\Style\StyleInterface
{

    // Methods
    public function __construct( Symfony\Component\Console\Input\InputInterface $input, Symfony\Component\Console\Output\OutputInterface $output );
    public function configTable( JulienBoudry\EnigmaMachine\Enigma $enigma ): void;
    public function configurationTable( array $rows ): void;
    public function encodedResult( string $result ): void;
    public function enigmaTitle( ): void;
    public function interactiveChoice( string $question, array $choices, [ ?string $default = null ] ): string;
    public function interactiveConfirm( string $question, [ bool $default = true ] ): bool;
    public function interactiveDivider( ): void;
    public function interactiveHint( string $hint ): void;
    public function interactiveHints( array $hints ): void;
    public function interactiveInput( string $question, [ ?string $default = null, ?string $placeholder = null, ?callable $validator = null ] ): string;
    public function interactiveLetters( string $question, int $expectedLength, [ ?string $default = null ] ): string;
    public function interactiveMultiChoice( string $question, array $choices, [ array $defaults = [] ] ): array;
    public function interactivePlugboard( string $question ): string;
    public function interactiveSelected( string $label, string $value ): void;
    public function interactiveSkipped( string $label, string $reason ): void;
    public function interactiveStep( int $step, int $total, string $title ): void;
    public function interactiveSummary( array $config ): void;
    public function interactiveText( string $question, [ bool $allowEmpty = false ] ): string;
    public function interactiveWelcome( ): void;
    public function militaryError( string $message ): void;
    public function militaryInfo( string $message ): void;
    public function militaryNote( string $message ): void;
    public function militarySection( string $title ): void;
    public function militaryWarning( string $message ): void;
    public function missionComplete( [ string $message = 'Transmission complete' ] ): void;
    public function processing( string $message ): void;
    public function processingDone( ): void;

}
```

## Full Representation
```php
class JulienBoudry\EnigmaMachine\Console\EnigmaStyle extends Symfony\Component\Console\Style\SymfonyStyle implements Symfony\Component\Console\Output\OutputInterface, Symfony\Component\Console\Style\StyleInterface
{
    // Inherited Constants
    public const EnigmaStyle::MAX_LINE_LENGTH = 120;
    public const EnigmaStyle::OUTPUT_NORMAL = 1;
    public const EnigmaStyle::OUTPUT_PLAIN = 4;
    public const EnigmaStyle::OUTPUT_RAW = 2;
    public const EnigmaStyle::VERBOSITY_DEBUG = 256;
    public const EnigmaStyle::VERBOSITY_NORMAL = 32;
    public const EnigmaStyle::VERBOSITY_QUIET = 16;
    public const EnigmaStyle::VERBOSITY_SILENT = 8;
    public const EnigmaStyle::VERBOSITY_VERBOSE = 64;
    public const EnigmaStyle::VERBOSITY_VERY_VERBOSE = 128;

    // Properties
    private Symfony\Component\Console\Output\OutputInterface $output;

    // Methods
    public function __construct( Symfony\Component\Console\Input\InputInterface $input, Symfony\Component\Console\Output\OutputInterface $output );
    public function configTable( JulienBoudry\EnigmaMachine\Enigma $enigma ): void;
    public function configurationTable( array $rows ): void;
    public function encodedResult( string $result ): void;
    public function enigmaTitle( ): void;
    public function interactiveChoice( string $question, array $choices, [ ?string $default = null ] ): string;
    public function interactiveConfirm( string $question, [ bool $default = true ] ): bool;
    public function interactiveDivider( ): void;
    public function interactiveHint( string $hint ): void;
    public function interactiveHints( array $hints ): void;
    public function interactiveInput( string $question, [ ?string $default = null, ?string $placeholder = null, ?callable $validator = null ] ): string;
    public function interactiveLetters( string $question, int $expectedLength, [ ?string $default = null ] ): string;
    public function interactiveMultiChoice( string $question, array $choices, [ array $defaults = [] ] ): array;
    public function interactivePlugboard( string $question ): string;
    public function interactiveSelected( string $label, string $value ): void;
    public function interactiveSkipped( string $label, string $reason ): void;
    public function interactiveStep( int $step, int $total, string $title ): void;
    public function interactiveSummary( array $config ): void;
    public function interactiveText( string $question, [ bool $allowEmpty = false ] ): string;
    public function interactiveWelcome( ): void;
    public function militaryError( string $message ): void;
    public function militaryInfo( string $message ): void;
    public function militaryNote( string $message ): void;
    public function militarySection( string $title ): void;
    public function militaryWarning( string $message ): void;
    public function missionComplete( [ string $message = 'Transmission complete' ] ): void;
    public function processing( string $message ): void;
    public function processingDone( ): void;

}
```