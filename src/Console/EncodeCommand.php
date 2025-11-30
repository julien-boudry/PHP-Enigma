<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Console;

use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};
use Symfony\Component\Console\Input\{InputArgument, InputInterface, InputOption};
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command to encode text using the Enigma machine.
 *
 * The Enigma cipher is reciprocal: encoding and decoding are the SAME operation.
 * To decode a message, simply run it through Enigma again with identical settings.
 * This is a fundamental property of the Enigma machine's electrical circuit design.
 *
 * Example:
 *   encode("HELLO") → "MFNCZ"
 *   encode("MFNCZ") → "HELLO"  (same settings)
 */
#[AsCommand(
    name: 'encode',
    description: 'Encode text using the Enigma machine (decoding uses the same command with identical settings)'
)]
class EncodeCommand extends Command
{
    protected EnigmaStyle $io;
    protected function configure(): void
    {
        $modelChoices = implode(', ', array_map(fn(EnigmaModel $m) => $m->name, EnigmaModel::cases()));
        $reflectorChoices = implode(', ', array_map(fn(ReflectorType $r) => $r->name, ReflectorType::cases()));
        $rotorChoices = implode(', ', array_map(fn(RotorType $r) => $r->name, RotorType::cases()));

        // Build dynamic model descriptions for help
        $modelDescriptions = $this->buildModelDescriptions();

        // Get defaults from the first model
        $defaultModel = EnigmaModel::cases()[0];
        $defaults = $this->getDefaultsForModel($defaultModel);

        $this
            ->addArgument(
                'text',
                InputArgument::OPTIONAL,
                'The text to encode (A-Z only, or use --latin for automatic conversion). To decode, pass the encoded text with the same settings. Omit when using file mode.'
            )
            ->addOption(
                'input-binary-file',
                'i',
                InputOption::VALUE_REQUIRED,
                'Encode a binary file through Enigma (each byte → 2 letters, requires --output-file)'
            )
            ->addOption(
                'input-text-file',
                'I',
                InputOption::VALUE_REQUIRED,
                'Read text from a file and encode letter by letter (like command-line input)'
            )
            ->addOption(
                'output-file',
                'o',
                InputOption::VALUE_REQUIRED,
                'Write output to a file'
            )
            ->addOption(
                'to-binary',
                't',
                InputOption::VALUE_NONE,
                'Convert an Enigma-encoded file back to binary (reverse of binary file encoding)'
            )
            ->addOption(
                'model',
                'm',
                InputOption::VALUE_REQUIRED,
                "Enigma model to use: {$modelChoices}",
                $defaultModel->name
            )
            ->addOption(
                'rotors',
                'r',
                InputOption::VALUE_REQUIRED,
                "Rotors to use, from left to right (e.g., 'III-II-I' or 'BETA-III-II-I' for M4). Available: {$rotorChoices}",
                $defaults['rotors']
            )
            ->addOption(
                'ring',
                'g',
                InputOption::VALUE_REQUIRED,
                "Ring settings (Ringstellung), from left to right (e.g., 'AAA' or 'AAAA' for M4)",
                $defaults['ring']
            )
            ->addOption(
                'position',
                'p',
                InputOption::VALUE_REQUIRED,
                "Initial rotor positions (Grundstellung), from left to right (e.g., 'AAA' or 'AAAA' for M4)",
                $defaults['position']
            )
            ->addOption(
                'reflector',
                'u',
                InputOption::VALUE_REQUIRED,
                "Reflector (Umkehrwalze) to use: {$reflectorChoices}",
                $defaults['reflector']
            )
            ->addOption(
                'plugboard',
                'b',
                InputOption::VALUE_REQUIRED,
                "Plugboard connections (Steckerbrett), space-separated pairs (e.g., 'AV BS CG')",
                ''
            )
            ->addOption(
                'latin',
                'l',
                InputOption::VALUE_NONE,
                'Convert Latin text (accents, numbers, punctuation) to Enigma format before encoding'
            )
            ->addOption(
                'strip-spaces',
                'x',
                InputOption::VALUE_NONE,
                'Remove spaces from input (useful for decoding formatted 5-letter groups)'
            )
            ->addOption(
                'format',
                'f',
                InputOption::VALUE_NONE,
                'Format output in 5-letter groups (traditional Enigma format)'
            )
            ->addOption(
                'random',
                null,
                InputOption::VALUE_NONE,
                'Generate a random configuration for the specified model (ignores other rotor/reflector options)'
            )
            ->addOption(
                'show-config',
                's',
                InputOption::VALUE_NONE,
                'Display the configuration used for encoding'
            )
            ->addOption(
                'no-strict',
                null,
                InputOption::VALUE_NONE,
                'Disable strict mode (allow non-historical configurations like plugboard on commercial models)'
            )
            ->setHelp(
                <<<HELP
                    The <info>%command.name%</info> command encodes text using the Enigma cipher machine.

                    <comment>⚡ RECIPROCAL CIPHER:</comment>
                    Enigma is a <options=bold>reciprocal cipher</> - encoding and decoding are the SAME operation.
                    To decode a message, simply pass it through Enigma again with <options=bold>identical settings</>.
                    This is a fundamental property of Enigma's electrical circuit design.

                    <comment>Example - Encode then Decode:</comment>
                      <info>%command.full_name% "HELLOWORLD"</info>              → MFNCZBBFZM
                      <info>%command.full_name% "MFNCZBBFZM"</info>              → HELLOWORLD (decoded!)

                    <comment>Basic usage:</comment>
                      <info>%command.full_name% "HELLO WORLD"</info>
                      <info>%command.full_name% "HELLOWORLD" --rotors=I-II-III --position=ABC</info>

                    <comment>Text file encoding:</comment>
                      <info>%command.full_name% -I message.txt</info>
                      <info>%command.full_name% --input-text-file=message.txt --latin -o encoded.txt</info>

                    <comment>Binary file encoding (byte → 2 letters):</comment>
                      <info>%command.full_name% -i photo.jpg -o photo.jpg.enigma</info>
                      <info>%command.full_name% -i photo.jpg.enigma -o photo_decoded.jpg -t</info>  (decode back)

                    <comment>Random configuration:</comment>
                      <info>%command.full_name% "SECRET" --random --show-config</info>

                    <comment>Latin text conversion:</comment>
                      <info>%command.full_name% "Héllo, Wörld! 123" --latin</info>

                    <comment>Available models:</comment>
                    {$modelDescriptions}
                    HELP
            );
    }

