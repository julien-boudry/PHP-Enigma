> JulienBoudry \ **Enigma**
# Namespace: JulienBoudry\Enigma

## Classes

| Class Name | Description |
| ------------- | ------------- |
| [Enigma](Enigma/class_Enigma.md) | _This class emulates the historical Enigma machine used during World War II. Three different models can be emulated (Wehrmacht/Luftwaffe, Kriegsmarine M3, and Kriegsmarine M4), each with its own set of..._ |
| [EnigmaPlugboard](EnigmaPlugboard/class_EnigmaPlugboard.md) | _The plugboard allows the operator to swap pairs of letters before and after the signal passes through the rotors. This adds an additional layer of encryption.  The initial setup has no swaps (each let..._ |
| [EnigmaTextConverter](EnigmaTextConverter/class_EnigmaTextConverter.md) | _Historical Enigma machines could only process the 26 letters A-Z. This class provides conversion utilities to transform any input text into a format suitable for Enigma encryption.  Common historical ..._ |
| [EnigmaWiring](EnigmaWiring/class_EnigmaWiring.md) | _This class implements the wiring used by rotors, reflectors, and the plugboard. Each wiring provides a monoalphabetical substitution, mapping each input letter to a different output letter.  Example w..._ |
| [RotorConfiguration](RotorConfiguration/class_RotorConfiguration.md) | _This class encapsulates the collection of rotors and provides type-safe access to rotors by their position. It accepts either RotorType enums (which will be converted to AbstractRotor instances) or pr..._ |

## Enums

| Enum Name | Description |
| ------------- | ------------- |
| [EnigmaModel](EnigmaModel/enum_EnigmaModel.md) | _Defines the different historical Enigma machine variants that can be emulated. Each model has its own specific set of available rotors and reflectors._ |
| [Letter](Letter/enum_Letter.md) | _This backed enum provides type-safe letter handling for all Enigma operations. The integer backing values (0-25) are used internally for efficient wiring calculations.  Note: PHP enums cannot implemen..._ |
| [ReflectorType](ReflectorType/enum_ReflectorType.md) | _Defines the different reflector variants (Umkehrwalze) available for Enigma machines. Different Enigma models support different reflector types._ |
| [RotorPosition](RotorPosition/enum_RotorPosition.md) | _Defines the slots where rotors can be mounted. Most Enigma models have 3 positions (P1, P2, P3), while the Kriegsmarine M4 has an additional fourth "Greek" position that never rotates._ |
| [RotorType](RotorType/enum_RotorType.md) | _Defines the different rotor variants (Walzen) available for Enigma machines. Each rotor has unique internal wiring and notch positions. Different Enigma models support different subsets of these rotor..._ |
