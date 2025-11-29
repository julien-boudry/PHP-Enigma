<?php

declare(strict_types=1);

namespace JulienBoudry\EnigmaMachine\Console;

use Symfony\Component\Console\Application as BaseApplication;

/**
 * Enigma Machine Console Application.
 */
class Application extends BaseApplication
{
    public const NAME = 'Enigma Machine';
    public const VERSION = '1.0.0';

    public function __construct()
    {
        parent::__construct(self::NAME, self::VERSION);

        $encodeCommand = new EncodeCommand;

        $this->addCommands([
            $encodeCommand,
        ]);

        if ($encodeCommand->getName()) {
            $this->setDefaultCommand($encodeCommand->getName(), true);
        }
    }
}