    /**
     * Build dynamic model descriptions for the help text.
     */
    private function buildModelDescriptions(): string
    {
        $descriptions = [];

        foreach (EnigmaModel::cases() as $model) {
            $rotorCount = $model->getExpectedRotorCount();
            $plugboard = $model->hasPlugboard() ? 'with plugboard' : 'no plugboard';

            // Get compatible rotors for this model
            $compatibleRotors = RotorType::getCompatibleRotorsForModel($model);
            $rotorNames = array_map(fn(RotorType $r) => $r->name, $compatibleRotors);

            // Add Greek rotors for M4
            if ($model->requiresGreekRotor()) {
                $greekRotors = array_map(fn(RotorType $r) => $r->name, RotorType::getGreekRotors());
                $rotorNames = array_merge($greekRotors, $rotorNames);
            }

            // Get compatible reflectors
            $compatibleReflectors = $model->getCompatibleReflectors();
            $reflectorNames = array_map(fn(ReflectorType $r) => $r->name, $compatibleReflectors);

            $modelName = str_pad($model->name, 8);
            $descriptions[] = "  {$modelName} - {$rotorCount} rotors, {$plugboard}";
            $descriptions[] = '             Rotors: ' . implode(', ', $rotorNames);
            $descriptions[] = '             Reflectors: ' . implode(', ', $reflectorNames);
        }

        return implode("\n", $descriptions);
    }

