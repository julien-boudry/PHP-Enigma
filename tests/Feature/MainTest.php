<?php

declare(strict_types=1);
use JulienBoudry\Enigma\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

test('general', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        right: RotorType::I,
        middle: RotorType::II,
        left: RotorType::III,
        ringstellungRight: Letter::B,
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, Letter::M);

    $enigma->plugLetters(Letter::A, Letter::C);
    $enigma->plugLetters(Letter::B, Letter::Z);

    $enigma->unplugLetters(Letter::A);

    self::assertSame(Letter::A, $enigma->getPosition(RotorPosition::P3));
    self::assertSame(Letter::A, $enigma->getPosition(RotorPosition::P2));
    self::assertSame(Letter::M, $enigma->getPosition(RotorPosition::P1));

    self::assertSame(Letter::W, $enigma->encodeLetter(Letter::A));

    self::assertSame(Letter::A, $enigma->getPosition(RotorPosition::P3));
    self::assertSame(Letter::A, $enigma->getPosition(RotorPosition::P2));
    self::assertSame(Letter::N, $enigma->getPosition(RotorPosition::P1));

    self::assertSame(Letter::G, $enigma->encodeLetter(Letter::A));

    self::assertSame(Letter::A, $enigma->getPosition(RotorPosition::P3));
    self::assertSame(Letter::A, $enigma->getPosition(RotorPosition::P2));
    self::assertSame(Letter::O, $enigma->getPosition(RotorPosition::P1));
});

test('mountRotor allows changing a rotor after creation', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        right: RotorType::I,
        middle: RotorType::II,
        left: RotorType::III,
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, Letter::A);
    $enigma->setPosition(RotorPosition::P2, Letter::A);
    $enigma->setPosition(RotorPosition::P3, Letter::A);

    // Encode a letter with rotor I at P1
    $resultWithRotorI = $enigma->encodeLetter(Letter::A);

    // Reset position
    $enigma->setPosition(RotorPosition::P1, Letter::A);

    // Change rotor at P1 to rotor IV
    $enigma->rotors->mountRotor(RotorPosition::P1, RotorType::IV);

    // Encode the same letter - should produce different result
    $resultWithRotorIV = $enigma->encodeLetter(Letter::A);

    // Results should be different because we changed the rotor
    self::assertNotSame($resultWithRotorI, $resultWithRotorIV);

    // Same object instance
    self::assertSame($enigma->rotors, $rotorsConfiguration);
});

test('mountRotor with ringstellung', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        right: RotorType::I,
        middle: RotorType::II,
        left: RotorType::III,
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, Letter::A);
    $enigma->setPosition(RotorPosition::P2, Letter::A);
    $enigma->setPosition(RotorPosition::P3, Letter::A);

    // Encode with default ringstellung (A)
    $resultWithRingA = $enigma->encodeLetter(Letter::A);

    // Reset position
    $enigma->setPosition(RotorPosition::P1, Letter::A);

    // Mount same rotor type but with different ringstellung
    $rotorsConfiguration->mountRotor(RotorPosition::P1, RotorType::I, Letter::B);

    // Encode the same letter - should produce different result due to ringstellung
    $resultWithRingB = $enigma->encodeLetter(Letter::A);

    self::assertNotSame($resultWithRingA, $resultWithRingB);
});

test('duplicate rotor throws exception in constructor', function (): void {
    expect(fn() => new RotorConfiguration(
        right: RotorType::I,
        middle: RotorType::I, // Duplicate!
        left: RotorType::III,
    ))->toThrow(InvalidArgumentException::class, 'Rotor I is already mounted');
});

test('duplicate rotor throws exception in mountRotor', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        right: RotorType::I,
        middle: RotorType::II,
        left: RotorType::III,
    );

    expect(fn() => $rotorsConfiguration->mountRotor(RotorPosition::P2, RotorType::I))
        ->toThrow(InvalidArgumentException::class, 'Rotor I is already mounted');
});

test('replacing same position with different rotor is allowed', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        right: RotorType::I,
        middle: RotorType::II,
        left: RotorType::III,
    );

    // This should not throw - we're replacing P1 with a different rotor
    $rotorsConfiguration->mountRotor(RotorPosition::P1, RotorType::IV);

    expect($rotorsConfiguration->getRight()->getType())->toBe(RotorType::IV);
});

test('greek rotor in non-greek position throws exception', function (): void {
    expect(fn() => new RotorConfiguration(
        right: RotorType::BETA, // Greek rotor in wrong position!
        middle: RotorType::II,
        left: RotorType::III,
    ))->toThrow(InvalidArgumentException::class, 'Greek rotors (BETA/GAMMA) can only be mounted in the GREEK position');
});

test('non-greek rotor in greek position throws exception', function (): void {
    expect(fn() => new RotorConfiguration(
        right: RotorType::I,
        middle: RotorType::II,
        left: RotorType::III,
        greek: RotorType::IV, // Non-greek rotor in greek position!
    ))->toThrow(InvalidArgumentException::class, 'Only Greek rotors (BETA/GAMMA) can be mounted in the GREEK position');
});

test('incompatible rotor for model throws exception', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        right: RotorType::VI, // Only available for KMM3/KMM4
        middle: RotorType::II,
        left: RotorType::III,
    );

    expect(fn() => $rotorsConfiguration->validateForModel(EnigmaModel::WMLW))
        ->toThrow(InvalidArgumentException::class, 'Rotor VI at position P1 is not compatible with model WMLW');
});

// https://cryptii.com/pipes/enigma-machine
// public function testRandom(): void
// {
//     $rotors = [RotorType::I, RotorType::II, RotorType::III];
//     $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
//     $enigma->setPosition(RotorPosition::P1, Letter::A);
//     $enigma->setPosition(RotorPosition::P2, Letter::E);
//     $enigma->setPosition(RotorPosition::P3, Letter::M);
//     $enigma->setRingstellung(RotorPosition::P1, Letter::I);
//     $enigma->setRingstellung(RotorPosition::P2, Letter::E);
//     $enigma->setRingstellung(RotorPosition::P3, Letter::R);
//     $enigma->plugLetters(Letter::A, Letter::E);
//     $enigma->plugLetters(Letter::B, Letter::F);
//     $enigma->plugLetters(Letter::C, Letter::M);
//     $enigma->plugLetters(Letter::D, Letter::Q);
//     $enigma->plugLetters(Letter::H, Letter::U);
//     $enigma->plugLetters(Letter::J, Letter::N);
//     $enigma->plugLetters(Letter::L, Letter::X);
//     $enigma->plugLetters(Letter::P, Letter::R);
//     $enigma->plugLetters(Letter::S, Letter::Z);
//     $enigma->plugLetters(Letter::V, Letter::W);
//     self::assertSame(Letter::H, $enigma->encodeLetter(Letter::Q));
//     self::assertSame(Letter::Z, $enigma->encodeLetter(Letter::E));
// }
