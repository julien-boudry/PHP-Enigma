<?php

declare(strict_types=1);

use JulienBoudry\Enigma\Exception\EnigmaConfigurationException;
use JulienBoudry\Enigma\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

test('general', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
        ringstellungP1: Letter::B,
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
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
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
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
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
        p1: RotorType::I,
        p2: RotorType::I, // Duplicate!
        p3: RotorType::III,
    ))->toThrow(EnigmaConfigurationException::class, 'Rotor I is already mounted');
});

test('duplicate rotor throws exception in mountRotor', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );

    expect(fn() => $rotorsConfiguration->mountRotor(RotorPosition::P2, RotorType::I))
        ->toThrow(EnigmaConfigurationException::class, 'Rotor I is already mounted');
});

test('replacing same position with different rotor is allowed', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );

    // This should not throw - we're replacing P1 with a different rotor
    $rotorsConfiguration->mountRotor(RotorPosition::P1, RotorType::IV);

    expect($rotorsConfiguration->getP1()->getType())->toBe(RotorType::IV);
});

test('greek rotor in non-greek position throws exception', function (): void {
    expect(fn() => new RotorConfiguration(
        p1: RotorType::BETA, // Greek rotor in wrong position!
        p2: RotorType::II,
        p3: RotorType::III,
    ))->toThrow(EnigmaConfigurationException::class, 'Greek rotors (BETA/GAMMA) can only be mounted in the GREEK position');
});

test('non-greek rotor in greek position throws exception', function (): void {
    expect(fn() => new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
        greek: RotorType::IV, // Non-greek rotor in greek position!
    ))->toThrow(EnigmaConfigurationException::class, 'Only Greek rotors (BETA/GAMMA) can be mounted in the GREEK position');
});

test('incompatible rotor for model throws exception', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::VI, // Only available for KMM3/KMM4
        p2: RotorType::II,
        p3: RotorType::III,
    );

    expect(fn() => $rotorsConfiguration->validateForModel(EnigmaModel::WMLW))
        ->toThrow(EnigmaConfigurationException::class, 'Rotor VI at position P1 is not compatible with model WMLW');
});

test('incompatible rotor for model throws exception in Enigma constructor', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::VI, // Only available for KMM3/KMM4
        p2: RotorType::II,
        p3: RotorType::III,
    );

    expect(fn() => new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B))
        ->toThrow(EnigmaConfigurationException::class, 'Rotor VI at position P1 is not compatible with model WMLW');
});

test('strictMode false allows incompatible rotor configuration', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::VI, // Only available for KMM3/KMM4
        p2: RotorType::II,
        p3: RotorType::III,
    );

    // Should not throw with strictMode disabled
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B, strictMode: false);

    expect($enigma)->toBeInstanceOf(Enigma::class);
    expect($enigma->strictMode)->toBeFalse();
});

test('strictMode false allows incompatible reflector', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );

    // DORA is not compatible with KMM3, but strictMode disabled allows it
    $enigma = new Enigma(EnigmaModel::KMM3, $rotorsConfiguration, ReflectorType::DORA, strictMode: false);

    expect($enigma)->toBeInstanceOf(Enigma::class);
});

test('strictMode can be changed after construction', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );

    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);

    expect($enigma->strictMode)->toBeTrue();

    $enigma->strictMode = false;

    expect($enigma->strictMode)->toBeFalse();

    // Now we can mount an incompatible reflector
    $enigma->mountReflector(ReflectorType::BTHIN); // Not compatible with WMLW

    expect($enigma->reflector)->toBeInstanceOf(JulienBoudry\Enigma\Reflector\AbstractReflector::class);
});

test('RotorConfiguration strictMode false allows duplicate rotors in constructor', function (): void {
    // Should not throw with strictMode disabled
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::I, // Duplicate rotor
        p3: RotorType::III,
        strictMode: false
    );

    expect($rotorsConfiguration)->toBeInstanceOf(RotorConfiguration::class);
    expect($rotorsConfiguration->getP1()->getType())->toBe(RotorType::I);
    expect($rotorsConfiguration->getP2()->getType())->toBe(RotorType::I);
});

test('RotorConfiguration strictMode false allows duplicate rotors in mountRotor', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
        strictMode: false
    );

    // Should not throw - mounting duplicate rotor with strictMode disabled
    $rotorsConfiguration->mountRotor(RotorPosition::P2, RotorType::I);

    expect($rotorsConfiguration->getP1()->getType())->toBe(RotorType::I);
    expect($rotorsConfiguration->getP2()->getType())->toBe(RotorType::I);
});

test('RotorConfiguration strictMode false allows greek rotor in non-greek position', function (): void {
    // Should not throw with strictMode disabled
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::BETA, // Greek rotor in non-greek position
        p2: RotorType::II,
        p3: RotorType::III,
        strictMode: false
    );

    expect($rotorsConfiguration)->toBeInstanceOf(RotorConfiguration::class);
    expect($rotorsConfiguration->getP1()->getType())->toBe(RotorType::BETA);
});

