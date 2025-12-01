<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Console;

use JulienBoudry\EnigmaMachine\{Enigma, Letter, RotorPosition};
use Symfony\Component\Console\Cursor;
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
    }

    /**
     * Get the keyboard rows based on the entry wheel layout.
     *
     * @return array<int, array<string>>
     */
    private function getKeyboardRows(): array
    {
        $layout = $this->enigma->entryWheel->getWiringString();

        // Split into standard Enigma rows: 9, 8, 9 keys
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

        // Initial render
        $this->renderFrame(null, null);

        for ($i = 0; $i < $length; $i++) {
            $char = $text[$i];

            if (!ctype_alpha($char)) {
                continue; // Skip non-alpha for simulation
            }

            // Delay for animation effect
            usleep($delayMs * 1000);

            // Clear previous frame
            $this->cursor->moveUp($this->frameHeight);
            $this->cursor->clearOutput();

            // Encode letter
            $inputLetter = Letter::fromChar($char);
            $outputLetter = $this->enigma->encodeLetter($inputLetter);
            $result .= $outputLetter->toChar();

            // Render new frame
            $this->renderFrame($inputLetter, $outputLetter);
        }

        return $result;
    }

    private function renderFrame(?Letter $input, ?Letter $output): void
    {
        $buffer = [];

        // Top border
        $buffer[] = '<military>╔════════════════════[ 𝕰𝖓𝖎𝖌𝖒𝖆 𝕸𝖆𝖈𝖍𝖎𝖓𝖊 ]════════════════════╗</>';

        // Rotors
        $buffer[] = $this->renderRotors();

        // Separator
        $buffer[] = '<military>╟─✠──────────────────────────────────────────────────────✠─╢</>';

        // Lampboard
        $buffer = array_merge($buffer, $this->renderLampboard($output));

        // Separator
        $buffer[] = '<military>╟─✠──────────────────────────────────────────────────────✠─╢</>';

        // Keyboard
        $buffer = array_merge($buffer, $this->renderKeyboard($input));

        if ($this->enigma->hasPlugboard()) {
            // Separator
            $buffer[] = '<military>╟─✠──────────────────────────────────────────────────────✠─╢</>';

            // Plugboard
            $buffer = array_merge($buffer, $this->renderPlugboard());
        }

        // Input/Output info
        $buffer[] = '<military>╟─✠──────────────────────────────────────────────────────✠─╢</>';
        $inChar = $input ? $input->toChar() : '-';
        $outChar = $output ? $output->toChar() : '-';

        // Center the Input/Output block
        // "Input: X           Output: Y" is 28 chars wide
        // (58 - 28) / 2 = 15 padding left
        $paddingLeft = str_repeat(' ', 15);
        $paddingRight = str_repeat(' ', 15);

        $buffer[] = \sprintf(
            '<military>║</>%s<steel>𝕴𝖓𝖕𝖚𝖙:</> <olive>%s</>           <steel>𝕺𝖚𝖙𝖕𝖚𝖙:</> <cipher>%s</>%s<military>║</>',
            $paddingLeft,
            $inChar,
            $outChar,
            $paddingRight
        );

        // Bottom border
        $buffer[] = '<military>╚══════════════════════════════════════════════════════════╝</>';

        // Output the buffer
        foreach ($buffer as $line) {
            $this->output->writeln($line);
        }

        $this->frameHeight = \count($buffer);
    }

    private function renderRotors(): string
    {
        $config = $this->enigma->getConfiguration();
        $model = $this->enigma->model;

        // Get positions
        $p1 = $this->enigma->getPosition(RotorPosition::P1)->toChar();
        $p2 = $this->enigma->getPosition(RotorPosition::P2)->toChar();
        $p3 = $this->enigma->getPosition(RotorPosition::P3)->toChar();

        $rotorsDisplay = '';
        if ($model->requiresGreekRotor()) {
            $greekPos = $this->enigma->getPosition(RotorPosition::GREEK)->toChar();
            $rotorsDisplay .= "<steel>[</><olive>{$greekPos}</><steel>]</> ";
        }

        $rotorsDisplay .= "<steel>[</><olive>{$p3}</><steel>]</> <steel>[</><olive>{$p2}</><steel>]</> <steel>[</><olive>{$p1}</><steel>]</>";

        // Calculate padding to center the content
        // "Rotors: " (8 chars) + Rotors (11 or 15 chars)
        // Total content length: 19 or 23
        $contentLen = 8 + ($model->requiresGreekRotor() ? 15 : 11);
        $paddingLeftLen = (int) floor((58 - $contentLen) / 2);
        $paddingRightLen = 58 - $contentLen - $paddingLeftLen;

        return \sprintf(
            '<military>║</>%s<steel>𝕽𝖔𝖙𝖔𝖗𝖘:</> %s%s<military>║</>',
            str_repeat(' ', $paddingLeftLen),
            $rotorsDisplay,
            str_repeat(' ', $paddingRightLen)
        );
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
            $content = '';
            // Indentation
            $indent = match ($rowIndex) {
                0 => '       ',
                1 => '        ',
                default => '      ',
            };

            $content .= $indent;

            foreach ($row as $char) {
                if ($char === $litChar) {
                    $content .= "<cipher>({$char})</> ";
                } else {
                    $content .= "<muted> {$char} </> ";
                }
            }

            // Calculate visible length to pad right side
            // Visible length of each char block is 3 chars " X " or "(X)" plus 1 space = 4 chars.
            // Row 0: 9 chars * 4 = 36. Indent 7. Total 43.
            // Row 1: 8 chars * 4 = 32. Indent 8. Total 40.
            // Row 2: 9 chars * 4 = 36. Indent 6. Total 42.

            // Box width is 60 (inner 58).
            // 58 - 43 = 15 spaces padding.
            // 58 - 40 = 18 spaces padding.
            // 58 - 42 = 16 spaces padding.

            $paddingRight = match ($rowIndex) {
                0 => str_repeat(' ', 15),
                1 => str_repeat(' ', 18),
                default => str_repeat(' ', 16),
            };

            $formattedLines[] = "<military>║</>{$content}{$paddingRight}<military>║</>";
        }

        return $formattedLines;
    }

    /**
     * @return array<string>
     */
    private function renderPlugboard(): array
    {
        if (!$this->enigma->hasPlugboard()) {
            // Center "NO PLUGBOARD" in the 58-char space
            // "NO PLUGBOARD" is 12 chars. (58-12)/2 = 23 padding left/right.
            return ['<military>║</>' . str_repeat(' ', 23) . '<muted>𝕹𝕺 𝕻𝕷𝖀𝕲𝕭𝕺𝕬𝕽𝕯</>' . str_repeat(' ', 23) . '<military>║</>'];
        }

        $pairs = $this->enigma->plugboard->getPluggedPairs();

        // Map letters to colors
        $colors = [
            'fg=red', 'fg=green', 'fg=yellow', 'fg=blue', 'fg=magenta', 'fg=cyan',
            'fg=red;options=bold', 'fg=green;options=bold', 'fg=yellow;options=bold',
            'fg=blue;options=bold', 'fg=magenta;options=bold', 'fg=cyan;options=bold',
            'fg=white;options=bold',
        ];

        $letterStyles = [];
        foreach ($pairs as $index => $pair) {
            $style = $colors[$index % \count($colors)];
            $letterStyles[$pair[0]->value] = $style;
            $letterStyles[$pair[1]->value] = $style;
        }

        $rows = $this->getKeyboardRows();
        $formattedLines = [];

        foreach ($rows as $rowIndex => $row) {
            $content = '';
            // Indentation
            $indent = match ($rowIndex) {
                0 => '       ',
                1 => '        ',
                default => '      ',
            };

            $content .= $indent;

            foreach ($row as $char) {
                $letter = Letter::fromChar($char);

                if (isset($letterStyles[$letter->value])) {
                    // Plugged
                    $style = $letterStyles[$letter->value];
                    $content .= "<{$style}> {$char} </> ";
                } else {
                    // Not plugged
                    $content .= "<muted> {$char} </> ";
                }
            }

            // Padding logic same as lampboard
            $paddingRight = match ($rowIndex) {
                0 => str_repeat(' ', 15),
                1 => str_repeat(' ', 18),
                default => str_repeat(' ', 16),
            };

            $formattedLines[] = "<military>║</>{$content}{$paddingRight}<military>║</>";
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
            $content = '';
            // Indentation
            $indent = match ($rowIndex) {
                0 => '       ',
                1 => '        ',
                default => '      ',
            };

            $content .= $indent;

            foreach ($row as $char) {
                if ($char === $pressedChar) {
                    $content .= "<olive>[{$char}]</> ";
                } else {
                    $content .= "<steel> {$char} </> ";
                }
            }

            // Padding logic same as lampboard
            $paddingRight = match ($rowIndex) {
                0 => str_repeat(' ', 15),
                1 => str_repeat(' ', 18),
                default => str_repeat(' ', 16),
            };

            $formattedLines[] = "<military>║</>{$content}{$paddingRight}<military>║</>";
        }

        return $formattedLines;
    }
}
