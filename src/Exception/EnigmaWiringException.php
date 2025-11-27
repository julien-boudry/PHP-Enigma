<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Exception;

/**
 * Exception thrown when wiring configuration is invalid.
 *
 * This exception is thrown for hardware-level wiring errors that cannot be
 * bypassed, such as:
 * - Invalid DORA reflector pairs (wrong count, duplicate letters, self-connections)
 * - Invalid rotor wiring configurations
 *
 * Unlike EnigmaConfigurationException, this exception is NOT affected by strictMode
 * because invalid wiring would cause the machine to malfunction.
 */
class EnigmaWiringException extends \Exception {}