test('RotorConfiguration strictMode false allows non-greek rotor in greek position', function (): void {
    // Should not throw with strictMode disabled
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
        greek: RotorType::IV, // Non-greek rotor in greek position
        strictMode: false
    );

    expect($rotorsConfiguration)->toBeInstanceOf(RotorConfiguration::class);
    expect($rotorsConfiguration->getGreek()?->getType())->toBe(RotorType::IV);
});

test('RotorConfiguration strictMode false allows mounting non-greek rotor to greek position via mountRotor', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
        greek: RotorType::BETA,
        strictMode: false
    );

    // Should not throw - mounting non-greek rotor to greek position with strictMode disabled
    $rotorsConfiguration->mountRotor(RotorPosition::GREEK, RotorType::V);

    expect($rotorsConfiguration->getGreek()?->getType())->toBe(RotorType::V);
});

test('RotorConfiguration strictMode is true by default', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );

    expect($rotorsConfiguration->strictMode)->toBeTrue();
});

test('plugLetters connects two letters on the plugboard', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);

    $enigma->plugLetters(Letter::A, Letter::Z);

    $pairs = $enigma->plugboard->getPluggedPairs();
    expect($pairs)->toHaveCount(1);
    expect($pairs[0])->toBe([Letter::A, Letter::Z]);
});

test('unplugLetters disconnects a letter pair', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);

    $enigma->plugLetters(Letter::A, Letter::Z);
    $enigma->plugLetters(Letter::B, Letter::Y);
    expect($enigma->plugboard->getPluggedPairs())->toHaveCount(2);

    // Unplug using one of the letters in the pair
    $enigma->unplugLetters(Letter::A);

    $pairs = $enigma->plugboard->getPluggedPairs();
    expect($pairs)->toHaveCount(1);
    expect($pairs[0])->toBe([Letter::B, Letter::Y]);
});

test('plugLetters affects encoding', function (): void {
    $createEnigma = function () {
        $rotorsConfiguration = new RotorConfiguration(
            p1: RotorType::I,
            p2: RotorType::II,
            p3: RotorType::III,
        );
        $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
        $enigma->setPosition(RotorPosition::P1, Letter::A);
        $enigma->setPosition(RotorPosition::P2, Letter::A);
        $enigma->setPosition(RotorPosition::P3, Letter::A);

        return $enigma;
    };

    $enigmaWithoutPlug = $createEnigma();
    $enigmaWithPlug = $createEnigma();
    $enigmaWithPlug->plugLetters(Letter::A, Letter::Z);

    // Same input should produce different output
    $resultWithoutPlug = $enigmaWithoutPlug->encodeLetter(Letter::A);
    $resultWithPlug = $enigmaWithPlug->encodeLetter(Letter::A);

    expect($resultWithoutPlug)->not->toBe($resultWithPlug);
});

test('plugLettersFromPairs accepts space-separated string', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, Letter::A);

    $enigma->plugLettersFromPairs('AB CD EF');

    $pairs = $enigma->plugboard->getPluggedPairs();
    expect($pairs)->toHaveCount(3);
    expect($pairs[0])->toBe([Letter::A, Letter::B]);
    expect($pairs[1])->toBe([Letter::C, Letter::D]);
    expect($pairs[2])->toBe([Letter::E, Letter::F]);
});

test('plugLettersFromPairs accepts array of pairs', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, Letter::A);

    $enigma->plugLettersFromPairs(['XY', 'WZ']);

    $pairs = $enigma->plugboard->getPluggedPairs();
    expect($pairs)->toHaveCount(2);
    expect($pairs[0])->toBe([Letter::W, Letter::Z]);
    expect($pairs[1])->toBe([Letter::X, Letter::Y]);
});

test('plugLettersFromPairs throws exception for invalid pair format', function (): void {
    $rotorsConfiguration = new RotorConfiguration(
        p1: RotorType::I,
        p2: RotorType::II,
        p3: RotorType::III,
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);

    expect(fn() => $enigma->plugLettersFromPairs('AB CDE'))
        ->toThrow(InvalidArgumentException::class, "Invalid pair format: 'CDE'. Expected 2 characters.");
});

test('plugLettersFromPairs produces same result as individual plugLetters calls', function (): void {
    $createEnigma = function () {
        $rotorsConfiguration = new RotorConfiguration(
            p1: RotorType::I,
            p2: RotorType::II,
            p3: RotorType::III,
        );

        return new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::B);
    };

    $enigma1 = $createEnigma();
    $enigma1->setPosition(RotorPosition::P1, Letter::A);
    $enigma1->plugLetters(Letter::A, Letter::V);
    $enigma1->plugLetters(Letter::B, Letter::S);
    $enigma1->plugLetters(Letter::C, Letter::G);

    $enigma2 = $createEnigma();
    $enigma2->setPosition(RotorPosition::P1, Letter::A);
    $enigma2->plugLettersFromPairs('AV BS CG');

    $message = 'HELLOWORLD';
    expect($enigma1->encodeLetters($message))->toBe($enigma2->encodeLetters($message));
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
