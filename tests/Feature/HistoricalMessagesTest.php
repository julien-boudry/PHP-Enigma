<?php

declare(strict_types=1);

use Rafalmasiarek\Enigma\{Enigma, EnigmaModel, ReflectorType, RotorPosition, RotorType};

test('message from dönitz1 may1945', function (): void {
    $rotors = [RotorType::VIII, RotorType::VI, RotorType::V, RotorType::BETA];
    $enigma = new Enigma(EnigmaModel::KMM4, $rotors, ReflectorType::CTHIN);

    $enigma->setPosition(RotorPosition::P1, 'M');
    $enigma->setPosition(RotorPosition::P2, 'E');
    $enigma->setPosition(RotorPosition::P3, 'A');
    $enigma->setPosition(RotorPosition::GREEK, 'N');

    $enigma->setRingstellung(RotorPosition::P1, 'L');
    $enigma->setRingstellung(RotorPosition::P2, 'E');
    $enigma->setRingstellung(RotorPosition::P3, 'P');
    $enigma->setRingstellung(RotorPosition::GREEK, 'E');

    $enigma->plugLetters('A', 'E');
    $enigma->plugLetters('B', 'F');
    $enigma->plugLetters('C', 'M');
    $enigma->plugLetters('D', 'Q');
    $enigma->plugLetters('H', 'U');
    $enigma->plugLetters('J', 'N');
    $enigma->plugLetters('L', 'X');
    $enigma->plugLetters('P', 'R');
    $enigma->plugLetters('S', 'Z');
    $enigma->plugLetters('V', 'W');

    self::assertSame('C', $enigma->encodeLetter('Q'));
    self::assertSame('D', $enigma->encodeLetter('E'));
    self::assertSame('S', $enigma->encodeLetter('O'));
    self::assertSame('Z', $enigma->encodeLetter('B'));
});

test('Operation Barbarossa (1941)', function (): void {
    // Source: http://wiki.franklinheath.co.uk/index.php/Enigma/Sample_Messages#Operation_Barbarossa.2C_1941
    // Model: Enigma I (compatible with M3)
    // Reflector: B
    // Rotors: II, IV, V (Left to Right -> Slow to Fast)
    // Ring Settings: B-U-L (02 21 12)
    // Plugboard: AV BS CG DL FU HZ IN KM OW RX
    // Start Position: BLA

    $rotors = [
        RotorPosition::P1->value => RotorType::V,   // Right (Fast)
        RotorPosition::P2->value => RotorType::IV,  // Middle
        RotorPosition::P3->value => RotorType::II,  // Left (Slow)
    ];

    $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);

    // Ring Settings (Ringstellung)
    $enigma->setRingstellung(RotorPosition::P1, 'L');
    $enigma->setRingstellung(RotorPosition::P2, 'U');
    $enigma->setRingstellung(RotorPosition::P3, 'B');

    // Start Position (Grundstellung)
    $enigma->setPosition(RotorPosition::P1, 'A');
    $enigma->setPosition(RotorPosition::P2, 'L');
    $enigma->setPosition(RotorPosition::P3, 'B');

    // Plugboard
    $plugs = ['AV', 'BS', 'CG', 'DL', 'FU', 'HZ', 'IN', 'KM', 'OW', 'RX'];
    foreach ($plugs as $plug) {
        $enigma->plugLetters($plug[0], $plug[1]);
    }

    $ciphertext = str_replace(' ', '', 'EDPUD NRGYS ZRCXN UYTPO MRMBO FKTBZ REZKM LXLVE FGUEY SIOZV EQMIK UBPMM YLKLT TDEIS MDICA GYKUA CTCDO MOHWX MUUIA UBSTS LRNBZ SZWNR FXWFY SSXJZ VIJHI DISHP RKLKA YUPAD TXQSP INQMA TLPIF SVKDA SCTAC DPBOP VHJK');
    $expectedPlaintext = str_replace(' ', '', 'AUFKL XABTE ILUNG XVONX KURTI NOWAX KURTI NOWAX NORDW ESTLX SEBEZ XSEBE ZXUAF FLIEG ERSTR ASZER IQTUN GXDUB ROWKI XDUBR OWKIX OPOTS CHKAX OPOTS CHKAX UMXEI NSAQT DREIN ULLXU HRANG ETRET ENXAN GRIFF XINFX RGTX');

    $decrypted = '';
    foreach (str_split($ciphertext) as $char) {
        $decrypted .= $enigma->encodeLetter($char);
    }

    expect($decrypted)->toBe($expectedPlaintext);
});

