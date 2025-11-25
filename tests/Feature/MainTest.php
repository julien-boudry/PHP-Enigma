<?php

declare(strict_types=1);
use Rafalmasiarek\Enigma\{Enigma, EnigmaModel, ReflectorType, RotorPosition, RotorType};
test('general', function () {
    $rotors = [RotorType::I, RotorType::II, RotorType::III];
    $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
    $enigma->setPosition(RotorPosition::P1, 'M');
    $enigma->setRingstellung(RotorPosition::P1, 'B');

    $enigma->plugLetters('A', 'C');
    $enigma->plugLetters('B', 'Z');

    $enigma->unplugLetters('A');

    self::assertSame('A', $enigma->getPosition(RotorPosition::P3));
    self::assertSame('A', $enigma->getPosition(RotorPosition::P2));
    self::assertSame('M', $enigma->getPosition(RotorPosition::P1));

    self::assertSame('W', $enigma->encodeLetter('A'));

    self::assertSame('A', $enigma->getPosition(RotorPosition::P3));
    self::assertSame('A', $enigma->getPosition(RotorPosition::P2));
    self::assertSame('N', $enigma->getPosition(RotorPosition::P1));

    self::assertSame('G', $enigma->encodeLetter('A'));

    self::assertSame('A', $enigma->getPosition(RotorPosition::P3));
    self::assertSame('A', $enigma->getPosition(RotorPosition::P2));
    self::assertSame('O', $enigma->getPosition(RotorPosition::P1));
});

// https://cryptii.com/pipes/enigma-machine
// public function testRandom(): void
// {
//     $rotors = [RotorType::I, RotorType::II, RotorType::III];
//     $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
//     $enigma->setPosition(RotorPosition::P1, 'A');
//     $enigma->setPosition(RotorPosition::P2, 'E');
//     $enigma->setPosition(RotorPosition::P3, 'M');
//     $enigma->setRingstellung(RotorPosition::P1, 'I');
//     $enigma->setRingstellung(RotorPosition::P2, 'E');
//     $enigma->setRingstellung(RotorPosition::P3, 'R');
//     $enigma->plugLetters('A', 'E');
//     $enigma->plugLetters('B', 'F');
//     $enigma->plugLetters('C', 'M');
//     $enigma->plugLetters('D', 'Q');
//     $enigma->plugLetters('H', 'U');
//     $enigma->plugLetters('J', 'N');
//     $enigma->plugLetters('L', 'X');
//     $enigma->plugLetters('P', 'R');
//     $enigma->plugLetters('S', 'Z');
//     $enigma->plugLetters('V', 'W');
//     self::assertSame('H', $enigma->encodeLetter('Q'));
//     self::assertSame('Z', $enigma->encodeLetter('E'));
// }

