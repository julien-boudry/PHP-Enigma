<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Console;

use JulienBoudry\EnigmaMachine\Enigma;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\{Table, TableStyle};
use Symfony\Component\Console\Question\{ChoiceQuestion, Question};
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Military/submarine-themed console style for the Enigma Machine CLI.
 *
 * Uses dark greens and grays reminiscent of WWII military equipment
 * and submarine control rooms.
 */
class EnigmaStyle extends SymfonyStyle
{
    private OutputInterface $output;

    public function __construct(InputInterface $input, OutputInterface $output)
    {
        parent::__construct($input, $output);
        $this->output = $output;

        $this->configureStyles();
    }

    /**
     * Configure custom military-themed color styles.
     */
    private function configureStyles(): void
    {
        $formatter = $this->output->getFormatter();

        // Military green for headers/titles
        $formatter->setStyle('military', new OutputFormatterStyle('#8B9A46', null, ['bold']));

        // Dark olive for info messages
        $formatter->setStyle('olive', new OutputFormatterStyle('#6B8E23'));

        // Steel gray for notes
        $formatter->setStyle('steel', new OutputFormatterStyle('#708090'));

        // Amber for warnings (like submarine warning lights)
        $formatter->setStyle('amber', new OutputFormatterStyle('#FFBF00'));

        // Red for errors (alert status)
        $formatter->setStyle('alert', new OutputFormatterStyle('#CD5C5C', null, ['bold']));

        // Cipher output - bright green like old terminal displays
        $formatter->setStyle('cipher', new OutputFormatterStyle('#00FF00', null, ['bold']));

        // Muted text
        $formatter->setStyle('muted', new OutputFormatterStyle('#696969'));
    }

    /**
     * Display the Enigma machine title banner.
     */
    public function enigmaTitle(): void
    {
        $this->newLine();
        $this->writeln('<military>╔══════════════════════════════════════╗</>');
        $this->writeln('<military>║</>      <steel>⚙</> <military>ENIGMA MACHINE</> <steel>⚙</>          <military>║</>');
        $this->writeln('<military>╚══════════════════════════════════════╝</>');
        $this->newLine();
    }

    /**
     * Display a military-style section header.
     */
    public function militarySection(string $title): void
    {
        $this->writeln("<military>▸ {$title}</>");
    }

    /**
     * Display an info message with military styling.
     */
    public function militaryInfo(string $message): void
    {
        $this->writeln("  <olive>○</> <steel>{$message}</>");
    }

    /**
     * Display a note with military styling.
     */
    public function militaryNote(string $message): void
    {
        $this->writeln("  <steel>◆ {$message}</>");
    }

    /**
     * Display a warning with amber/alert styling.
     */
    public function militaryWarning(string $message): void
    {
        $this->writeln("  <amber>⚠ {$message}</>");
    }

    /**
     * Display an error with alert styling.
     */
    public function militaryError(string $message): void
    {
        $this->newLine();
        $this->writeln('<alert>╔══ ERROR ══════════════════════════════╗</>');
        $this->writeln("<alert>║</> {$message}");
        $this->writeln('<alert>╚═══════════════════════════════════════╝</>');
        $this->newLine();
    }

    /**
     * Display the encoded/decoded result with cipher styling.
     */
    public function encodedResult(string $result): void
    {
        $this->newLine();
        $this->writeln('  <military>┌──── MESSAGE ────┐</>');
        $this->writeln("  <military>│</> <cipher>{$result}</>");
        $this->writeln('  <military>└─────────────────┘</>');
        $this->newLine();
    }

    /**
     * Display success/completion message.
     */
    public function missionComplete(string $message = 'Transmission complete'): void
    {
        $this->writeln("<olive>✓ {$message}</>");
        $this->newLine();
    }

    /**
     * Display the Enigma configuration table from an Enigma instance.
     */
    public function configTable(Enigma $enigma): void
    {
        $config = $enigma->getConfiguration();

        $this->configurationTable([
            ['Model', $config->model->name],
            ['Rotors', $config->getRotorString()],
            ['Ring', $config->getRingString()],
            ['Position', $config->getPositionString()],
            ['Reflector', $config->reflector->name],
            ['Plugboard', $config->getPlugboardString() ?: '(none)'],
        ]);
    }