test('U-264 (Kapitänleutnant Hartwig Looks) (1942)', function (): void {
    // Source: http://wiki.franklinheath.co.uk/index.php/Enigma/Sample_Messages#U-264_.28Kapit.C3.A4nleutnant_Hartwig_Looks.29.2C_1942
    // Model: Enigma M4
    // Reflector: Thin B
    // Rotors: Beta, II, IV, I (Left to Right -> Greek, Slow, Middle, Fast)
    // Ring Settings: A-A-A-V (01 01 01 22)
    // Plugboard: AT BL DF GJ HM NW OP QY RZ VX
    // Start Position: VJNA

    $rotors = [
        RotorPosition::P1->value => RotorType::I,    // Right (Fast)
        RotorPosition::P2->value => RotorType::IV,   // Middle
        RotorPosition::P3->value => RotorType::II,   // Left (Slow)
        RotorPosition::GREEK->value => RotorType::BETA, // Greek (Leftmost)
    ];

    $enigma = new Enigma(EnigmaModel::KMM4, $rotors, ReflectorType::BTHIN);

    // Ring Settings
    $enigma->setRingstellung(RotorPosition::P1, 'V');
    $enigma->setRingstellung(RotorPosition::P2, 'A');
    $enigma->setRingstellung(RotorPosition::P3, 'A');
    $enigma->setRingstellung(RotorPosition::GREEK, 'A');

    // Start Position
    $enigma->setPosition(RotorPosition::P1, 'A');
    $enigma->setPosition(RotorPosition::P2, 'N');
    $enigma->setPosition(RotorPosition::P3, 'J');
    $enigma->setPosition(RotorPosition::GREEK, 'V');

    // Plugboard
    $plugs = ['AT', 'BL', 'DF', 'GJ', 'HM', 'NW', 'OP', 'QY', 'RZ', 'VX'];
    foreach ($plugs as $plug) {
        $enigma->plugLetters($plug[0], $plug[1]);
    }

    $ciphertext = str_replace(' ', '', 'NCZW VUSX PNYM INHZ XMQX SFWX WLKJ AHSH NMCO CCAK UQPM KCSM HKSE INJU SBLK IOSX CKUB HMLL XCSJ USRR DVKO HULX WCCB GVLI YXEO AHXR HKKF VDRE WEZL XOBA FGYU JQUK GRTV UKAM EURB VEKS UHHV OYHA BCJW MAKL FKLM YFVN RIZR VVRT KOFD ANJM OLBG FFLE OPRG TFLV RHOW OPBE KVWM UQFM PWPA RMFH AGKX IIBG');
    $expectedPlaintext = str_replace(' ', '', 'VONV ONJL OOKS JHFF TTTE INSE INSD REIZ WOYY QNNS NEUN INHA LTXX BEIA NGRI FFUN TERW ASSE RGED RUEC KTYW ABOS XLET ZTER GEGN ERST ANDN ULAC HTDR EINU LUHR MARQ UANT ONJO TANE UNAC HTSE YHSD REIY ZWOZ WONU LGRA DYAC HTSM YSTO SSEN ACHX EKNS VIER MBFA ELLT YNNN NNNO OOVI ERYS ICHT EINS NULL');

    $decrypted = '';
    foreach (str_split($ciphertext) as $char) {
        $decrypted .= $enigma->encodeLetter($char);
    }

    expect($decrypted)->toBe($expectedPlaintext);
});

test('Scharnhorst (Konteradmiral Erich Bey) (1943)', function (): void {
    // Source: http://wiki.franklinheath.co.uk/index.php/Enigma/Sample_Messages#Scharnhorst_.28Konteradmiral_Erich_Bey.29.2C_1943
    // Model: Enigma M3
    // Reflector: B
    // Rotors: III, VI, VIII (Left to Right -> Slow to Fast)
    // Ring Settings: A-H-M (01 08 13)
    // Plugboard: AN EZ HK IJ LR MQ OT PV SW UX
    // Start Position: UZV

    $rotors = [
        RotorPosition::P1->value => RotorType::VIII, // Right (Fast)
        RotorPosition::P2->value => RotorType::VI,   // Middle
        RotorPosition::P3->value => RotorType::III,  // Left (Slow)
    ];

    $enigma = new Enigma(EnigmaModel::KMM3, $rotors, ReflectorType::B);

    // Ring Settings
    $enigma->setRingstellung(RotorPosition::P1, 'M');
    $enigma->setRingstellung(RotorPosition::P2, 'H');
    $enigma->setRingstellung(RotorPosition::P3, 'A');

    // Start Position
    $enigma->setPosition(RotorPosition::P1, 'V');
    $enigma->setPosition(RotorPosition::P2, 'Z');
    $enigma->setPosition(RotorPosition::P3, 'U');

    // Plugboard
    $plugs = ['AN', 'EZ', 'HK', 'IJ', 'LR', 'MQ', 'OT', 'PV', 'SW', 'UX'];
    foreach ($plugs as $plug) {
        $enigma->plugLetters($plug[0], $plug[1]);
    }

    $ciphertext = str_replace(' ', '', 'YKAE NZAP MSCH ZBFO CUVM RMDP YCOF HADZ IZME FXTH FLOL PZLF GGBO TGOX GRET DWTJ IQHL MXVJ WKZU ASTR');
    $expectedPlaintext = str_replace(' ', '', 'STEUE REJTA NAFJO RDJAN STAND ORTQU AAACC CVIER NEUNN EUNZW OFAHR TZWON ULSMX XSCHA RNHOR STHCO');

    $decrypted = '';
    foreach (str_split($ciphertext) as $char) {
        $decrypted .= $enigma->encodeLetter($char);
    }

    expect($decrypted)->toBe($expectedPlaintext);
});
