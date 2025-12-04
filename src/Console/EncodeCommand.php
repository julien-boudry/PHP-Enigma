<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Console;

use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, EnigmaTextConverter, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};
use JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;
use Symfony\Component\Console\Input\{ArgvInput, InputArgument, InputInterface, InputOption};
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
    protected bool $isInteractive = false;

    /**
     * Options explicitly provided via execute() for testing purposes.
     *
     * @var array<string, mixed>
     */
    private array $explicitlyProvidedOptions = [];

    /**
     * Check if an option was explicitly provided on the command line.
     * This is needed because Symfony doesn't distinguish between default values
     * and user-provided values that happen to match the default.
     *
     * @param string $optionName The option name (without -- prefix)
     * @param InputInterface $input The input interface to check
     *
     * @return bool True if the option was explicitly provided
     */
    private function wasOptionProvided(string $optionName, InputInterface $input): bool
    {
        // First check if it was provided via CommandTester's execute() (for testing)
        if (isset($this->explicitlyProvidedOptions[$optionName])) {
            return true;
        }

        // Use Symfony's hasParameterOption via ArgvInput for real CLI usage
        if ($input instanceof ArgvInput) {
            $shortOptions = [
                'model' => 'm',
                'rotors' => 'r',
                'ring' => 'g',
                'position' => 'p',
                'reflector' => 'u',
                'plugboard' => 'b',
                'random' => 'R',
                'dora-wiring' => 'd',
            ];

            // Check long option
            if ($input->hasParameterOption("--{$optionName}", true)) {
                return true;
            }

            // Check short option
            if (isset($shortOptions[$optionName])) {
                $short = $shortOptions[$optionName];
                if ($input->hasParameterOption("-{$short}", true)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Store options that were explicitly provided (for testing with CommandTester).
     *
     * @param array<string, mixed> $options
     */
    public function setExplicitlyProvidedOptions(array $options): void
    {
        $this->explicitlyProvidedOptions = $options;
    }

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
                'dora-wiring',
                'd',
                InputOption::VALUE_REQUIRED,
                "Custom wiring for UKW-D (Dora) reflector, 12 pairs (e.g., 'AC BO DE FG HI KL MN PQ RS TU VW XZ'). J↔Y pair is fixed.",
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
                'R',
                InputOption::VALUE_NONE,
                'Generate a random configuration for the specified model (ignores other rotor/reflector options)'
            )
            ->addOption(
                'no-strict',
                null,
                InputOption::VALUE_NONE,
                'Disable strict mode (allow non-historical configurations like plugboard on commercial models)'
            )
            ->addOption(
                'raw',
                null,
                InputOption::VALUE_NONE,
                'Output raw encoded text without decoration (useful for pipes)'
            )
            ->addOption(
                'delay',
                null,
                InputOption::VALUE_REQUIRED,
                'Animation delay between letters in milliseconds (interactive mode only)',
                '250'
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
                      <info>%command.full_name% "SECRET" --random</info>

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

            /** @var string|null $textArg */
            $textArg = $input->getArgument('text');

            /** @var string|null $inputTextFile */
            $inputTextFile = $input->getOption('input-text-file');

            // Determine if we should enter interactive mode
            // Interactive mode is triggered when:
            // - No text argument provided
            // - No input file provided
            // - Not explicitly disabled with --no-interaction (-n)
            // - Terminal supports interaction
            // - STDIN is a TTY (not piped)

            $isStdinTty = true;
            if (\defined('STDIN')) {
                $isStdinTty = stream_isatty(\STDIN);
            }

            $this->isInteractive = $textArg === null
                && $inputBinaryFile === null
                && $inputTextFile === null
                && $input->isInteractive()
                && $isStdinTty;

            if ($this->isInteractive) {
                return $this->executeInteractiveMode($input, $output);
            }

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
     * Execute in interactive mode - ask for missing options step by step.
     */
    private function executeInteractiveMode(InputInterface $input, OutputInterface $output): int
    {
        $this->io->interactiveWelcome();

        // Step tracking - will be recalculated after model selection
        $currentStep = 0;

        // =====================================================================
        // STEP 1: Model Selection
        // =====================================================================
        $currentStep++;
        /** @var string $modelOption */
        $modelOption = $input->getOption('model');
        $defaultModel = EnigmaModel::cases()[0];
        $userProvidedModel = $this->wasOptionProvided('model', $input);

        // Calculate total steps (will recalculate after model is known)
        $totalSteps = $this->calculateTotalSteps($defaultModel);

        if (!$userProvidedModel) {
            $this->io->interactiveStep($currentStep, $totalSteps, 'Select Enigma Model');
            $this->io->interactiveHints([
                'Military models (WMLW, KMM3, KMM4) have plugboards for extra security.',
                'Commercial models are simpler but historically interesting.',
                'KMM4 is the famous 4-rotor naval Enigma used by U-boats.',
            ]);

            $modelChoices = $this->buildModelChoices();
            $selectedModel = $this->io->interactiveChoice('Which Enigma model?', $modelChoices, $defaultModel->name);
            $model = $this->parseModel($this->extractModelName($selectedModel));
            // Recalculate total steps based on selected model
            $totalSteps = $this->calculateTotalSteps($model);
        } else {
            $model = $this->parseModel(strtoupper($modelOption));
            // Recalculate total steps based on selected model
            $totalSteps = $this->calculateTotalSteps($model);
            $this->io->interactiveSelected('Model', $model->name . ' (from command line)');
        }

        // =====================================================================
        // STEP 2: Random or Manual Configuration
        // =====================================================================
        $currentStep++;
        /** @var bool $isRandom */
        $isRandom = $input->getOption('random');
        $userProvidedRandom = $this->wasOptionProvided('random', $input);

        if (!$userProvidedRandom && !$isRandom) {
            $this->io->interactiveStep($currentStep, $totalSteps, 'Configuration Mode');
            $this->io->interactiveHints([
                'Random mode generates a secure configuration automatically.',
                'Manual mode lets you specify exact settings (useful for decoding).',
            ]);

            $configMode = $this->io->interactiveChoice(
                'How would you like to configure the machine?',
                [
                    'manual' => '🔧 Manual - Specify each setting',
                    'random' => '🎲 Random - Generate secure random settings',
                ],
                'manual'
            );

            $isRandom = $configMode === 'random';
        } else {
            $this->io->interactiveSelected('Mode', 'Random (from command line)');
        }

        // Get defaults for the selected model (used for actual default values)
        $defaults = $this->getDefaultsForModel($model);

        // Variables to store configuration
        $rotorsStr = $defaults['rotors'];
        $ringStr = $defaults['ring'];
        $positionStr = $defaults['position'];
        $reflectorStr = $defaults['reflector'];
        $doraPairsStr = ''; // Custom DORA wiring (if applicable)
        $plugboardStr = '';

        if (!$isRandom) {
            // =================================================================
            // STEP 3: Rotor Selection
            // =================================================================
            $currentStep++;
            /** @var string $rotorsOption */
            $rotorsOption = $input->getOption('rotors');
            $userProvidedRotors = $this->wasOptionProvided('rotors', $input);

            if (!$userProvidedRotors) {
                $this->io->interactiveStep($currentStep, $totalSteps, 'Select Rotors');
                $rotorsStr = $this->interactiveSelectRotors($model);
            } else {
                $rotorsStr = $rotorsOption;
                $this->io->interactiveSelected('Rotors', $rotorsStr . ' (from command line)');
            }

            // =================================================================
            // STEP 4: Ring Settings (Ringstellung)
            // =================================================================
            $currentStep++;
            /** @var string $ringOption */
            $ringOption = $input->getOption('ring');
            $userProvidedRing = $this->wasOptionProvided('ring', $input);
            $rotorCount = $model->getExpectedRotorCount();

            if (!$userProvidedRing) {
                $this->io->interactiveStep($currentStep, $totalSteps, 'Ring Settings (Ringstellung)');
                $this->io->interactiveHints([
                    'Ring settings offset the internal wiring of each rotor.',
                    "Enter {$rotorCount} letters (A-Z), one per rotor from left to right.",
                    'Default AAA' . ($rotorCount === 4 ? 'A' : '') . ' is a neutral starting point.',
                ]);

                $ringStr = $this->io->interactiveLetters(
                    "Ring settings ({$rotorCount} letters)",
                    $rotorCount,
                    $defaults['ring']
                );
            } else {
                $ringStr = $ringOption;
                $this->io->interactiveSelected('Ring', $ringStr . ' (from command line)');
            }

            // =================================================================
            // STEP 5: Initial Positions (Grundstellung)
            // =================================================================
            $currentStep++;
            /** @var string $positionOption */
            $positionOption = $input->getOption('position');
            $userProvidedPosition = $this->wasOptionProvided('position', $input);

            if (!$userProvidedPosition) {
                $this->io->interactiveStep($currentStep, $totalSteps, 'Initial Positions (Grundstellung)');
                $this->io->interactiveHints([
                    'Initial positions are the visible letters when you start encoding.',
                    'Both sender and receiver must use the same starting position.',
                    'This was often transmitted as a message indicator.',
                ]);

                $positionStr = $this->io->interactiveLetters(
                    "Starting positions ({$rotorCount} letters)",
                    $rotorCount,
                    $defaults['position']
                );
            } else {
                $positionStr = $positionOption;
                $this->io->interactiveSelected('Position', $positionStr . ' (from command line)');
            }

            // =================================================================
            // STEP 6: Reflector Selection
            // =================================================================
            $currentStep++;
            /** @var string $reflectorOption */
            $reflectorOption = $input->getOption('reflector');
            $userProvidedReflector = $this->wasOptionProvided('reflector', $input);

            // Check if DORA wiring was provided via command line
            /** @var string|null $doraWiringOption */
            $doraWiringOption = $input->getOption('dora-wiring');
            $userProvidedDoraWiring = $this->wasOptionProvided('dora-wiring', $input);

            if (!$userProvidedReflector) {
                $this->io->interactiveStep($currentStep, $totalSteps, 'Select Reflector (Umkehrwalze)');
                $reflectorResult = $this->interactiveSelectReflector($model);
                $reflectorStr = $reflectorResult['reflector'];
                $doraPairsStr = $reflectorResult['doraPairs'];
            } else {
                $reflectorStr = $reflectorOption;
                // If DORA reflector with custom wiring from command line
                if ($userProvidedDoraWiring && $doraWiringOption !== null && $doraWiringOption !== '') {
                    $doraPairsStr = $doraWiringOption;
                    $this->io->interactiveSelected('Reflector', $reflectorStr . ' with custom wiring (from command line)');
                } else {
                    $this->io->interactiveSelected('Reflector', $reflectorStr . ' (from command line)');
                }
            }

            // =================================================================
            // STEP 7: Plugboard (only for models with plugboard)
            // =================================================================
            if ($model->hasPlugboard()) {
                $currentStep++;
                /** @var string $plugboardOption */
                $plugboardOption = $input->getOption('plugboard');
                $userProvidedPlugboard = $this->wasOptionProvided('plugboard', $input);

                if (!$userProvidedPlugboard) {
                    $this->io->interactiveStep($currentStep, $totalSteps, 'Plugboard Connections (Steckerbrett)');
                    $maxPairs = (int) (\count(Letter::cases()) / 2);
                    $this->io->interactiveHints([
                        'The plugboard swaps pairs of letters before and after the rotors.',
                        'Enter pairs like: AB CD EF (swaps A↔B, C↔D, E↔F)',
                        "Up to {$maxPairs} pairs possible. Leave empty for no plugboard.",
                        'Historical messages typically used 10 pairs.',
                    ]);

                    $plugboardStr = $this->io->interactivePlugboard('Plugboard pairs (or empty)');
                } else {
                    $plugboardStr = $plugboardOption;
                    $this->io->interactiveSelected('Plugboard', $plugboardStr ?: '(none)' . ' (from command line)');
                }
            } else {
                $this->io->interactiveSkipped('Plugboard', "Model {$model->name} does not have a plugboard");
            }
        } else {
            // Skip manual steps for random mode
            $this->io->interactiveSkipped('Manual settings', 'Using random configuration');
        }

        // =====================================================================
        // FINAL: Text Input
        // =====================================================================
        $this->io->interactiveStep($totalSteps, $totalSteps, 'Enter Message');
        $this->io->interactiveHints([
            'Enigma only encodes letters A-Z. Numbers and punctuation will be stripped.',
            'Use --latin option to automatically convert special characters.',
            'Remember: encoding and decoding use the SAME settings!',
        ]);

        /** @var bool $useLatin */
        $useLatin = $input->getOption('latin');
        if (!$useLatin) {
            $useLatin = $this->io->interactiveConfirm('Convert special characters (accents, numbers)?', false);
        }

        $text = $this->io->interactiveText('Message to encode');

        /** @var bool $formatOutput */
        $formatOutput = $input->getOption('format');
        if (!$formatOutput) {
            $formatOutput = $this->io->interactiveConfirm('Format output in 5-letter groups?', true);
        }

        // =====================================================================
        // Build and Execute
        // =====================================================================
        $this->io->interactiveDivider();
        $this->io->newLine();

        /** @var bool $noStrict */
        $noStrict = $input->getOption('no-strict');

        if ($isRandom) {
            $enigma = Enigma::createRandom($model);
            $enigma->strictMode = !$noStrict;
        } else {
            // Create Enigma from collected settings
            $enigma = $this->createEnigmaFromSettings(
                $model,
                $rotorsStr,
                $ringStr,
                $positionStr,
                $reflectorStr,
                $plugboardStr,
                !$noStrict,
                $doraPairsStr
            );
        }

        // Show configuration summary
        $this->io->enigmaTitle();

        if ($isRandom) {
            $this->io->militaryNote('Using randomly generated configuration');
        }

        $this->displayConfiguration($enigma);

        // Encode and output
        // In interactive mode, we use the simulator for visual feedback
        if ($useLatin) {
            $textToEncode = EnigmaTextConverter::latinToEnigmaFormat($text, 'X');
        } else {
            $textToEncode = strtoupper(preg_replace('/[^A-Za-z]/', '', $text) ?? $text);
        }

        $simulator = new EnigmaSimulator($output, $enigma);
        $this->io->newLine();
        $this->io->militaryInfo('Initializing Enigma Simulation...');
        $this->io->newLine();
        sleep(1);

        /** @var string $delayOption */
        $delayOption = $input->getOption('delay');
        $delayMs = filter_var($delayOption, \FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
        if ($delayMs === false) {
            throw new \InvalidArgumentException("Invalid delay value: {$delayOption}. Must be a positive integer (milliseconds).");
        }
        $encodedText = $simulator->simulate($textToEncode, $delayMs);

        if ($formatOutput) {
            $result = EnigmaTextConverter::formatInGroups($encodedText);
        } else {
            $result = $encodedText;
        }

        /** @var string|null $outputFile */
        $outputFile = $input->getOption('output-file');
        $this->outputResult($result, $outputFile);

        $this->io->missionComplete('Encoding complete');

        // Show hint for decoding
        $this->io->newLine();
        $this->io->militaryNote('To decode, run the same command with the encoded text and identical settings.');

        return Command::SUCCESS;
    }

    /**
     * Build model choices with descriptions for interactive selection.
     *
     * @return array<string, string>
     */
    private function buildModelChoices(): array
    {
        $choices = [];

        foreach (EnigmaModel::cases() as $model) {
            $rotorCount = $model->getExpectedRotorCount();
            $plugboard = $model->hasPlugboard() ? '🔌 plugboard' : 'no plugboard';

            $choices[$model->name] = "{$model->getEmoji()} {$model->name} - {$model->getDescription()} ({$rotorCount}R, {$plugboard})";
        }

        return $choices;
    }

    /**
     * Extract model name from choice value.
     */
    private function extractModelName(string $choice): string
    {
        // The choice format is "MODEL_NAME" as the key
        return $choice;
    }

    /**
     * Interactive rotor selection for a given model.
     */
    private function interactiveSelectRotors(EnigmaModel $model): string
    {
        $rotorCount = $model->getExpectedRotorCount();
        $compatibleRotors = RotorType::getCompatibleRotorsForModel($model);
        $selectedRotors = [];

        // Build rotor choices with descriptions
        $rotorChoices = [];
        foreach ($compatibleRotors as $rotor) {
            $rotorChoices[$rotor->name] = $rotor->name;
        }

        // Handle Greek rotor for M4
        if ($model->requiresGreekRotor()) {
            $this->io->interactiveHints([
                'KMM4 requires a Greek rotor (BETA or GAMMA) in the leftmost position.',
                'Select the Greek rotor first, then the 3 regular rotors.',
            ]);

            $greekChoices = [];
            foreach (RotorType::getGreekRotors() as $greek) {
                $greekChoices[$greek->name] = $greek->name . ' - Greek rotor';
            }

            $defaultGreekRotor = RotorType::getGreekRotors()[0]->name;
            $greekRotor = $this->io->interactiveChoice(
                'Greek rotor (leftmost position)',
                $greekChoices,
                $defaultGreekRotor
            );
            $selectedRotors[] = $greekRotor;

            $this->io->interactiveHint('Now select the 3 regular rotors (positions 3, 2, 1 from left).');
        } else {
            $this->io->interactiveHints([
                "Select {$rotorCount} rotors for positions (left to right).",
                'Each rotor can only be used once.',
                'Different rotor combinations provide different encryption.',
            ]);
        }

        // Select remaining rotors
        $regularCount = $model->requiresGreekRotor() ? 3 : $rotorCount;
        $usedRotors = [];

        for ($i = 0; $i < $regularCount; $i++) {
            $position = $model->requiresGreekRotor() ? $i + 1 : $i + 1;
            $positionLabel = match ($i) {
                0 => $model->requiresGreekRotor() ? 'P3 (2nd from left)' : 'P3 (leftmost)',
                1 => 'P2 (middle)',
                2 => 'P1 (rightmost)',
                default => "Position {$position}",
            };

            // Filter out already used rotors
            $availableChoices = array_filter(
                $rotorChoices,
                fn($name) => !\in_array($name, $usedRotors, true),
                \ARRAY_FILTER_USE_KEY
            );

            $defaultRotor = array_key_first($availableChoices);
            $rotor = $this->io->interactiveChoice("Rotor for {$positionLabel}", $availableChoices, $defaultRotor);
            $selectedRotors[] = $rotor;
            $usedRotors[] = $rotor;
        }

        return implode('-', $selectedRotors);
    }

    /**
     * Interactive reflector selection for a given model.
     *
     * @return array{reflector: string, doraPairs: string} The reflector name and optional DORA pairs
     */
    private function interactiveSelectReflector(EnigmaModel $model): array
    {
        $compatibleReflectors = $model->getCompatibleReflectors();

        if (\count($compatibleReflectors) === 1) {
            $reflector = $compatibleReflectors[0]->name;
            $this->io->interactiveSelected('Reflector', "{$reflector} (only option for {$model->name})");

            return ['reflector' => $reflector, 'doraPairs' => ''];
        }

        $this->io->interactiveHints([
            'The reflector sends the signal back through the rotors.',
            'Different reflectors provide different encryption patterns.',
        ]);

        $reflectorChoices = [];
        foreach ($compatibleReflectors as $reflector) {
            $suffix = $reflector === ReflectorType::DORA ? ' 🔧' : '';
            $reflectorChoices[$reflector->name] = $reflector->name . ' - ' . $reflector->getDescription() . $suffix;
        }

        $selectedReflector = $this->io->interactiveChoice(
            'Select reflector',
            $reflectorChoices,
            $compatibleReflectors[0]->name
        );

        $doraPairs = '';

        // If DORA is selected, ask for custom wiring
        if ($selectedReflector === 'DORA') {
            $doraPairs = $this->interactiveConfigureDora();
        }

        return ['reflector' => $selectedReflector, 'doraPairs' => $doraPairs];
    }

    /**
     * Interactive configuration for UKW-D (Dora) reflector wiring.
     */
    private function interactiveConfigureDora(): string
    {
        $this->io->newLine();
        $this->io->militarySection('UKW-D (Dora) Reflector Configuration');
        $defaultWiring = ReflectorDora::DEFAULT_WIRING;
        $this->io->interactiveHints([
            'UKW-D is a rewirable reflector with 13 configurable wire pairs.',
            'Each pair connects two letters (e.g., AB connects A↔B).',
            'All 26 letters must be used exactly once.',
            "Default wiring: {$defaultWiring}",
        ]);

        $useDefault = $this->io->interactiveConfirm('Use default wiring?', true);

        if ($useDefault) {
            $this->io->interactiveSelected('Dora wiring', "Default ({$defaultWiring})");

            return ''; // Empty string means use default
        }

        // Custom wiring
        $this->io->newLine();
        $this->io->interactiveHints([
            'Enter 13 letter pairs separated by spaces.',
            "Example: {$defaultWiring}",
            'Each letter must appear exactly once.',
        ]);

        $validator = function (?string $value): string {
            if ($value === null || trim($value) === '') {
                throw new \RuntimeException('Please enter the 13 pairs or press Ctrl+C to cancel.');
            }

            $cleaned = preg_replace('/\s+/', '', strtoupper($value));
            if ($cleaned === null || \strlen($cleaned) !== 26) {
                throw new \RuntimeException('You must enter exactly 13 pairs (26 letters total). Got ' . \strlen($cleaned ?? '') . ' letters.');
            }

            // Validate all letters are used exactly once
            $letters = str_split($cleaned);
            $uniqueLetters = array_unique($letters);
            if (\count($uniqueLetters) !== 26) {
                $counts = array_count_values($letters);
                $duplicates = array_filter($counts, fn($c) => $c > 1);

                throw new \RuntimeException('Each letter must appear exactly once. Duplicates: ' . implode(', ', array_keys($duplicates)));
            }

            // Check all letters A-Z are present
            $missing = array_diff(range('A', 'Z'), $uniqueLetters);
            if (!empty($missing)) {
                throw new \RuntimeException('Missing letters: ' . implode(', ', $missing));
            }

            // Format nicely with spaces
            $pairs = str_split($cleaned, 2);

            return implode(' ', $pairs);
        };

        return $this->io->interactiveInput(
            'Enter 13 pairs',
            null,
            $defaultWiring,
            $validator
        );
    }

    /**
     * Create an Enigma machine from interactive settings.
     */
    private function createEnigmaFromSettings(
        EnigmaModel $model,
        string $rotorsStr,
        string $ringStr,
        string $positionStr,
        string $reflectorStr,
        string $plugboardStr,
        bool $strictMode = true,
        string $doraPairsStr = '',
    ): Enigma {
        $rotorTypes = $this->parseRotors($rotorsStr, $model);
        $ringSettings = $this->parseLetters($ringStr, 'ring setting');
        $positions = $this->parseLetters($positionStr, 'position');
        $reflectorType = $this->parseReflector($reflectorStr);

        // Build rotor configuration (reverse for internal representation)
        // Input order: left to right (e.g., GREEK-P3-P2-P1 for M4, or P3-P2-P1 for 3-rotor)
        // After reverse: P1-P2-P3-GREEK for M4, or P1-P2-P3 for 3-rotor
        $rotorTypes = array_reverse($rotorTypes);
        $ringSettings = array_reverse($ringSettings);
        $positions = array_reverse($positions);

        if ($model->requiresGreekRotor()) {
            // For M4: after reverse, indices are [0]=P1, [1]=P2, [2]=P3, [3]=GREEK
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
            // For 3-rotor models: indices are [0]=P1, [1]=P2, [2]=P3
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
            reflector: $reflectorType,
            strictMode: $strictMode,
        );

        // If DORA with custom wiring, remount with custom reflector
        if ($reflectorType === ReflectorType::DORA && $doraPairsStr !== '') {
            $customDora = ReflectorDora::fromString($doraPairsStr);
            $enigma->mountReflector($customDora);
        }

        // Set initial positions
        $enigma->setPosition(RotorPosition::P1, $positions[0]);
        $enigma->setPosition(RotorPosition::P2, $positions[1]);
        $enigma->setPosition(RotorPosition::P3, $positions[2]);

        if ($model->requiresGreekRotor()) {
            $enigma->setPosition(RotorPosition::GREEK, $positions[3]);
        }

        // Configure plugboard
        if ($plugboardStr !== '' && ($strictMode === false || $model->hasPlugboard())) {
            $enigma->plugLettersFromPairs($plugboardStr);
        }

        return $enigma;
    }

    /**
     * Execute text encoding mode (from command-line argument or file).
     */
    private function executeTextMode(InputInterface $input, bool $isRandom): int
    {
        /** @var string|null $inputTextFile */
        $inputTextFile = $input->getOption('input-text-file');

        // Get text from file, argument, or stdin
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
                // Try reading from stdin if available (piped input)
                $text = $this->readFromStdin();

                if ($text === null || $text === '') {
                    throw new \InvalidArgumentException('No text provided. Use a text argument, --input-text-file, --input-binary-file, or pipe text via stdin.');
                }
            } else {
                $text = $textArg;
            }
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

        /** @var string|null $outputFile */
        $outputFile = $input->getOption('output-file');

        /** @var bool $raw */
        $raw = $input->getOption('raw');

        // Strip spaces if requested (useful for decoding formatted groups)
        if ($stripSpaces) {
            $text = str_replace(' ', '', $text);
        }

        // Show intro
        if (!$raw) {
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

            // Always show configuration
            $this->displayConfiguration($enigma);
        }

        // Encode the text
        $result = $this->encodeText($enigma, $text, $useLatin, $formatOutput);

        // Output result
        $this->outputResult($result, $outputFile, $raw);

        if (!$raw) {
            $this->io->missionComplete('Encoding complete');
        }

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

        // Show intro
        $this->io->enigmaTitle();

        // Show random note
        if ($isRandom) {
            $this->io->militaryNote('Using randomly generated configuration');
        }

        // Always show configuration
        $this->displayConfiguration($enigma);

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
            $result = EnigmaTextConverter::formatInGroups($result);
        }

        return $result;
    }

    /**
     * Output the result to console or file.
     */
    private function outputResult(string $result, ?string $outputFile, bool $raw = false): void
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

            if (!$raw) {
                $this->io->militaryInfo("Written to: {$outputFile}");
            }
        } else {
            if ($raw) {
                // Raw output just prints the result string followed by a newline
                $this->io->writeln($result);
            } else {
                $this->io->encodedResult($result);
            }
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

        // Handle custom DORA wiring
        /** @var string $doraWiringOption */
        $doraWiringOption = $input->getOption('dora-wiring');
        $doraWiringStr = trim($doraWiringOption);

        if ($doraWiringStr !== '' && $reflector !== ReflectorType::DORA) {
            $this->io->militaryWarning('--dora-wiring is only valid with reflector DORA. Ignoring custom wiring.');
            $doraWiringStr = '';
        }

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

        // Create custom DORA reflector if wiring is specified
        $reflectorToUse = $reflector;
        if ($reflector === ReflectorType::DORA && $doraWiringStr !== '') {
            $reflectorToUse = ReflectorDora::fromString($doraWiringStr);
        }

        $enigma = new Enigma(
            model: $model,
            rotors: $rotorConfig,
            reflector: $reflectorToUse,
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

    /**
     * Read text from stdin if available (for piped input).
     *
     * @return string|null The text from stdin, or null if stdin is empty/not available
     */
    private function readFromStdin(): ?string
    {
        // Check if stdin has data available
        $stdin = \defined('STDIN') ? \STDIN : fopen('php://stdin', 'r');

        if ($stdin === false) {
            return null;
        }

        // If STDIN is a TTY, it means we are connected to a terminal, not a pipe.
        // In this case, we shouldn't block waiting for input.
        if (\function_exists('stream_isatty') && stream_isatty($stdin)) {
            return null;
        }

        // Read until EOF (blocking is fine here as we expect input in non-interactive mode)
        $text = stream_get_contents($stdin);

        if ($text === false || $text === '') {
            return null;
        }

        return trim($text);
    }

    /**
     * Calculate the total number of interactive steps based on the model.
     *
     * @param EnigmaModel $model The Enigma model
     *
     * @return int The total number of steps
     */
    private function calculateTotalSteps(EnigmaModel $model): int
    {
        // Base steps: Model (1) + Config Mode (1) + Rotors (1) + Ring (1) + Position (1) + Reflector (1) + Text (1) = 7
        // If model has plugboard: +1 step
        $baseSteps = 7;

        return $model->hasPlugboard() ? $baseSteps : $baseSteps - 1;
    }
}
