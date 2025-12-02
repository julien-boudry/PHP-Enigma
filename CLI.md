# Enigma Machine CLI

A powerful command-line interface for encoding messages using the Enigma cipher machine.

> **⚡ Reciprocal Cipher:** Enigma is a *reciprocal cipher* — encoding and decoding are the **same operation**. To decode a message, simply pass it through Enigma again with identical settings. This is a fundamental property of Enigma's electrical circuit design.

## Table of Contents

- [Installation](#installation)
- [Quick Start](#quick-start)
- [Interactive Mode](#interactive-mode)
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

## Interactive Mode

When no text argument is provided, the CLI enters **interactive mode** — a beautiful, step-by-step configuration wizard:

```bash
./bin/enigma encode
```

```
╔══════════════════════════════════════════════════════════╗
║     ⚙ ENIGMA MACHINE ⚙  Interactive Configuration    ║
╚══════════════════════════════════════════════════════════╝

  Configure your Enigma machine step by step.
  Use arrow keys to navigate, Enter to select.

  [●○○○○○○] Step 1/7: Select Enigma Model

  💡 Military models (WMLW, KMM3, KMM4) have plugboards for extra security.
  💡 KMM4 is the famous 4-rotor naval Enigma used by U-boats.

   ▸ Which Enigma model?
  [WMLW    ] 🎖️  Wehrmacht/Luftwaffe - Standard military model (3R, 🔌 plugboard)
  [KMM3    ] ⚓ Kriegsmarine M3 - Naval 3-rotor model (3R, 🔌 plugboard)
  [KMM4    ] 🚢 Kriegsmarine M4 - Naval 4-rotor (U-boats) (4R, 🔌 plugboard)
  ...
```

### Interactive Features

- **Visual selectors**: Use arrow keys to browse models, rotors, and reflectors
- **Smart hints**: Contextual tips at each step
- **Validation**: Input is validated in real-time (letters A-Z, pair format, etc.)
- **Progressive disclosure**: Only relevant options are shown based on the selected model
- **Pre-filled defaults**: Press Enter to accept sensible defaults
- **Animated simulation**: Watch the Enigma machine encode each letter in real-time with a visual representation of rotors, lampboard, and keyboard

### Skipping Steps

Options passed on the command line **skip** the corresponding interactive step:

```bash
# Interactive mode, but model is pre-selected
./bin/enigma encode --model=KMM4

# Skip model, rotors, and ring selection
./bin/enigma encode --model=WMLW --rotors=V-II-IV --ring=XYZ
```

### Disabling Interactive Mode

Use `--no-interaction` (or `-n`) to disable interactive mode entirely:

```bash
# This will fail with an error (no text provided)
./bin/enigma encode -n

# Useful for scripts or non-TTY environments
echo "HELLO" | ./bin/enigma encode -n  # Piped input requires -n
```

### Raw Output Mode

Use `--raw` to output only the encoded text without any decoration:

```bash
# Clean output for piping or scripting
./bin/enigma encode "HELLO" --raw
# Output: MFNCZ

# Combine with other commands
./bin/enigma encode "SECRET" --raw | pbcopy  # Copy to clipboard (macOS)
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
| `--dora-wiring` | `-d` | Custom wiring for UKW-D (Dora) reflector, 13 pairs | *(default wiring)* |
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
| `--raw` | | Output raw text without decoration (for scripts/pipes) | *(off)* |
| `--no-interaction` | `-n` | Disable interactive mode (for scripts/pipes) | *(off)* |

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

### UKW-D (Dora) Reflector

The UKW-D (Umkehrwalze Dora) was a rewirable reflector used by the Wehrmacht/Luftwaffe from January 1944. Use `--dora-wiring` to specify custom wiring:

```bash
# With custom DORA wiring (13 letter pairs, J↔Y is fixed internally)
./bin/enigma encode "SECRETMESSAGE" \
  --model=WMLW \
  --reflector=DORA \
  --dora-wiring="AQ BW CE DT FX GR HU IZ JK LN MO PS VY"

# With default DORA wiring (omit --dora-wiring)
./bin/enigma encode "SECRETMESSAGE" --model=WMLW --reflector=DORA
```

> **Note:** `--dora-wiring` is only valid when `--reflector=DORA`. If used with another reflector, a warning is displayed and the option is ignored.

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
