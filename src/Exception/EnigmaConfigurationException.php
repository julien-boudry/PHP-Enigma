<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma\Exception;

/**
 * Exception thrown when an Enigma machine configuration is invalid.
 *
 * This includes:
 * - Incompatible rotor/model combinations
 * - Incompatible reflector/model combinations
 * - Invalid rotor positions (e.g., Greek rotor in wrong position)
 * - Duplicate rotors
 *
 * These errors can be bypassed by setting strictMode to false.
 */
class EnigmaConfigurationException extends \Exception {}
