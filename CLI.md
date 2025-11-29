# Enigma Machine CLI

A powerful command-line interface for encoding messages using the Enigma cipher machine.

> **⚡ Reciprocal Cipher:** Enigma is a *reciprocal cipher* — encoding and decoding are the **same operation**. To decode a message, simply pass it through Enigma again with identical settings. This is a fundamental property of Enigma's electrical circuit design.

## Table of Contents

- [Installation](#installation)
- [Quick Start](#quick-start)
- [Command Reference](#command-reference)
  - [Arguments](#arguments)
  - [Options](#options)
- [Usage Examples](#usage-examples)
  - [Basic Encoding](#basic-encoding)
  - [Military Enigma with Plugboard](#military-enigma-with-plugboard)
  - [Kriegsmarine M4 (4 Rotors)](#kriegsmarine-m4-4-rotors)
  - [Commercial Models](#commercial-models)
  - [Enigma T (Tirpitz)](#enigma-t-tirpitz)
  - [Latin Text Conversion](#latin-text-conversion)
  - [Binary File Encoding](#binary-file-encoding)
  - [Text File Encoding](#text-file-encoding)
  - [Random Configuration](#random-configuration)
  - [Decoding Messages](#decoding-messages)
- [Available Models](#available-models)
- [Available Rotors](#available-rotors)
- [Available Reflectors](#available-reflectors)
- [Tips & Best Practices](#tips--best-practices)

## Installation

The CLI is included with the library. After installing via Composer, the `enigma` command is available:

```bash
# If installed globally
enigma encode "HELLO"

# If installed locally in a project
./vendor/bin/enigma encode "HELLO"

# Or from the repository root
./bin/enigma encode "HELLO"
```

## Quick Start

Encode a simple message with default settings (Wehrmacht/Luftwaffe model):

```bash
./bin/enigma encode "HELLOWORLD"
# Output: MFNCZBBFZM
```

Decode it back (Enigma is reciprocal - same settings decode the message):

```bash
./bin/enigma encode "MFNCZBBFZM"
# Output: HELLOWORLD
```

## Command Reference

```
Usage:
  encode [options] [--] [<text>]
```

> **Note:** There is no separate `decode` command. Enigma's reciprocal nature means the same `encode` command decodes when given encoded text with identical settings.

### Arguments

| Argument | Description |
|----------|-------------|
| `text` | The text to encode. Use A-Z only, or combine with `--latin` for automatic conversion. To decode, pass the encoded text with the same settings. |

### Options

| Option | Short | Description | Default |
|--------|-------|-------------|---------|
| `--model` | `-m` | Enigma model to use | `WMLW` |
| `--rotors` | `-r` | Rotors from left to right, separated by `-` | `III-II-I` |
| `--ring` | `-g` | Ring settings (Ringstellung), left to right | `AAA` |
| `--position` | `-p` | Initial positions (Grundstellung), left to right | `AAA` |
| `--reflector` | `-u` | Reflector (Umkehrwalze) to use | `B` |
| `--plugboard` | `-b` | Plugboard pairs, space-separated (e.g., `"AV BS CG"`) | *(empty)* |
| `--input-binary-file` | `-i` | Encode a binary file to Enigma letters | |
| `--input-text-file` | `-I` | Read text from a file and encode (validates Enigma alphabet) | |
| `--output-file` | `-o` | Write output to a file | |
| `--to-binary` | `-t` | Convert an Enigma-encoded file back to binary | *(off)* |
| `--latin` | `-l` | Convert Latin text (accents, numbers, punctuation) automatically | *(off)* |
| `--strip-spaces` | `-x` | Remove spaces from input (for decoding formatted groups) | *(off)* |
| `--format` | `-f` | Format output in traditional 5-letter groups | *(off)* |
| `--random` | | Generate a random configuration (ignores other settings) | *(off)* |
| `--show-config` | `-s` | Display the configuration used for encoding | *(off)* |

## Usage Examples

### Basic Encoding

Simple encoding with default Wehrmacht/Luftwaffe settings:

```bash
./bin/enigma encode "ATTACKATDAWN"
```

With custom rotor order and positions:

```bash
./bin/enigma encode "ATTACKATDAWN" --rotors=V-II-IV --position=ABC
```

With ring settings:

```bash
./bin/enigma encode "ATTACKATDAWN" --rotors=V-II-IV --position=ABC --ring=XYZ
```

### Military Enigma with Plugboard

Full military configuration with plugboard connections:

```bash
./bin/enigma encode "SECRETMESSAGE" \
  --model=WMLW \
  --rotors=V-II-IV \
  --ring=BUL \
  --position=ABC \
  --reflector=B \
  --plugboard="AV BS CG DL FU HZ IN KM OW RX"
```

Using the historical Operation Barbarossa (1941) settings:

```bash
./bin/enigma encode "AUFKLXABTEILUNGXVONXKURTINOWA" \
  --model=WMLW \
  --rotors=II-IV-V \
  --ring=BUL \
  --position=BLA \
  --reflector=B \
  --plugboard="AV BS CG DL FU HZ IN KM OW RX" \
  --show-config
```

### Kriegsmarine M4 (4 Rotors)

The Kriegsmarine M4 uses 4 rotors including a Greek rotor (Beta or Gamma):

```bash
./bin/enigma encode "SECRETNAVY" \
  --model=KMM4 \
  --rotors=BETA-V-VI-VIII \
  --ring=AAAV \
  --position=VJNA \
  --reflector=BTHIN \
  --plugboard="AE BF CM DQ HU JN LX PR SZ VW"
```

### Commercial Models

Commercial models don't have a plugboard and use different rotors:

**Enigma K (Commercial):**
```bash
./bin/enigma encode "BUSINESSMESSAGE" \
  --model=ENIGMA_K \
  --rotors=K_III-K_II-K_I \
  --reflector=K \
  --position=ABC
```

**Swiss-K:**
```bash
./bin/enigma encode "SWISSMILITARY" \
  --model=SWISS_K \
  --rotors=SWISS_K_III-SWISS_K_II-SWISS_K_I \
  --reflector=SWISS_K \
  --position=ABC
```

**Railway (Rocket):**
```bash
./bin/enigma encode "RAILWAYMESSAGE" \
  --model=RAILWAY \
  --rotors=RAILWAY_III-RAILWAY_II-RAILWAY_I \
  --reflector=RAILWAY \
  --position=ABC
```

### Enigma T (Tirpitz)

The Enigma T was used for German-Japanese communications:

```bash
./bin/enigma encode "TOKYOMESSAGE" \
  --model=TIRPITZ \
  --rotors=TIRPITZ_VIII-TIRPITZ_V-TIRPITZ_III \
  --reflector=TIRPITZ \
  --position=ABC
```

### Latin Text Conversion

Convert human-readable text with spaces, numbers, and accents:

```bash
./bin/enigma encode "Hello, World! 123" --latin
# Converts to: HELLOXWORLDXEINSTWODREI then encodes
```

With formatted 5-letter group output:

```bash
./bin/enigma encode "Panzer Division 7 nach München" --latin --format
# Output: CTLOP HZGAC EHCIA EGDWY QDERG HXASO AQSDT H
```

> **Tip:** To decode a formatted message, use `--strip-spaces` (`-x`) to remove spaces:
> ```bash
> ./bin/enigma encode "CTLOP HZGAC EHCIA EGDWY QDERG HXASO AQSDT H" -x
> # Output: PANZERXDIVISIONXSIEBENXNACHXMUENCHEN
> ```

The `--latin` option handles:
- **Spaces** → `X` (customizable)
- **Numbers** → German words (0=NULL, 1=EINS, 2=ZWEI, etc.)
- **Accents** → Base letters (é→E, ü→UE, ß→SS, etc.)
- **Punctuation** → Removed or converted

### Binary File Encoding

Encode any binary file (images, PDFs, executables, etc.) through Enigma:

```bash
# Encode a file
./bin/enigma encode -i photo.jpg -o photo.jpg.enigma

# With custom configuration
./bin/enigma encode -i secret.pdf -o secret.pdf.enigma \
  --rotors=V-II-IV --position=ABC --plugboard="AV BS CG"
```

Convert an Enigma-encoded file back to its original binary:

```bash
# Convert back to binary with the same settings used for encoding
./bin/enigma encode -i photo.jpg.enigma -o photo_decoded.jpg -t

# With custom configuration (must match encoding settings!)
./bin/enigma encode -i secret.pdf.enigma -o secret.pdf --to-binary \
  --rotors=V-II-IV --position=ABC --plugboard="AV BS CG"
```

> **Important:** File encoding uses Enigma's binary encoding mode, which converts each byte to two Enigma letters. The encoded file will be exactly twice the size of the original. To convert back, you **must** use the exact same Enigma configuration (model, rotors, ring settings, positions, reflector, and plugboard).

Example with configuration display:

```bash
./bin/enigma encode -i document.docx -o document.docx.enigma --show-config
# Output:
# ⚙ Enigma Machine
# ┌───────────┬──────────┐
# │ Setting   │ Value    │
# ├───────────┼──────────┤
# │ Model     │ WMLW     │
# │ Rotors    │ III-II-I │
# │ ...       │ ...      │
# └───────────┴──────────┘
# Encoding: document.docx
# Encoded to 24680 characters: document.docx.enigma
```

### Text File Encoding

Encode text from a file instead of command-line argument:

```bash
# Create a simple text file
echo "HELLOWORLD" > message.txt

# Encode it
./bin/enigma encode -I message.txt
# Output: MFNCZBBFZM
```

The text file mode validates that content is valid Enigma alphabet (A-Z). If the file contains non-alphabetic characters, a warning is displayed:

```bash
# File with non-alphabetic characters
echo "Hello World 123!" > message.txt

./bin/enigma encode -I message.txt
# ⚠ File contains 7 non-alphabetic characters that will be stripped
# ℹ Use --latin (-l) to convert numbers and special characters automatically
# Output: MFNCZBBFZM
```

Combine with `--latin` to convert numbers, accents, and punctuation:

```bash
./bin/enigma encode -I message.txt --latin
# Converts "Hello World 123!" to "HELLOXWORLDXEINSTWODREI" then encodes
```

Save the encoded output to a file:

```bash
./bin/enigma encode -I message.txt -o encoded.txt
```

> **Note:** Use `-i` (lowercase) for binary files and `-I` (uppercase) for text files. Binary mode uses a special encoding (2 letters per byte), while text mode encodes the actual letter content.

### Random Configuration

Generate a cryptographically secure random configuration:

```bash
./bin/enigma encode "SECRET" --random --show-config
```

Output:
```
 ! [NOTE] Using randomly generated configuration

Configuration
-------------

Model: WMLW | Rotors: V-IV-III | Ring: NDB | Position: RAE | Reflector: DORA | Plugs: AB CD EF GH JK LM NR TU VW XZ

 [OK] Encoded text:

LGSJWX
```

Random configuration for M4:

```bash
./bin/enigma encode "SECRET" --model=KMM4 --random --show-config
```

### Decoding Messages

**Enigma is a reciprocal cipher** — there is no separate decode operation. The same `encode` command decodes when you pass encoded text with identical settings:

```bash
# Step 1: Encode
./bin/enigma encode "HELLOWORLD" --rotors=III-II-I --position=AAA
# Output: MFNCZBBFZM

# Step 2: Decode (same command, same settings!)
./bin/enigma encode "MFNCZBBFZM" --rotors=III-II-I --position=AAA
# Output: HELLOWORLD
```

This works because of Enigma's electrical design: current flows through the rotors, reflects, and returns — if A encodes to M, then M encodes back to A (with the same rotor positions).

> **ℹ️ Why no `decode` alias?** Having aliases like `decode` or `decipher` could mislead users into thinking there's a different operation. Enigma fundamentally has only ONE operation that serves both purposes.

## Available Models

| Model | Description | Rotors | Plugboard |
|-------|-------------|--------|-----------|
| `WMLW` | Wehrmacht/Luftwaffe (3 rotors) | I-V | ✓ |
| `KMM3` | Kriegsmarine M3 (3 rotors) | I-VIII | ✓ |
| `KMM4` | Kriegsmarine M4 (4 rotors) | I-VIII + Beta/Gamma | ✓ |
| `ENIGMA_K` | Commercial Enigma K | K_I-K_III | ✗ |
| `SWISS_K` | Swiss Enigma K | SWISS_K_I-III | ✗ |
| `RAILWAY` | Railway Enigma (Rocket) | RAILWAY_I-III | ✗ |
| `TIRPITZ` | Enigma T (German-Japanese) | TIRPITZ_I-VIII | ✗ |

## Available Rotors

### Military Rotors

| Rotor | Models | Notch Position |
|-------|--------|----------------|
| `I` | WMLW, KMM3, KMM4 | Q |
| `II` | WMLW, KMM3, KMM4 | E |
| `III` | WMLW, KMM3, KMM4 | V |
| `IV` | WMLW, KMM3, KMM4 | J |
| `V` | WMLW, KMM3, KMM4 | Z |
| `VI` | KMM3, KMM4 | Z+M |
| `VII` | KMM3, KMM4 | Z+M |
| `VIII` | KMM3, KMM4 | Z+M |
| `BETA` | KMM4 (Greek position only) | — |
| `GAMMA` | KMM4 (Greek position only) | — |

### Commercial Rotors

| Rotor | Model |
|-------|-------|
| `K_I`, `K_II`, `K_III` | ENIGMA_K |
| `SWISS_K_I`, `SWISS_K_II`, `SWISS_K_III` | SWISS_K |
| `RAILWAY_I`, `RAILWAY_II`, `RAILWAY_III` | RAILWAY |
| `TIRPITZ_I` through `TIRPITZ_VIII` | TIRPITZ |

## Available Reflectors

| Reflector | Compatible Models |
|-----------|-------------------|
| `B` | WMLW, KMM3 |
| `C` | WMLW, KMM3 |
| `DORA` | WMLW (rewirable) |
| `BTHIN` | KMM4 |
| `CTHIN` | KMM4 |
| `K` | ENIGMA_K |
| `SWISS_K` | SWISS_K |
| `RAILWAY` | RAILWAY |
| `TIRPITZ` | TIRPITZ |

## Tips & Best Practices

### 1. Always Note Your Settings

When encoding important messages, use `--show-config` to display and record the exact configuration:

```bash
./bin/enigma encode "SECRET" --random --show-config
```

### 2. Test Reciprocity

After encoding, verify your settings by immediately decoding:

```bash
ENCODED=$(./bin/enigma encode "TEST" --rotors=III-II-I --position=ABC)
./bin/enigma encode "$ENCODED" --rotors=III-II-I --position=ABC
# Should output: TEST
```

### 3. Use Formatted Output for Transmission

Traditional Enigma messages were transmitted in 5-letter groups:

```bash
./bin/enigma encode "LONGMESSAGEHERE" --format
# Output: XYZAB CDEFG HIJKL
```

### 4. Decode Formatted Messages with Strip Spaces

When decoding a message received in 5-letter groups, use `--strip-spaces` (`-x`):

```bash
# Encode with formatting
./bin/enigma encode "SECRETMESSAGE" --format
# Output: MFNCZ BBFZM OUV

# Decode the formatted output (with spaces)
./bin/enigma encode "MFNCZ BBFZM OUV" --strip-spaces
# Output: SECRETMESSAGE
```

### 5. Rotor Order Convention

Rotors are specified **left to right** (slowest to fastest):
- `--rotors=III-II-I` means P3=III (left), P2=II (middle), P1=I (right)
- For M4: `--rotors=BETA-III-II-I` means Greek=BETA, P3=III, P2=II, P1=I

### 6. Ring and Position Settings

Both `--ring` and `--position` follow the same left-to-right convention:
- `--ring=XYZ` means P3=X, P2=Y, P1=Z
- `--position=ABC` means P3=A, P2=B, P1=C

### 7. Plugboard Format

Plugboard pairs can be specified in two ways:
- Space-separated: `--plugboard="AV BS CG"`
- Each pair is two letters that swap

### 8. Error Handling

The CLI provides helpful error messages:

```bash
./bin/enigma encode "SECRET" --rotors=I-I-III
# Error: Rotor I is already mounted in another position

./bin/enigma encode "SECRET" --model=KMM4 --rotors=III-II-I
# Error: Model KMM4 requires 4 rotors, got 3
```

---

For more information about the Enigma machine and its history, see the [main README](README.md).
