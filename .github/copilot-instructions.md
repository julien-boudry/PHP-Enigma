# GitHub Copilot Instructions

## Project Guidelines

### Auto-generated Files

- The `docs/` directory is auto-generated. Do not edit files there manually.

### Code Standards

- This project uses PHP 8.4+ with strict types
- All classes use type declarations and return types
- Enums are used for type-safe constants (RotorType, ReflectorType, EnigmaModel, etc.)

### Testing

- Run tests with `composer test`
- All new features should include test coverage
- Historical accuracy is validated against official Enigma examples

### Documentation & Instructions

- **README.md**:
    - Always update the README.md when making API changes.
    - **CRITICAL**: You MUST update the Table of Contents in README.md immediately after adding, renaming, or moving sections.
- **Instructions**:
    - If you identify a change in project standards, workflows, or requirements, propose an update to this file (`.github/copilot-instructions.md`).
- **Auto-generated**:
    - **NEVER edit files in the `docs/` directory** - this directory is auto-generated and any manual changes will be overwritten.
