<?php

declare(strict_types=1);

use JulienBoudry\Enigma\{Enigma, EnigmaModel, Letter, ReflectorType, RotorPosition, RotorSelection, RotorType};

test('message from dönitz1 may1945', function (): void {
    $rotors = new RotorSelection(
        right: RotorType::VIII,
        middle: RotorType::VI,
        left: RotorType::V,
        greek: RotorType::BETA,
    );
    $enigma = new Enigma(EnigmaModel::KMM4, $rotors, ReflectorType::CTHIN);

    $enigma->setPosition(RotorPosition::P1, Letter::M);
    $enigma->setPosition(RotorPosition::P2, Letter::E);
    $enigma->setPosition(RotorPosition::P3, Letter::A);
    $enigma->setPosition(RotorPosition::GREEK, Letter::N);

    $enigma->setRingstellung(RotorPosition::P1, Letter::L);
    $enigma->setRingstellung(RotorPosition::P2, Letter::E);
    $enigma->setRingstellung(RotorPosition::P3, Letter::P);
    $enigma->setRingstellung(RotorPosition::GREEK, Letter::E);

    $enigma->plugLetters(Letter::A, Letter::E);
    $enigma->plugLetters(Letter::B, Letter::F);
    $enigma->plugLetters(Letter::C, Letter::M);
    $enigma->plugLetters(Letter::D, Letter::Q);
    $enigma->plugLetters(Letter::H, Letter::U);
    $enigma->plugLetters(Letter::J, Letter::N);
    $enigma->plugLetters(Letter::L, Letter::X);
    $enigma->plugLetters(Letter::P, Letter::R);
    $enigma->plugLetters(Letter::S, Letter::Z);
    $enigma->plugLetters(Letter::V, Letter::W);

    self::assertSame(Letter::C, $enigma->encodeLetter(Letter::Q));
    self::assertSame(Letter::D, $enigma->encodeLetter(Letter::E));
    self::assertSame(Letter::S, $enigma->encodeLetter(Letter::O));
    self::assertSame(Letter::Z, $enigma->encodeLetter(Letter::B));
});

