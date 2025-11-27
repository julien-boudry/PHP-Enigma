<?php

declare(strict_types=1);
use JulienBoudry\Enigma\{Enigma, EnigmaModel, Letter, ReflectorType, RotorPosition, RotorType};

test('general', function (): void {
    $rotors = [RotorType::I, RotorType::II, RotorType::III];
    $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, Letter::M);
    $enigma->setRingstellung(RotorPosition::P1, Letter::B);

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
