<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Console;

use JulienBoudry\EnigmaMachine\{Enigma, Letter, RotorPosition};
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\OutputInterface;

class EnigmaSimulator
{
    private OutputInterface $output;
    private Enigma $enigma;
    private Cursor $cursor;
    private int $frameHeight = 0;

    public function __construct(OutputInterface $output, Enigma $enigma)
    {
        $this->output = $output;
        $this->enigma = $enigma;
        $this->cursor = new Cursor($output);

        $this->configureStyles();
    }

    /**
     * Configure custom color styles for the simulator.
     */
    private function configureStyles(): void
    {
        $formatter = $this->output->getFormatter();

        $formatter->setStyle('military', new OutputFormatterStyle('#8B9A46', null, ['bold']));
        $formatter->setStyle('olive', new OutputFormatterStyle('#6B8E23'));
        $formatter->setStyle('steel', new OutputFormatterStyle('#708090'));
        $formatter->setStyle('cipher', new OutputFormatterStyle('#00FF00', null, ['bold']));
        $formatter->setStyle('muted', new OutputFormatterStyle('#696969'));
    }

    /**
     * Get the keyboard rows based on the entry wheel layout.
     *
     * @return array<int, array<string>>
     */
    private function getKeyboardRows(): array
    {
        $layout = $this->enigma->entryWheel->getWiringString();

        return [
            str_split(substr($layout, 0, 9)),
            str_split(substr($layout, 9, 8)),
            str_split(substr($layout, 17, 9)),
        ];
    }

    /**
     * Simulate the encoding of text with visual animation.
     */
    public function simulate(string $text, int $delayMs = 250): string
    {
        $result = '';
        $text = strtoupper($text);
        $length = \strlen($text);

        $this->renderFrame(null, null);

        for ($i = 0; $i < $length; $i++) {
            $char = $text[$i];

            if (!ctype_alpha($char)) {
                continue;
            }

            usleep($delayMs * 1000);

            $this->cursor->moveUp($this->frameHeight);
            $this->cursor->clearOutput();

            $inputLetter = Letter::fromChar($char);
            $outputLetter = $this->enigma->encodeLetter($inputLetter);
            $result .= $outputLetter->toChar();

            $this->renderFrame($inputLetter, $outputLetter);
        }

        return $result;
    }

    private function renderFrame(?Letter $input, ?Letter $output): void
    {
        $buffer = [];

        // Title
        $buffer[] = '';
        $buffer[] = '<military>──────────────────[</> <cipher>𝕰𝖓𝖎𝖌𝖒𝖆 𝕸𝖆𝖈𝖍𝖎𝖓𝖊</> <military>]──────────────────</>';

        // Model info
        $model = $this->enigma->model->name;
        $reflector = $this->enigma->reflector->getType()->name;
        $buffer[] = "<steel>          Model: {$model}  |  Reflector: {$reflector}</>";

        // Rotors
        $buffer[] = '';
        $buffer[] = '<military>✠</> <olive>Rotors</> <military>─────────────────────────────────────────────</>';
        $buffer = array_merge($buffer, $this->renderRotors());

        // Lampboard
        $buffer[] = '';
        $buffer[] = '<military>✠</> <olive>Lampboard</> <military>──────────────────────────────────────────</>';
        $buffer = array_merge($buffer, $this->renderLampboard($output));

        // Keyboard
        $buffer[] = '';
        $buffer[] = '<military>✠</> <olive>Keyboard</> <military>───────────────────────────────────────────</>';
        $buffer = array_merge($buffer, $this->renderKeyboard($input));

        // Plugboard
        if ($this->enigma->hasPlugboard()) {
            $buffer[] = '';
            $buffer[] = '<military>✠</> <olive>Plugboard</> <military>──────────────────────────────────────────</>';
            $buffer = array_merge($buffer, $this->renderPlugboard());
        }

        // Status
        $buffer[] = '';
        $buffer[] = '<military>✠</> <olive>Status</> <military>─────────────────────────────────────────────</>';
        $buffer = array_merge($buffer, $this->renderStatus($input, $output));
        $buffer[] = '';

        foreach ($buffer as $line) {
            $this->output->writeln($line);
        }

        $this->frameHeight = \count($buffer);
    }