    /**
     * Get default values for a given model.
     *
     * @return array{rotors: string, ring: string, position: string, reflector: string}
     */
    private function getDefaultsForModel(EnigmaModel $model): array
    {
        $rotorCount = $model->getExpectedRotorCount();

        // Get compatible rotors for this model
        $compatibleRotors = RotorType::getCompatibleRotorsForModel($model);

        // Build default rotor string (take first N rotors, reversed for left-to-right display)
        $defaultRotors = \array_slice($compatibleRotors, 0, $rotorCount);
        if ($model->requiresGreekRotor()) {
            // For M4, prepend a Greek rotor
            $greekRotors = RotorType::getGreekRotors();
            array_unshift($defaultRotors, $greekRotors[0]);
            $defaultRotors = \array_slice($defaultRotors, 0, $rotorCount);
        }
        $rotorNames = array_map(fn(RotorType $r) => $r->name, array_reverse($defaultRotors));
        $rotorsStr = implode('-', $rotorNames);

        // Default ring and position settings (all A's)
        $ringPosition = str_repeat('A', $rotorCount);

        // Get first compatible reflector
        $compatibleReflectors = $model->getCompatibleReflectors();
        $reflectorName = $compatibleReflectors[0]->name;

        return [
            'rotors' => $rotorsStr,
            'ring' => $ringPosition,
            'position' => $ringPosition,
            'reflector' => $reflectorName,
        ];
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = new EnigmaStyle($input, $output);

        try {
            /** @var bool $isRandom */
            $isRandom = $input->getOption('random');

            /** @var string|null $inputBinaryFile */
            $inputBinaryFile = $input->getOption('input-binary-file');

            /** @var string|null $outputFile */
            $outputFile = $input->getOption('output-file');

            /** @var bool $toBinary */
            $toBinary = $input->getOption('to-binary');

            // Binary file mode: use Enigma's encodeFile/decodeFile methods
            if ($inputBinaryFile !== null) {
                return $this->executeBinaryFileMode($input, $inputBinaryFile, $outputFile, $toBinary, $isRandom);
            }

            // Text mode (from argument or text file)
            return $this->executeTextMode($input, $isRandom);
        } catch (\InvalidArgumentException|\ValueError $e) {
            $this->io->militaryError($e->getMessage());

            return Command::FAILURE;
        } catch (\RuntimeException $e) {
            $this->io->militaryError($e->getMessage());

            return Command::FAILURE;
        } catch (\Throwable $e) {
            $this->io->militaryError('An unexpected error occurred: ' . $e->getMessage());

            if ($output->isVerbose()) {
                $output->writeln($e->getTraceAsString());
            }

            return Command::FAILURE;
        }
    }

