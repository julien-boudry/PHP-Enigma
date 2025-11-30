# Enigma Models and Components

This document provides comprehensive technical specifications for all Enigma models, rotors, reflectors, and entry wheels supported by this library.

## Table of Contents

- [Models Overview](#models-overview)
  - [Military Models](#military-models)
  - [Commercial Models](#commercial-models)
  - [Enigma T (Tirpitz)](#enigma-t-tirpitz)
- [Rotors](#rotors)
  - [Military Rotors](#military-rotors)
  - [Commercial Rotors](#commercial-rotors)
  - [Tirpitz Rotors](#tirpitz-rotors)
  - [Rotor Wirings](#rotor-wirings)
  - [Notch Positions](#notch-positions)
- [Reflectors](#reflectors)
  - [Military Reflectors](#military-reflectors)
  - [Commercial Reflectors](#commercial-reflectors)
  - [Reflector Wirings](#reflector-wirings)
  - [UKW-D (Rewirable Reflector)](#ukw-d-rewirable-reflector)
- [Entry Wheels](#entry-wheels)
- [Compatibility Matrix](#compatibility-matrix)

---

## Models Overview

This library supports both military and commercial Enigma models. Military models feature a plugboard (Steckerbrett) for additional scrambling, while commercial models do not have a plugboard.

| Model | Code | Rotors | Plugboard | Entry Wheel |
|-------|------|--------|-----------|-------------|
| Wehrmacht/Luftwaffe | `WMLW` | 3 | ✓ | Alphabetical |
| Kriegsmarine M3 | `KMM3` | 3 | ✓ | Alphabetical |
| Kriegsmarine M4 | `KMM4` | 4 | ✓ | Alphabetical |
| Enigma K Commercial | `ENIGMA_K` | 3 | ✗ | QWERTZ |
| Swiss-K | `SWISS_K` | 3 | ✗ | QWERTZ |
| Railway (Rocket) | `RAILWAY` | 3 | ✗ | QWERTZ |
| Enigma T (Tirpitz) | `TIRPITZ` | 3 | ✗ | Tirpitz |

### Military Models

Military Enigma machines were used by the German Wehrmacht, Luftwaffe, and Kriegsmarine during WWII. They all feature:
- **Plugboard (Steckerbrett)**: Swaps letter pairs before and after rotor processing
- **Alphabetical entry wheel**: `ABCDEFGHIJKLMNOPQRSTUVWXYZ`

#### Wehrmacht / Luftwaffe 3-Rotor (`WMLW`)

The standard German Army and Air Force Enigma.

- **Rotors available**: I, II, III, IV, V (choose 3)
- **Reflectors available**: B, C, DORA (rewirable)
- **Plugboard**: Yes

**PHP Example:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

$rotors = new RotorConfiguration(RotorType::I, RotorType::II, RotorType::III);
$enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
$enigma->setPosition(RotorPosition::P1, Letter::A);
$enigma->plugLettersFromPairs('AV BS CG DL FU HZ IN KM OW RX');

echo $enigma->encodeLetters('HELLOWORLD'); // Encoded message
```

**CLI Example:**
```bash
./bin/enigma encode "HELLOWORLD" --model=WMLW --rotors=III-II-I --reflector=B --plugboard="AV BS CG DL FU HZ IN KM OW RX"
```

#### Kriegsmarine M3 (`KMM3`)

The German Navy 3-rotor variant with additional rotors.

- **Rotors available**: I, II, III, IV, V, VI, VII, VIII (choose 3)
- **Reflectors available**: B, C
- **Plugboard**: Yes

**PHP Example:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

// Using rotors VI, VII, VIII (only available on Kriegsmarine models)
$rotors = new RotorConfiguration(RotorType::VI, RotorType::VII, RotorType::VIII);
$enigma = new Enigma(EnigmaModel::KMM3, $rotors, ReflectorType::C);
$enigma->setPosition(RotorPosition::P1, Letter::U);
$enigma->setPosition(RotorPosition::P2, Letter::Z);
$enigma->setPosition(RotorPosition::P3, Letter::V);

echo $enigma->encodeLetters('SECRETNAVY');
```

**CLI Example:**
```bash
./bin/enigma encode "SECRETNAVY" --model=KMM3 --rotors=VIII-VII-VI --position=VZU --reflector=C
```

#### Kriegsmarine M4 (`KMM4`)

The German Navy 4-rotor variant, introduced in 1942.

- **Rotors available**: I, II, III, IV, V, VI, VII, VIII + Beta, Gamma
- **Reflectors available**: B Thin, C Thin
- **Plugboard**: Yes
- **Note**: Beta and Gamma rotors can only be used in the 4th (Greek) position

**PHP Example:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

// 4-rotor configuration with Greek rotor (Beta) in position P4
$rotors = new RotorConfiguration(
    p1: RotorType::V,
    p2: RotorType::VI,
    p3: RotorType::VIII,
    pGreek: RotorType::BETA,  // Greek wheel (4th rotor)
    ringstellungP1: Letter::A,
    ringstellungP2: Letter::E,
    ringstellungP3: Letter::P,
    ringstellungPGreek: Letter::A,
);
$enigma = new Enigma(EnigmaModel::KMM4, $rotors, ReflectorType::BTHIN);
$enigma->setPosition(RotorPosition::P1, Letter::A);
$enigma->setPosition(RotorPosition::P2, Letter::N);
$enigma->setPosition(RotorPosition::P3, Letter::J);
$enigma->setPosition(RotorPosition::GREEK, Letter::V);
$enigma->plugLettersFromPairs('AE BF CM DQ HU JN LX PR SZ VW');

echo $enigma->encodeLetters('SECRETM4MESSAGE');
```

**CLI Example:**
```bash
./bin/enigma encode "SECRETM4MESSAGE" \
  --model=KMM4 \
  --rotors=BETA-VIII-VI-V \
  --ring=AAEP \
  --position=VJNA \
  --reflector=BTHIN \
  --plugboard="AE BF CM DQ HU JN LX PR SZ VW"
```

### Commercial Models

Commercial Enigma machines were sold to governments and businesses before and during WWII. They differ from military models in two key ways:
- **No plugboard**: The signal goes directly from the keyboard to the rotors
- **QWERTZ entry wheel**: Uses `QWERTZUIOASDFGHJKPYXCVBNML` order instead of alphabetical

**PHP Example:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

// Create an Enigma K Commercial machine
$rotorsConfiguration = new RotorConfiguration(
    p1: RotorType::K_I,
    p2: RotorType::K_II,
    p3: RotorType::K_III,
);

$enigma = new Enigma(EnigmaModel::ENIGMA_K, $rotorsConfiguration, ReflectorType::K);

// Set rotor positions
$enigma->setPosition(RotorPosition::P1, Letter::A);
$enigma->setPosition(RotorPosition::P2, Letter::B);
$enigma->setPosition(RotorPosition::P3, Letter::C);

// No plugboard available - attempting to use plugLetters() will throw an exception
$encoded = $enigma->encodeLetter(Letter::H);
```

#### Enigma K Commercial (`ENIGMA_K`)

- **Rotors available**: K_I, K_II, K_III
- **Reflector**: K
- **Plugboard**: No

**CLI Example:**
```bash
./bin/enigma encode "COMMERCIAL" --model=ENIGMA_K --rotors=K_III-K_II-K_I --reflector=K --position=ABC
```

#### Swiss-K / Swiss Air Force (`SWISS_K`)

- **Rotors available**: SWISS_K_I, SWISS_K_II, SWISS_K_III
- **Reflector**: SWISS_K
- **Plugboard**: No

**PHP Example:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

$rotors = new RotorConfiguration(RotorType::SWISS_K_I, RotorType::SWISS_K_II, RotorType::SWISS_K_III);
$enigma = new Enigma(EnigmaModel::SWISS_K, $rotors, ReflectorType::SWISS_K);
$enigma->setPosition(RotorPosition::P1, Letter::X);
$enigma->setPosition(RotorPosition::P2, Letter::Y);
$enigma->setPosition(RotorPosition::P3, Letter::Z);

echo $enigma->encodeLetters('SWISSAIRFORCE');
```

**CLI Example:**
```bash
./bin/enigma encode "SWISSAIRFORCE" --model=SWISS_K --rotors=SWISS_K_III-SWISS_K_II-SWISS_K_I --position=ZYX
```

#### Railway / Rocket (`RAILWAY`)

- **Rotors available**: RAILWAY_I, RAILWAY_II, RAILWAY_III
- **Reflector**: RAILWAY
- **Plugboard**: No

**PHP Example:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

$rotors = new RotorConfiguration(RotorType::RAILWAY_I, RotorType::RAILWAY_II, RotorType::RAILWAY_III);
$enigma = new Enigma(EnigmaModel::RAILWAY, $rotors, ReflectorType::RAILWAY);
$enigma->setPosition(RotorPosition::P1, Letter::J);
$enigma->setPosition(RotorPosition::P2, Letter::U);
$enigma->setPosition(RotorPosition::P3, Letter::L);

echo $enigma->encodeLetters('RAILWAYROCKET');
```

**CLI Example:**
```bash
./bin/enigma encode "RAILWAYROCKET" --model=RAILWAY --rotors=RAILWAY_III-RAILWAY_II-RAILWAY_I --position=LUJ
```

### Enigma T (Tirpitz)

The Enigma T (also called "Tirpitz") was a special variant used for communications between Germany and Japan during WWII. It features:
- **No plugboard**: Like commercial models
- **Unique entry wheel**: Uses `KZROUQHYAIGBLWVSTDXFPNMCJE` order (neither alphabetical nor QWERTZ)
- **8 rotors with 5 notches each**: More frequent stepping than standard rotors

- **Rotors available**: TIRPITZ_I through TIRPITZ_VIII (choose 3 of 8)
- **Reflector**: TIRPITZ
- **Plugboard**: No

**PHP Example:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, Letter, ReflectorType, RotorConfiguration, RotorPosition, RotorType};

// Create an Enigma T (Tirpitz) machine
$rotorsConfiguration = new RotorConfiguration(
    p1: RotorType::TIRPITZ_I,
    p2: RotorType::TIRPITZ_II,
    p3: RotorType::TIRPITZ_III,
);

$enigma = new Enigma(EnigmaModel::TIRPITZ, $rotorsConfiguration, ReflectorType::TIRPITZ);

// Set rotor positions
$enigma->setPosition(RotorPosition::P1, Letter::A);
$enigma->setPosition(RotorPosition::P2, Letter::B);
$enigma->setPosition(RotorPosition::P3, Letter::C);

// Encode a message
$ciphertext = $enigma->encodeLetters('HELLO');
```

---

## Rotors

Each rotor provides a unique wiring that cannot be changed. Each rotor can only be used in one position at a time.

### Military Rotors

| Rotor | Compatible Models | Positions |
|-------|-------------------|-----------|
| I | WMLW, KMM3, KMM4 | P1, P2, P3 |
| II | WMLW, KMM3, KMM4 | P1, P2, P3 |
| III | WMLW, KMM3, KMM4 | P1, P2, P3 |
| IV | WMLW, KMM3, KMM4 | P1, P2, P3 |
| V | WMLW, KMM3, KMM4 | P1, P2, P3 |
| VI | KMM3, KMM4 | P1, P2, P3 |
| VII | KMM3, KMM4 | P1, P2, P3 |
| VIII | KMM3, KMM4 | P1, P2, P3 |
| Beta | KMM4 only | P4 (Greek) only |
| Gamma | KMM4 only | P4 (Greek) only |

### Commercial Rotors

| Rotor | Model |
|-------|-------|
| K_I, K_II, K_III | ENIGMA_K |
| SWISS_K_I, SWISS_K_II, SWISS_K_III | SWISS_K |
| RAILWAY_I, RAILWAY_II, RAILWAY_III | RAILWAY |

### Tirpitz Rotors

| Rotor | Model |
|-------|-------|
| TIRPITZ_I through TIRPITZ_VIII | TIRPITZ |

### Rotor Wirings

**Military Rotors** (Contacts = ABCDEFGHIJKLMNOPQRSTUVWXYZ):
| Rotor | Wiring |
|-------|--------|
| I | EKMFLGDQVZNTOWYHXUSPAIBRCJ |
| II | AJDKSIRUXBLHWTMCQGZNPYFVOE |
| III | BDFHJLCPRTXVZNYEIWGAKMUSQO |
| IV | ESOVPZJAYQUIRHXLNFTGKDCMWB |
| V | VZBRGITYUPSDNHLXAWMJQOFECK |
| VI | JPGVOUMFYQBENHZRDKASXLICTW |
| VII | NZJHGRCXMYSWBOUFAIVLPEKQDT |
| VIII | FKQHTLXOCBJSPDZRAMEWNIUYGV |
| Beta | LEYJVCNIXWPBQMDRTAKZGFUHOS |
| Gamma | FSOKANUERHMBTIYCWLQPZXVGJD |

**Commercial Rotors** (ETW = QWERTZUIOASDFGHJKPYXCVBNML):

*Enigma K Commercial:*
| Rotor | Wiring |
|-------|--------|
| K_I | LPGSZMHAEOQKVXRFYBUTNICJDW |
| K_II | SLVGBTFXJQOHEWIRZYAMKPCNDU |
| K_III | CJGDPSHKTURAWZXFMYNQOBVLIE |

*Swiss-K (Swiss Air Force):*
| Rotor | Wiring |
|-------|--------|
| SWISS_K_I | PEZUOHXSCVFMTBGLRINQJWAYDK |
| SWISS_K_II | ZOUESYDKFWPCIQXHMVBLGNJRAT |
| SWISS_K_III | EHRVXGAOBQUSIMZFLYNWKTPDJC |

*Railway (Rocket):*
| Rotor | Wiring |
|-------|--------|
| RAILWAY_I | JGDQOXUSCAMIFRVTPNEWKBLZYH |
| RAILWAY_II | NTZPSFBOKMWRCJDIVLAEYUXHGQ |
| RAILWAY_III | JVIUBHTCDYAKEQZPOSGXNRMWFL |

**Tirpitz Rotors** (ETW = KZROUQHYAIGBLWVSTDXFPNMCJE):
| Rotor | Wiring |
|-------|--------|
| TIRPITZ_I | KPTYUELOCVGRFQDANJMBSWHZXI |
| TIRPITZ_II | UPHZLWEQMTDJXCAKSOIGVBYFNR |
| TIRPITZ_III | QUDLYRFEKONVZAXWHMGPJBSICT |
| TIRPITZ_IV | CIABORGNLXVDMJEWKZPYSUFHTQ |
| TIRPITZ_V | UAXGISNJBVERDYLFZWTPCKOHMQ |
| TIRPITZ_VI | XFUZGALVHCNYSEWQTDMRBKPIOJ |
| TIRPITZ_VII | BJVFTXPLNAYOZIKWGDQERUCHSM |
| TIRPITZ_VIII | YMTPNZHWKODAJXELUQVGCBISFR |

### Notch Positions

Rotors have notches that indicate when the next rotor advances. For example, a notch at position Q means when the rotor steps from Q to R, the next rotor advances.

**Military Rotors:**
| Rotor | Notch Position(s) |
|-------|-------------------|
| I | Q |
| II | E |
| III | V |
| IV | J |
| V | Z |
| VI | Z, M |
| VII | Z, M |
| VIII | Z, M |
| Beta | — (no notch) |
| Gamma | — (no notch) |

**Commercial Rotors:**
| Rotor | Notch Position |
|-------|----------------|
| K_I | Y |
| K_II | E |
| K_III | N |
| SWISS_K_I | Y |
| SWISS_K_II | E |
| SWISS_K_III | N |
| RAILWAY_I | N |
| RAILWAY_II | E |
| RAILWAY_III | Y |

**Tirpitz Rotors:**
All 8 Tirpitz rotors have 5 notches at positions **E, H, K, N, Q**, causing more frequent rotor stepping.

---

## Reflectors

The reflector (Umkehrwalze) swaps letters in pairs, allowing the same settings to be used for both encoding and decoding.

### Military Reflectors

| Reflector | Compatible Models |
|-----------|-------------------|
| B | WMLW, KMM3 |
| C | WMLW, KMM3 |
| DORA | WMLW (rewirable) |
| B Thin (BTHIN) | KMM4 |
| C Thin (CTHIN) | KMM4 |

### Commercial Reflectors

| Reflector | Model |
|-----------|-------|
| K | ENIGMA_K |
| SWISS_K | SWISS_K |
| RAILWAY | RAILWAY |
| TIRPITZ | TIRPITZ |

### Reflector Wirings

**Military Reflectors:**
| Reflector | Wiring |
|-----------|--------|
| B | YRUHQSLDPXNGOKMIEBFZCWVJAT |
| C | FVPJIAOYEDRZXWGCTKUQSBNMHL |
| B Thin | ENKQAUYWJICOPBLMDXZVFTHRGS |
| C Thin | RDOBJNTKVEHMLFCWZAXGYIPSUQ |

**Commercial Reflectors:**
| Reflector | Wiring |
|-----------|--------|
| K | IMETCGFRAYSQBZXWLHKDVUPOJN |
| SWISS_K | IMETCGFRAYSQBZXWLHKDVUPOJN |
| RAILWAY | QYHOGNECVPUZTFDJAXWMKISRBL |
| TIRPITZ | GEKPBTAUMOCNILJDXZYFHWVQSR |

### UKW-D (Rewirable Reflector)

The UKW-D (Umkehrwalze Dora) was a rewirable reflector introduced in January 1944. Unlike fixed reflectors, operators could configure their own wiring using 12 plug cables connecting 24 sockets.

**Usage in PHP:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, ReflectorType, RotorConfiguration, RotorType};
use JulienBoudry\EnigmaMachine\Reflector\ReflectorDora;

// Using default wiring (includes historical B↔O pair, or J↔Y depending on notation)
$enigma = new Enigma(EnigmaModel::WMLW, $rotorsConfiguration, ReflectorType::DORA);

// Or with custom wiring (13 letter pairs)
$customDora = ReflectorDora::fromString('AZ BO CX DW EV FU GT HS IR JQ KP LY MN');
$enigma->mountReflector($customDora);
```

**CLI Example:**
```bash
# Using the default DORA wiring
./bin/enigma encode "SECRET" --model=WMLW --reflector=DORA --rotors=III-II-I --position=ABC
```

The UKW-D is only compatible with the Wehrmacht/Luftwaffe 3-rotor model (WMLW).

---

## Entry Wheels

The entry wheel (Eintrittswalze, ETW) determines how the keyboard connects to the rotor assembly. The entry wheel is automatically selected based on the model and cannot be changed manually.

| Entry Wheel | Wiring | Used By |
|-------------|--------|---------|
| Alphabetical | ABCDEFGHIJKLMNOPQRSTUVWXYZ | Military (WMLW, KMM3, KMM4) |
| QWERTZ | QWERTZUIOASDFGHJKPYXCVBNML | Commercial (ENIGMA_K, SWISS_K, RAILWAY) |
| Tirpitz | KZROUQHYAIGBLWVSTDXFPNMCJE | TIRPITZ |

**Example - Comparing Entry Wheel Impact:**
```bash
# Same rotors and settings, different models = different results due to entry wheel
./bin/enigma encode "TEST" --model=WMLW --rotors=III-II-I --position=AAA
# Uses alphabetical entry wheel

./bin/enigma encode "TEST" --model=ENIGMA_K --rotors=K_III-K_II-K_I --position=AAA
# Uses QWERTZ entry wheel - different output!
```

---

## Compatibility Matrix

This table shows which rotors and reflectors are compatible with each model.

| Model | Rotors | Reflectors |
|-------|--------|------------|
| WMLW | I, II, III, IV, V | B, C, DORA |
| KMM3 | I, II, III, IV, V, VI, VII, VIII | B, C |
| KMM4 | I-VIII (P1-P3), Beta/Gamma (P4) | BTHIN, CTHIN |
| ENIGMA_K | K_I, K_II, K_III | K |
| SWISS_K | SWISS_K_I, SWISS_K_II, SWISS_K_III | SWISS_K |
| RAILWAY | RAILWAY_I, RAILWAY_II, RAILWAY_III | RAILWAY |
| TIRPITZ | TIRPITZ_I through TIRPITZ_VIII | TIRPITZ |

> **Note:** By default, this library enforces these historical constraints via strict mode validation. You can disable these checks for experimental or non-historical configurations (see README for details on strict mode).

**Example - Testing Compatibility:**
```php
use JulienBoudry\EnigmaMachine\{Enigma, EnigmaModel, ReflectorType, RotorConfiguration, RotorType};

// This will throw an exception - Rotor VI is not compatible with WMLW
try {
    $rotors = new RotorConfiguration(RotorType::VI, RotorType::II, RotorType::III);
    $enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B);
} catch (\JulienBoudry\EnigmaMachine\Exception\EnigmaConfigurationException $e) {
    echo "Error: " . $e->getMessage();
}

// Disable strict mode to allow non-historical configurations
$enigma = new Enigma(EnigmaModel::WMLW, $rotors, ReflectorType::B, strictMode: false);
```

```bash
# CLI also validates compatibility
./bin/enigma encode "TEST" --model=WMLW --rotors=VIII-VII-VI
# Error: Rotor VIII is not compatible with model WMLW
```