    /**
     * @return array<string>
     */
    private function renderRotors(): array
    {
        $lines = [];
        $model = $this->enigma->model;
        $rotorConfig = $this->enigma->rotors;

        $p1 = $this->enigma->getPosition(RotorPosition::P1)->toChar();
        $p2 = $this->enigma->getPosition(RotorPosition::P2)->toChar();
        $p3 = $this->enigma->getPosition(RotorPosition::P3)->toChar();

        $rotors = [];

        if ($model->requiresGreekRotor()) {
            $greekPos = $this->enigma->getPosition(RotorPosition::GREEK)->toChar();
            $greekType = $rotorConfig->getGreek()->getType()->name;
            $rotors[] = ['pos' => $greekPos, 'label' => $greekType];
        }

        $rotors[] = ['pos' => $p3, 'label' => $rotorConfig->getP3()->getType()->name];
        $rotors[] = ['pos' => $p2, 'label' => $rotorConfig->getP2()->getType()->name];
        $rotors[] = ['pos' => $p1, 'label' => $rotorConfig->getP1()->getType()->name];

        // Calculate total rotor display width
        // Each rotor: "  [X]  " = 7 chars, separator: "──" = 2 chars
        $rotorCount = \count($rotors);
        $blockWidth = 7;
        $separatorWidth = 2;
        $totalWidth = ($blockWidth * $rotorCount) + ($separatorWidth * ($rotorCount - 1));
        
        // Lampboard first row: 9 letters × 4 chars each = 36 chars, indent 10
        // Center rotors relative to lampboard center
        $lampboardIndent = 10;
        $lampboardWidth = 36;
        $lampboardCenter = $lampboardIndent + ($lampboardWidth / 2);
        $rotorStartPos = (int) ($lampboardCenter - ($totalWidth / 2));
        $indent = str_repeat(' ', $rotorStartPos);
        
        // Rotor display line: [X]──[Y]──[Z]
        $rotorLine = $indent;
        foreach ($rotors as $i => $rotor) {
            $rotorLine .= "  <steel>[</><cipher>{$rotor['pos']}</><steel>]</>  ";
            if ($i < $rotorCount - 1) {
                $rotorLine .= '<muted>──</>';
            }
        }
        $lines[] = $rotorLine;

        // Labels line - each label centered in 7 chars
        $labelsLine = $indent;
        foreach ($rotors as $i => $rotor) {
            $label = $rotor['label'];
            $labelLen = \strlen($label);
            $padLeft = (int) floor(($blockWidth - $labelLen) / 2);
            $padRight = $blockWidth - $labelLen - $padLeft;
            $labelsLine .= str_repeat(' ', $padLeft) . $label . str_repeat(' ', $padRight);
            if ($i < $rotorCount - 1) {
                $labelsLine .= '  ';
            }
        }
        $lines[] = "<muted>{$labelsLine}</>";

        return $lines;
    }

    /**
     * @return array<string>
     */
    private function renderLampboard(?Letter $litLetter): array
    {
        $litChar = $litLetter ? $litLetter->toChar() : null;
        $rows = $this->getKeyboardRows();

        $formattedLines = [];
        foreach ($rows as $rowIndex => $row) {
            $indent = ($rowIndex === 1) ? '            ' : '          ';
            $content = $indent;

            foreach ($row as $char) {
                if ($char === $litChar) {
                    $content .= "<cipher>({$char})</> ";
                } else {
                    $content .= "<muted> {$char} </> ";
                }
            }

            $formattedLines[] = $content;
        }

        return $formattedLines;
    }

    /**
     * @return array<string>
     */
    private function renderKeyboard(?Letter $pressedLetter): array
    {
        $pressedChar = $pressedLetter ? $pressedLetter->toChar() : null;
        $rows = $this->getKeyboardRows();

        $formattedLines = [];
        foreach ($rows as $rowIndex => $row) {
            $indent = ($rowIndex === 1) ? '            ' : '          ';
            $content = $indent;

            foreach ($row as $char) {
                if ($char === $pressedChar) {
                    $content .= "<olive>[{$char}]</> ";
                } else {
                    $content .= "<steel> {$char} </> ";
                }
            }

            $formattedLines[] = $content;
        }

        return $formattedLines;
    }

    /**
     * @return array<string>
     */
    private function renderPlugboard(): array
    {
        $pairs = $this->enigma->plugboard->getPluggedPairs();

        if (\count($pairs) === 0) {
            return ['            <muted>-- No Connections --</muted>'];
        }

        // Color palette for cable pairs
        $colors = [
            'fg=red',
            'fg=green',
            'fg=yellow',
            'fg=blue',
            'fg=magenta',
            'fg=cyan',
            'fg=red;options=bold',
            'fg=green;options=bold',
            'fg=yellow;options=bold',
            'fg=blue;options=bold',
            'fg=magenta;options=bold',
            'fg=cyan;options=bold',
            'fg=white;options=bold',
        ];

        $lines = [];
        $pairsPerLine = 5;
        $chunks = array_chunk($pairs, $pairsPerLine);

        foreach ($chunks as $chunk) {
            $content = '            ';

            foreach ($chunk as $pair) {
                $colorIndex = 0;
                foreach ($pairs as $pi => $p) {
                    if ($p === $pair) {
                        $colorIndex = $pi;
                        break;
                    }
                }
                $style = $colors[$colorIndex % \count($colors)];
                $a = $pair[0]->toChar();
                $b = $pair[1]->toChar();
                $content .= "<{$style}>{$a}<=>{$b}</> ";
            }

            $lines[] = $content;
        }

        return $lines;
    }

    /**
     * @return array<string>
     */
    private function renderStatus(?Letter $input, ?Letter $output): array
    {
        $inChar = $input ? $input->toChar() : '-';
        $outChar = $output ? $output->toChar() : '-';

        return [
            "            <steel>Input:</> <olive>{$inChar}</>     <cipher>==></cipher>     <steel>Output:</> <cipher>{$outChar}</>",
        ];
    }
}