    /**
     * Execute text encoding mode (from command-line argument or file).
     */
    private function executeTextMode(InputInterface $input, bool $isRandom): int
    {
        /** @var string|null $inputTextFile */
        $inputTextFile = $input->getOption('input-text-file');

        // Get text from file or argument
        if ($inputTextFile !== null) {
            if (!file_exists($inputTextFile)) {
                throw new \InvalidArgumentException("Input file not found: {$inputTextFile}");
            }

            $text = file_get_contents($inputTextFile);
            if ($text === false) {
                throw new \InvalidArgumentException("Failed to read input file: {$inputTextFile}");
            }
        } else {
            /** @var string|null $textArg */
            $textArg = $input->getArgument('text');

            if ($textArg === null || $textArg === '') {
                throw new \InvalidArgumentException('No text provided. Use a text argument, --input-text-file, or --input-binary-file.');
            }

            $text = $textArg;
        }

        /** @var bool $noStrict */
        $noStrict = $input->getOption('no-strict');

        $enigma = $this->createEnigma($input, $isRandom, !$noStrict);

        /** @var bool $useLatin */
        $useLatin = $input->getOption('latin');

        /** @var bool $stripSpaces */
        $stripSpaces = $input->getOption('strip-spaces');

        /** @var bool $formatOutput */
        $formatOutput = $input->getOption('format');

        /** @var bool $showConfig */
        $showConfig = $input->getOption('show-config');

        /** @var string|null $outputFile */
        $outputFile = $input->getOption('output-file');

        // Strip spaces if requested (useful for decoding formatted groups)
        if ($stripSpaces) {
            $text = str_replace(' ', '', $text);
        }

        // Show intro
        $this->io->enigmaTitle();

        // Show random note
        if ($isRandom) {
            $this->io->militaryNote('Using randomly generated configuration');
        }

        // Show file source if from file
        if ($inputTextFile !== null) {
            $this->io->militaryInfo("Reading text from: {$inputTextFile}");

            // Warn about non-Enigma characters if not using latin mode
            if (!$useLatin) {
                $nonAlphaCount = preg_match_all('/[^A-Za-z]/', $text);
                if ($nonAlphaCount > 0) {
                    $this->io->militaryWarning("File contains {$nonAlphaCount} non-alphabetic characters that will be stripped.");
                    $this->io->militaryWarning('Use --latin (-l) to convert spaces, numbers, and accents automatically.');
                }
            }
        }

        // Show configuration
        if ($showConfig) {
            $this->displayConfiguration($enigma);
        }

        // Encode the text
        $result = $this->encodeText($enigma, $text, $useLatin, $formatOutput);

        // Output result
        $this->outputResult($result, $outputFile);

        $this->io->missionComplete('Encoding complete');

        return Command::SUCCESS;
    }

    /**
     * Execute binary file encoding mode using Enigma's encodeFile/decodeFile methods.
     */
    private function executeBinaryFileMode(
        InputInterface $input,
        string $inputFile,
        ?string $outputFile,
        bool $toBinary,
        bool $isRandom,
    ): int {
        if ($outputFile === null) {
            throw new \InvalidArgumentException('Binary file mode requires --output-file (-o) to be specified.');
        }

        /** @var bool $noStrict */
        $noStrict = $input->getOption('no-strict');

        $enigma = $this->createEnigma($input, $isRandom, !$noStrict);

        /** @var bool $showConfig */
        $showConfig = $input->getOption('show-config');

        // Show intro
        $this->io->enigmaTitle();

        // Show random note
        if ($isRandom) {
            $this->io->militaryNote('Using randomly generated configuration');
        }

        // Show configuration
        if ($showConfig) {
            $this->displayConfiguration($enigma);
        }

        // Show file info
        $mode = $toBinary ? 'Converting to binary' : 'Encoding binary';
        $this->io->militaryInfo("{$mode}: {$inputFile}");

        // Use Enigma's file encoding methods with progress bar
        $this->io->writeln('');
        $progressBar = $this->io->createProgressBar();
        $progressBar->setFormat(' %current%/%max% [%bar%] %percent:3s%% -- %message%');
        $progressBar->setMessage($toBinary ? 'Decoding file...' : 'Encoding file...');
        $progressBar->start(100);

        // Simulate progress (actual operation is atomic)
        $progressBar->advance(30);

        if ($toBinary) {
            $bytesWritten = $enigma->decodeFile($inputFile, $outputFile);
            $progressBar->advance(70);
            $progressBar->finish();
            $this->io->writeln('');
            $this->io->militaryInfo("Converted {$bytesWritten} bytes to: {$outputFile}");
        } else {
            $bytesWritten = $enigma->encodeFile($inputFile, $outputFile);
            $progressBar->advance(70);
            $progressBar->finish();
            $this->io->writeln('');
            $this->io->militaryInfo("Encoded to {$bytesWritten} characters: {$outputFile}");
        }

        $this->io->missionComplete('Operation complete');

        return Command::SUCCESS;
    }

