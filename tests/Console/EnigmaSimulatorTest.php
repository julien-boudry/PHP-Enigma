<?php

declare(strict_types=1);

use JulienBoudry\EnigmaMachine\Console\EnigmaSimulator;
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};
use Symfony\Component\Console\Output\BufferedOutput;

test('simulator encodes text correctly', function (): void {
    // Setup deterministic Enigma
    // Standard setup: Rotors I-II-III (Left-to-Right) means P3=I, P2=II, P1=III
    $rotors = new RotorConfiguration(
        p1: RotorType::III,
        p2: RotorType::II,
        p3: RotorType::I,
        ringstellungP1: Letter::A,
        ringstellungP2: Letter::A,
        ringstellungP3: Letter::A
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, Letter::A);
    $enigma->setPosition(RotorPosition::P2, Letter::A);
    $enigma->setPosition(RotorPosition::P3, Letter::A);

    $output = new BufferedOutput;
    $simulator = new EnigmaSimulator($output, $enigma);

    // Encode "AAAAA" with default settings (AAA) -> BDZGO
    $result = $simulator->simulate('AAAAA', 0);

    expect($result)->toBe('BDZGO');
});

test('simulator renders visual frame structure', function (): void {
    $enigma = Enigma::createRandom(EnigmaModel::WMLW);
    $output = new BufferedOutput;
    $simulator = new EnigmaSimulator($output, $enigma);

    $simulator->simulate('A', 0);
    $content = $output->fetch();

    expect($content)
        ->toContain('𝕰𝖓𝖎𝖌𝖒𝖆 𝕸𝖆𝖈𝖍𝖎𝖓𝖊') // Gothic title
        ->toContain('Rotors') // Section header
        ->toContain('Status') // Status section
        ->toContain('✠') // Cross symbol
        ->toContain('A'); // The input letter
});

test('simulator renders plugboard when present', function (): void {
    $enigma = Enigma::createRandom(EnigmaModel::WMLW);
    // Ensure we have at least one plug
    $enigma->plugLetters(Letter::A, Letter::B);

    $output = new BufferedOutput;
    $simulator = new EnigmaSimulator($output, $enigma);

    $simulator->simulate('A', 0);
    $content = $output->fetch();

    // Should contain PLUGBOARD section
    expect($content)->toContain('Plugboard');

    // Should contain the plugged letters in the pair display
    expect($content)->toContain('A');
    expect($content)->toContain('B');
});

test('simulator hides plugboard section for models without plugboard', function (): void {
    // Use a commercial model that has no plugboard
    $enigma = Enigma::createRandom(EnigmaModel::ENIGMA_K);

    $output = new BufferedOutput;
    $simulator = new EnigmaSimulator($output, $enigma);

    $simulator->simulate('A', 0);
    $content = $output->fetch();

    // The plugboard section should not be present for models without plugboard
    expect($content)->not->toContain('Plugboard');

    // Verify it has fewer lines than a model with plugboard
    $lines = explode("\n", $content);
    // Should have a reasonable number of lines
    expect(\count($lines))->toBeGreaterThan(15);
});

test('simulator handles greek rotor rendering for M4', function (): void {
    $enigma = Enigma::createRandom(EnigmaModel::KMM4);

    $output = new BufferedOutput;
    $simulator = new EnigmaSimulator($output, $enigma);

    $simulator->simulate('A', 0);
    $content = $output->fetch();

    expect($content)
        ->toContain('Rotors') // Section header
        ->toMatch('/BETA|GAMMA/'); // Greek rotor type (Beta or Gamma)
});

test('simulator skips non-alpha characters', function (): void {
    // Setup deterministic Enigma
    $rotors = new RotorConfiguration(
        p1: RotorType::III,
        p2: RotorType::II,
        p3: RotorType::I
    );
    $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, Letter::A);
    $enigma->setPosition(RotorPosition::P2, Letter::A);
    $enigma->setPosition(RotorPosition::P3, Letter::A);

    $output = new BufferedOutput;
    $simulator = new EnigmaSimulator($output, $enigma);

    // "A 1 B" -> Should encode A and B, skip space and 1
    // A -> B (AAA -> AAB)
    // B -> J (AAB -> AAC)
    $result = $simulator->simulate('A 1 B', 0);

    expect($result)->toBe('BJ');
});
