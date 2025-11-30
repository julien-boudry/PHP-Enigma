# Enigma Machine CLI

A powerful command-line interface for encoding messages using the Enigma cipher machine.

> **⚡ Reciprocal Cipher:** Enigma is a *reciprocal cipher* — encoding and decoding are the **same operation**. To decode a message, simply pass it through Enigma again with identical settings. This is a fundamental property of Enigma's electrical circuit design.

## Table of Contents

- [Installation](#installation)
- [Quick Start](#quick-start)
- [Command Reference](#command-reference)
- [Usage Examples](#usage-examples)
- [Models, Rotors & Reflectors](#models-rotors--reflectors)
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

| Option | Short | Description | Default |
|--------|-------|-------------|---------|
| `text` | | The text to encode (A-Z only, or use `--latin`) | |
| `--model` | `-m` | Enigma model to use | `WMLW` |
| `--rotors` | `-r` | Rotors from left to right, separated by `-` | `III-II-I` |
| `--ring` | `-g` | Ring settings (Ringstellung), left to right | `AAA` |
| `--position` | `-p` | Initial positions (Grundstellung), left to right | `AAA` |
| `--reflector` | `-u` | Reflector (Umkehrwalze) to use | `B` |
| `--plugboard` | `-b` | Plugboard pairs, space-separated (e.g., `"AV BS CG"`) | *(empty)* |
| `--input-binary-file` | `-i` | Encode a binary file to Enigma letters | |
| `--input-text-file` | `-I` | Read text from a file and encode | |
| `--output-file` | `-o` | Write output to a file | |
| `--to-binary` | `-t` | Convert an Enigma-encoded file back to binary | *(off)* |
| `--latin` | `-l` | Convert Latin text (accents, numbers, punctuation) | *(off)* |
| `--strip-spaces` | `-x` | Remove spaces from input | *(off)* |
| `--format` | `-f` | Format output in traditional 5-letter groups | *(off)* |
| `--random` | | Generate a random configuration | *(off)* |
| `--show-config` | `-s` | Display the configuration used | *(off)* |
| `--no-strict` | | Disable strict mode (allow non-historical configurations) | *(off)* |

## Usage Examples

### Basic Encoding & Decoding

```bash
# Encode with custom settings
./bin/enigma encode "ATTACKATDAWN" --rotors=V-II-IV --position=ABC --ring=XYZ

# Decode (same command, same settings - Enigma is reciprocal)
./bin/enigma encode "ENCODED_TEXT" --rotors=V-II-IV --position=ABC --ring=XYZ
```

### Full Military Configuration

```bash
./bin/enigma encode "SECRETMESSAGE" \
  --model=WMLW \
  --rotors=V-II-IV \
  --ring=BUL \
  --position=ABC \
  --reflector=B \
  --plugboard="AV BS CG DL FU HZ IN KM OW RX"
```

### 4-Rotor Kriegsmarine M4

```bash
./bin/enigma encode "SECRETNAVY" \
  --model=KMM4 \
  --rotors=BETA-V-VI-VIII \
  --ring=AAAV \
  --position=VJNA \
  --reflector=BTHIN \
  --plugboard="AE BF CM DQ HU JN LX PR SZ VW"
```

### Commercial & Special Models

```bash
# Enigma K (no plugboard)
./bin/enigma encode "MESSAGE" --model=ENIGMA_K --rotors=K_III-K_II-K_I --reflector=K

# Enigma T Tirpitz
./bin/enigma encode "MESSAGE" --model=TIRPITZ --rotors=TIRPITZ_VIII-TIRPITZ_V-TIRPITZ_III --reflector=TIRPITZ
```

### Latin Text & Formatting

```bash
# Convert accents, numbers, spaces automatically
./bin/enigma encode "Panzer Division 7" --latin --format
# Output: CTLOP HZGAC EHCIA ...

# Decode formatted message (strip spaces first)
./bin/enigma encode "CTLOP HZGAC EHCIA" --strip-spaces
```

### File Encoding

```bash
# Encode binary file
./bin/enigma encode -i photo.jpg -o photo.jpg.enigma

# Decode back to binary (same settings!)
./bin/enigma encode -i photo.jpg.enigma -o photo_decoded.jpg --to-binary

# Encode text file
./bin/enigma encode -I message.txt -o encoded.txt
```

### Random Configuration

```bash
./bin/enigma encode "SECRET" --random --show-config
# Generates secure random settings and displays them
```

## Models, Rotors & Reflectors

📖 **[Complete Reference → MODELS.md](MODELS.md)**

Quick reference:

| Model | Rotors | Plugboard |
|-------|--------|-----------|
| `WMLW` | I-V | ✓ |
| `KMM3` | I-VIII | ✓ |
| `KMM4` | I-VIII + BETA/GAMMA | ✓ |
| `ENIGMA_K` | K_I-K_III | ✗ |
| `SWISS_K` | SWISS_K_I-III | ✗ |
| `RAILWAY` | RAILWAY_I-III | ✗ |
| `TIRPITZ` | TIRPITZ_I-VIII | ✗ |

## Tips & Best Practices

1. **Save your settings**: Use `--show-config` to record the configuration
2. **Rotor order**: Left to right (slowest to fastest): `--rotors=III-II-I`
3. **Ring/Position**: Same convention: `--ring=XYZ` → P3=X, P2=Y, P1=Z
4. **Formatted output**: Use `--format` for 5-letter groups, `--strip-spaces` to decode them
5. **File encoding**: Use `-i` for binary, `-I` for text files
6. **Strict mode**: Use `--no-strict` to allow non-historical configurations (e.g., plugboard on commercial models)

---

For more information about the Enigma machine and its history, see the [main README](README.md).