    /**
     * Encode text using the Enigma machine.
     */
    private function encodeText(Enigma $enigma, string $text, bool $useLatin, bool $formatOutput): string
    {
        if ($useLatin) {
            return $enigma->encodeLatinText($text, 'X', $formatOutput);
        }

        // Clean input: remove non-alpha and convert to uppercase
        $cleanedText = strtoupper(preg_replace('/[^A-Za-z]/', '', $text) ?? $text);
        $result = $enigma->encodeLetters($cleanedText);

        if ($formatOutput) {
            $result = \JulienBoudry\EnigmaMachine\EnigmaTextConverter::formatInGroups($result);
        }

        return $result;
    }

    /**
     * Output the result to console or file.
     */
    private function outputResult(string $result, ?string $outputFile): void
    {
        if ($outputFile !== null) {
            $dir = \dirname($outputFile);
            if (!is_dir($dir)) {
                throw new \InvalidArgumentException("Output directory does not exist: {$dir}");
            }

            $written = file_put_contents($outputFile, $result);
            if ($written === false) {
                throw new \InvalidArgumentException("Failed to write output file: {$outputFile}");
            }

            $this->io->militaryInfo("Written to: {$outputFile}");
        } else {
            $this->io->encodedResult($result);
        }
    }

    /**
     * Display configuration table.
     */
    private function displayConfiguration(Enigma $enigma): void
    {
        $this->io->configTable($enigma);
    }

    /**
     * Create and configure the Enigma machine from input options.
     */
    private function createEnigma(InputInterface $input, bool $isRandom, bool $strictMode = true): Enigma
    {
        /** @var string $modelName */
        $modelName = $input->getOption('model');
        $model = $this->parseModel(strtoupper($modelName));

        if ($isRandom) {
            $enigma = Enigma::createRandom($model);
            $enigma->strictMode = $strictMode;
            return $enigma;
        }

        /** @var string $rotorsOption */
        $rotorsOption = $input->getOption('rotors');

        /** @var string $ringOption */
        $ringOption = $input->getOption('ring');

        /** @var string $positionOption */
        $positionOption = $input->getOption('position');

        /** @var string $reflectorOption */
        $reflectorOption = $input->getOption('reflector');

        $rotorTypes = $this->parseRotors($rotorsOption, $model);
        $ringSettings = $this->parseLetters($ringOption, 'ring setting');
        $positions = $this->parseLetters($positionOption, 'position');
        $reflector = $this->parseReflector($reflectorOption);

        // Validate counts
        $expectedCount = $model->getExpectedRotorCount();
        if (\count($rotorTypes) !== $expectedCount) {
            throw new \InvalidArgumentException(
                "Model {$model->name} requires {$expectedCount} rotors, got " . \count($rotorTypes)
            );
        }

        if (\count($ringSettings) !== $expectedCount) {
            throw new \InvalidArgumentException(
                "Model {$model->name} requires {$expectedCount} ring settings, got " . \count($ringSettings)
            );
        }

        if (\count($positions) !== $expectedCount) {
            throw new \InvalidArgumentException(
                "Model {$model->name} requires {$expectedCount} positions, got " . \count($positions)
            );
        }

        // Build rotor configuration (rotors are specified left to right, but RotorConfiguration expects right to left internally)
        // User provides: P3-P2-P1 (or GREEK-P3-P2-P1 for M4)
        // We need to reverse to get P1, P2, P3, [GREEK]
        $rotorTypes = array_reverse($rotorTypes);
        $ringSettings = array_reverse($ringSettings);
        $positions = array_reverse($positions);

        if ($model->requiresGreekRotor()) {
            // For M4: rotors are now [P1, P2, P3, GREEK]
            $rotorConfig = new RotorConfiguration(
                p1: $rotorTypes[0],
                p2: $rotorTypes[1],
                p3: $rotorTypes[2],
                greek: $rotorTypes[3],
                ringstellungP1: $ringSettings[0],
                ringstellungP2: $ringSettings[1],
                ringstellungP3: $ringSettings[2],
                ringstellungGreek: $ringSettings[3],
            );
        } else {
            // For 3-rotor models: rotors are now [P1, P2, P3]
            $rotorConfig = new RotorConfiguration(
                p1: $rotorTypes[0],
                p2: $rotorTypes[1],
                p3: $rotorTypes[2],
                ringstellungP1: $ringSettings[0],
                ringstellungP2: $ringSettings[1],
                ringstellungP3: $ringSettings[2],
            );
        }

        $enigma = new Enigma(
            model: $model,
            rotors: $rotorConfig,
            reflector: $reflector,
            strictMode: $strictMode,
        );

        // Set initial positions
        $enigma->setPosition(RotorPosition::P1, $positions[0]);
        $enigma->setPosition(RotorPosition::P2, $positions[1]);
        $enigma->setPosition(RotorPosition::P3, $positions[2]);

        if ($model->requiresGreekRotor()) {
            $enigma->setPosition(RotorPosition::GREEK, $positions[3]);
        }

        // Configure plugboard
        /** @var string $plugboardOption */
        $plugboardOption = $input->getOption('plugboard');
        $plugboardStr = trim($plugboardOption);
        if ($plugboardStr !== '') {
            if ($strictMode && !$model->hasPlugboard()) {
                $this->io->militaryWarning("Model {$model->name} does not have a plugboard. Ignoring plugboard settings (use --no-strict to override).");
            } else {
                $enigma->plugLettersFromPairs($plugboardStr);
            }
        }

        return $enigma;
    }