    /**
     * Display the Enigma configuration in a military-styled table.
     *
     * @param array<array{0: string, 1: string}> $rows
     */
    public function configurationTable(array $rows): void
    {
        $this->militarySection('CONFIGURATION');
        $this->newLine();

        $table = new Table($this->output);

        // Create military-style table
        $tableStyle = new TableStyle;
        $tableStyle
            ->setHorizontalBorderChars('─')
            ->setVerticalBorderChars('│')
            ->setCrossingChars('┼', '┌', '┬', '┐', '┤', '┘', '┴', '└', '├')
            ->setCellHeaderFormat('<military>%s</>')
            ->setCellRowFormat('<steel>%s</>');

        $table->setStyle($tableStyle);
        $table->setHeaders(['<military>Setting</>', '<military>Value</>']);

        foreach ($rows as $row) {
            $table->addRow(["<olive>{$row[0]}</>", "<steel>{$row[1]}</>"]);
        }

        $table->render();
        $this->newLine();
    }

    /**
     * Display a processing indicator.
     */
    public function processing(string $message): void
    {
        $this->write("  <steel>◐ {$message}...</> ");
    }

    /**
     * Complete the processing indicator.
     */
    public function processingDone(): void
    {
        $this->writeln('<olive>done</>');
    }

    // ========================================================================
    // INTERACTIVE MODE METHODS
    // ========================================================================

    /**
     * Display the interactive mode welcome header.
     */
    public function interactiveWelcome(): void
    {
        $this->newLine();
        $this->writeln('<military>╔══════════════════════════════════════════════════════════╗</>');
        $this->writeln('<military>║</>     <steel>⚙</> <military>ENIGMA MACHINE</> <steel>⚙</>  <muted>Interactive Configuration</>    <military>║</>');
        $this->writeln('<military>╚══════════════════════════════════════════════════════════╝</>');
        $this->newLine();
        $this->writeln('  <steel>Configure your Enigma machine step by step.</>');
        $this->writeln('  <muted>Use arrow keys to navigate, Enter to select.</>');
        $this->newLine();
    }

    /**
     * Display a step header for interactive mode.
     */
    public function interactiveStep(int $step, int $total, string $title): void
    {
        $this->newLine();
        $progress = str_repeat('●', $step) . str_repeat('○', $total - $step);
        $this->writeln("  <military>[{$progress}]</> <steel>Step {$step}/{$total}:</> <military>{$title}</>");
        $this->newLine();
    }

    /**
     * Display a hint/tip for the current step.
     */
    public function interactiveHint(string $hint): void
    {
        $this->writeln("  <muted>💡 {$hint}</>");
    }

    /**
     * Display multiple hints for the current step.
     *
     * @param array<string> $hints
     */
    public function interactiveHints(array $hints): void
    {
        foreach ($hints as $hint) {
            $this->interactiveHint($hint);
        }
        $this->newLine();
    }

    /**
     * Ask user to select from a list with visual styling.
     *
     * @param array<string> $choices
     */
    public function interactiveChoice(string $question, array $choices, ?string $default = null): string
    {
        $choiceQuestion = new ChoiceQuestion(
            "  <olive>▸</> <steel>{$question}</>",
            $choices,
            $default
        );
        $choiceQuestion->setErrorMessage('Invalid selection: %s');

        $answer = $this->askQuestion($choiceQuestion);

        if (!\is_string($answer)) {
            throw new \RuntimeException('Expected string answer from choice question.');
        }

        return $answer;
    }

    /**
     * Ask user to select multiple items from a list.
     *
     * @param array<string> $choices
     * @param array<string> $defaults
     *
     * @return array<string>
     */
    public function interactiveMultiChoice(string $question, array $choices, array $defaults = []): array
    {
        $choiceQuestion = new ChoiceQuestion(
            "  <olive>▸</> <steel>{$question}</>",
            $choices,
            implode(',', $defaults) ?: null
        );
        $choiceQuestion->setMultiselect(true);
        $choiceQuestion->setErrorMessage('Invalid selection: %s');

        $answer = $this->askQuestion($choiceQuestion);

        if (!\is_array($answer)) {
            throw new \RuntimeException('Expected array answer from multi-choice question.');
        }

        return array_values(array_filter($answer, \is_string(...)));
    }

    /**
     * Ask for text input with validation.
     *
     * @param callable|null $validator
     */
    public function interactiveInput(
        string $question,
        ?string $default = null,
        ?string $placeholder = null,
        ?callable $validator = null,
    ): string {
        $defaultHint = $default !== null ? " <muted>[{$default}]</>" : '';
        $prompt = "  <olive>▸</> <steel>{$question}</>{$defaultHint}: ";

        $inputQuestion = new Question($prompt, $default);

        if ($placeholder !== null) {
            $inputQuestion->setAutocompleterValues([$placeholder]);
        }

        if ($validator !== null) {
            $inputQuestion->setValidator($validator);
        }

        $answer = $this->askQuestion($inputQuestion);

        if (!\is_string($answer)) {
            throw new \RuntimeException('Expected string answer from input question.');
        }

        return $answer;
    }