test('Operation Barbarossa (1941)', function (): void {
    // Source: http://wiki.franklinheath.co.uk/index.php/Enigma/Sample_Messages#Operation_Barbarossa.2C_1941
    // Model: Enigma I (compatible with M3)
    // Reflector: B
    // Rotors: II, IV, V (Left to Right -> Slow to Fast)
    // Ring Settings: B-U-L (02 21 12)
    // Plugboard: AV BS CG DL FU HZ IN KM OW RX
    // Start Position: BLA

    $rotors = new RotorSelection(
        right: RotorType::V,    // Right (Fast)
        middle: RotorType::IV,  // Middle
        left: RotorType::II,    // Left (Slow)
    );

    $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);

    // Ring Settings (Ringstellung)
    $enigma->setRingstellung(RotorPosition::P1, Letter::L);
    $enigma->setRingstellung(RotorPosition::P2, Letter::U);
    $enigma->setRingstellung(RotorPosition::P3, Letter::B);

    // Start Position (Grundstellung)
    $enigma->setPosition(RotorPosition::P1, Letter::A);
    $enigma->setPosition(RotorPosition::P2, Letter::L);
    $enigma->setPosition(RotorPosition::P3, Letter::B);

    // Plugboard
    $plugs = ['AV', 'BS', 'CG', 'DL', 'FU', 'HZ', 'IN', 'KM', 'OW', 'RX'];
    foreach ($plugs as $plug) {
        $enigma->plugLetters(Letter::fromChar($plug[0]), Letter::fromChar($plug[1]));
    }

    $ciphertext = str_replace(' ', '', 'EDPUD NRGYS ZRCXN UYTPO MRMBO FKTBZ REZKM LXLVE FGUEY SIOZV EQMIK UBPMM YLKLT TDEIS MDICA GYKUA CTCDO MOHWX MUUIA UBSTS LRNBZ SZWNR FXWFY SSXJZ VIJHI DISHP RKLKA YUPAD TXQSP INQMA TLPIF SVKDA SCTAC DPBOP VHJK');
    $expectedPlaintext = str_replace(' ', '', 'AUFKL XABTE ILUNG XVONX KURTI NOWAX KURTI NOWAX NORDW ESTLX SEBEZ XSEBE ZXUAF FLIEG ERSTR ASZER IQTUN GXDUB ROWKI XDUBR OWKIX OPOTS CHKAX OPOTS CHKAX UMXEI NSAQT DREIN ULLXU HRANG ETRET ENXAN GRIFF XINFX RGTX');

    $decrypted = '';
    foreach (str_split($ciphertext) as $char) {
        $decrypted .= $enigma->encodeLetter(Letter::fromChar($char))->toChar();
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

    $rotors = new RotorSelection(
        right: RotorType::I,       // Right (Fast)
        middle: RotorType::IV,     // Middle
        left: RotorType::II,       // Left (Slow)
        greek: RotorType::BETA,    // Greek (Leftmost)
    );

    $enigma = new Enigma(EnigmaModel::KMM4, $rotors, ReflectorType::BTHIN);

    // Ring Settings
    $enigma->setRingstellung(RotorPosition::P1, Letter::V);
    $enigma->setRingstellung(RotorPosition::P2, Letter::A);
    $enigma->setRingstellung(RotorPosition::P3, Letter::A);
    $enigma->setRingstellung(RotorPosition::GREEK, Letter::A);

    // Start Position
    $enigma->setPosition(RotorPosition::P1, Letter::A);
    $enigma->setPosition(RotorPosition::P2, Letter::N);
    $enigma->setPosition(RotorPosition::P3, Letter::J);
    $enigma->setPosition(RotorPosition::GREEK, Letter::V);

    // Plugboard
    $plugs = ['AT', 'BL', 'DF', 'GJ', 'HM', 'NW', 'OP', 'QY', 'RZ', 'VX'];
    foreach ($plugs as $plug) {
        $enigma->plugLetters(Letter::fromChar($plug[0]), Letter::fromChar($plug[1]));
    }

    $ciphertext = str_replace(' ', '', 'NCZW VUSX PNYM INHZ XMQX SFWX WLKJ AHSH NMCO CCAK UQPM KCSM HKSE INJU SBLK IOSX CKUB HMLL XCSJ USRR DVKO HULX WCCB GVLI YXEO AHXR HKKF VDRE WEZL XOBA FGYU JQUK GRTV UKAM EURB VEKS UHHV OYHA BCJW MAKL FKLM YFVN RIZR VVRT KOFD ANJM OLBG FFLE OPRG TFLV RHOW OPBE KVWM UQFM PWPA RMFH AGKX IIBG');
    $expectedPlaintext = str_replace(' ', '', 'VONV ONJL OOKS JHFF TTTE INSE INSD REIZ WOYY QNNS NEUN INHA LTXX BEIA NGRI FFUN TERW ASSE RGED RUEC KTYW ABOS XLET ZTER GEGN ERST ANDN ULAC HTDR EINU LUHR MARQ UANT ONJO TANE UNAC HTSE YHSD REIY ZWOZ WONU LGRA DYAC HTSM YSTO SSEN ACHX EKNS VIER MBFA ELLT YNNN NNNO OOVI ERYS ICHT EINS NULL');

    $decrypted = '';
    foreach (str_split($ciphertext) as $char) {
        $decrypted .= $enigma->encodeLetter(Letter::fromChar($char))->toChar();
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

    $rotors = new RotorSelection(
        right: RotorType::VIII,   // Right (Fast)
        middle: RotorType::VI,    // Middle
        left: RotorType::III,     // Left (Slow)
    );

    $enigma = new Enigma(EnigmaModel::KMM3, $rotors, ReflectorType::B);

    // Ring Settings
    $enigma->setRingstellung(RotorPosition::P1, Letter::M);
    $enigma->setRingstellung(RotorPosition::P2, Letter::H);
    $enigma->setRingstellung(RotorPosition::P3, Letter::A);

    // Start Position
    $enigma->setPosition(RotorPosition::P1, Letter::V);
    $enigma->setPosition(RotorPosition::P2, Letter::Z);
    $enigma->setPosition(RotorPosition::P3, Letter::U);

    // Plugboard
    $plugs = ['AN', 'EZ', 'HK', 'IJ', 'LR', 'MQ', 'OT', 'PV', 'SW', 'UX'];
    foreach ($plugs as $plug) {
        $enigma->plugLetters(Letter::fromChar($plug[0]), Letter::fromChar($plug[1]));
    }

    $ciphertext = str_replace(' ', '', 'YKAE NZAP MSCH ZBFO CUVM RMDP YCOF HADZ IZME FXTH FLOL PZLF GGBO TGOX GRET DWTJ IQHL MXVJ WKZU ASTR');
    $expectedPlaintext = str_replace(' ', '', 'STEUE REJTA NAFJO RDJAN STAND ORTQU AAACC CVIER NEUNN EUNZW OFAHR TZWON ULSMX XSCHA RNHOR STHCO');

    $decrypted = '';
    foreach (str_split($ciphertext) as $char) {
        $decrypted .= $enigma->encodeLetter(Letter::fromChar($char))->toChar();
    }

    expect($decrypted)->toBe($expectedPlaintext);
});