    /**
     * Parse model name to EnigmaModel enum.
     */
    private function parseModel(string $modelName): EnigmaModel
    {
        foreach (EnigmaModel::cases() as $model) {
            if ($model->name === $modelName) {
                return $model;
            }
        }

        $available = implode(', ', array_map(fn(EnigmaModel $m) => $m->name, EnigmaModel::cases()));

        throw new \InvalidArgumentException("Unknown model: {$modelName}. Available: {$available}");
    }

    /**
     * Parse rotors string (e.g., "III-II-I") to RotorType array.
     *
     * @return list<RotorType>
     */
    private function parseRotors(string $rotorsStr, EnigmaModel $model): array
    {
        $rotorNames = array_map('trim', explode('-', $rotorsStr));
        $rotors = [];

        foreach ($rotorNames as $name) {
            $name = strtoupper($name);
            $found = false;

            foreach (RotorType::cases() as $rotor) {
                if ($rotor->name === $name) {
                    $rotors[] = $rotor;
                    $found = true;

                    break;
                }
            }

            if (!$found) {
                $available = implode(', ', array_map(fn(RotorType $r) => $r->name, RotorType::cases()));

                throw new \InvalidArgumentException("Unknown rotor: {$name}. Available: {$available}");
            }
        }

        return $rotors;
    }

    /**
     * Parse letters string (e.g., "AAA") to Letter array.
     *
     * @return list<Letter>
     */
    private function parseLetters(string $lettersStr, string $context): array
    {
        $lettersStr = strtoupper($lettersStr);
        $letters = [];

        foreach (str_split($lettersStr) as $char) {
            if (!ctype_alpha($char)) {
                throw new \InvalidArgumentException("Invalid character in {$context}: {$char}. Only A-Z allowed.");
            }
            $letters[] = Letter::fromChar($char);
        }

        return $letters;
    }

    /**
     * Parse reflector name to ReflectorType enum.
     */
    private function parseReflector(string $reflectorName): ReflectorType
    {
        $reflectorName = strtoupper($reflectorName);

        foreach (ReflectorType::cases() as $reflector) {
            if ($reflector->name === $reflectorName) {
                return $reflector;
            }
        }

        $available = implode(', ', array_map(fn(ReflectorType $r) => $r->name, ReflectorType::cases()));

        throw new \InvalidArgumentException("Unknown reflector: {$reflectorName}. Available: {$available}");
    }
}
