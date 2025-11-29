<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Console;

use JulienBoudry\EnigmaMachine\Enigma;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableStyle;
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
        $tableStyle = new TableStyle();
        $tableStyle
            ->setHorizontalBorderChars('─')
            ->setVerticalBorderChars('│')
            ->setCrossingChars('┼', '┌', '┬', '┐', '┤', '┘', '┴', '└', '├')
            ->setCellHeaderFormat('<military>%s</>')
            ->setCellRowFormat('<steel>%s</>');

        $table->setStyle($tableStyle);
        $table->setHeaders(['<military>Setting</>', '<military>Value</>']);

        foreach ($rows as $row) {
            $table->addRow(["<olive>{$row[0]}</>" , "<steel>{$row[1]}</>"]);
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
}
