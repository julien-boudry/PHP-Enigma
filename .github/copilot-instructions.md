# GitHub Copilot Instructions

## Project Guidelines

### Auto-generated Files

**NEVER edit files in the `docs/` directory** - this directory is auto-generated and any manual changes will be overwritten.

### Code Standards

- This project uses PHP 8.4+ with strict types
- All classes use type declarations and return types
- Enums are used for type-safe constants (RotorType, ReflectorType, EnigmaModel, etc.)

### Testing

- Run tests with `composer test`
- All new features should include test coverage
- Historical accuracy is validated against official Enigma examples