    /**
     * Ask for letters input (A-Z) with validation.
     */
    public function interactiveLetters(string $question, int $expectedLength, ?string $default = null): string
    {
        $validator = function (?string $value) use ($expectedLength): string {
            if ($value === null || $value === '') {
                throw new \RuntimeException('Please enter a value.');
            }

            $value = strtoupper($value);

            if (!preg_match('/^[A-Z]+$/', $value)) {
                throw new \RuntimeException('Only letters A-Z are allowed.');
            }

            if (\strlen($value) !== $expectedLength) {
                throw new \RuntimeException("Expected exactly {$expectedLength} letters, got " . \strlen($value) . '.');
            }

            return $value;
        };

        return $this->interactiveInput(
            $question,
            $default,
            str_repeat('A', $expectedLength),
            $validator
        );
    }

    /**
     * Ask for plugboard pairs input with validation.
     */
    public function interactivePlugboard(string $question): string
    {
        $validator = function (?string $value): string {
            if ($value === null || trim($value) === '') {
                return '';
            }

            $value = strtoupper(trim($value));
            $pairs = preg_split('/[\s,]+/', $value);

            if ($pairs === false) {
                return '';
            }

            $usedLetters = [];

            foreach ($pairs as $pair) {
                if (\strlen($pair) !== 2) {
                    throw new \RuntimeException("Invalid pair: '{$pair}'. Each pair must be exactly 2 letters.");
                }

                if (!preg_match('/^[A-Z]{2}$/', $pair)) {
                    throw new \RuntimeException("Invalid pair: '{$pair}'. Only letters A-Z are allowed.");
                }

                $letters = str_split($pair);
                if ($letters[0] === $letters[1]) {
                    throw new \RuntimeException("Invalid pair: '{$pair}'. A letter cannot be plugged to itself.");
                }

                foreach ($letters as $letter) {
                    if (\in_array($letter, $usedLetters, true)) {
                        throw new \RuntimeException("Letter '{$letter}' is used more than once.");
                    }
                    $usedLetters[] = $letter;
                }
            }

            return implode(' ', $pairs);
        };

        return $this->interactiveInput($question, '', null, $validator);
    }

    /**
     * Ask for text to encode.
     */
    public function interactiveText(string $question, bool $allowEmpty = false): string
    {
        $validator = function (?string $value) use ($allowEmpty): string {
            if ($value === null || $value === '') {
                if ($allowEmpty) {
                    return '';
                }

                throw new \RuntimeException('Please enter the text to encode.');
            }

            return $value;
        };

        return $this->interactiveInput($question, null, null, $validator);
    }

    /**
     * Display a summary of selected configuration.
     *
     * @param array<string, string> $config
     */
    public function interactiveSummary(array $config): void
    {
        $this->newLine();
        $this->writeln('  <military>┌──────────────────────────────────────────────┐</>');
        $this->writeln('  <military>│</>        <steel>📋 Configuration Summary</>             <military>│</>');
        $this->writeln('  <military>├──────────────────────────────────────────────┤</>');

        foreach ($config as $key => $value) {
            $paddedKey = str_pad($key, 12);
            $this->writeln("  <military>│</>  <olive>{$paddedKey}</> <steel>{$value}</>");
        }

        $this->writeln('  <military>└──────────────────────────────────────────────┘</>');
        $this->newLine();
    }

    /**
     * Ask for confirmation with styled prompt.
     */
    public function interactiveConfirm(string $question, bool $default = true): bool
    {
        return $this->confirm("  <olive>▸</> <steel>{$question}</>", $default);
    }

    /**
     * Display a divider line.
     */
    public function interactiveDivider(): void
    {
        $this->writeln('  <muted>────────────────────────────────────────────────</>');
    }

    /**
     * Display current selection indicator.
     */
    public function interactiveSelected(string $label, string $value): void
    {
        $this->writeln("  <olive>✓</> <steel>{$label}:</> <military>{$value}</>");
    }

    /**
     * Display skipped option indicator.
     */
    public function interactiveSkipped(string $label, string $reason): void
    {
        $this->writeln("  <muted>○ {$label}: {$reason}</>");
    }
}
