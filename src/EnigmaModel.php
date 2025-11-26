<?php

declare(strict_types=1);

namespace JulienBoudry\Enigma;

/**
 * Enumeration of Enigma machine models.
 *
 * Defines the different historical Enigma machine variants that can be emulated.
 * Each model has its own specific set of available rotors and reflectors.
 *
 * @package Enigma
 */
enum EnigmaModel
{
    /**
     * Wehrmacht/Luftwaffe (3-rotor model).
     */
    case WMLW;

    /**
     * Kriegsmarine M3 (3-rotor model).
     */
    case KMM3;

    /**
     * Kriegsmarine M4 (4-rotor model).
     */
    case KMM4;
}
