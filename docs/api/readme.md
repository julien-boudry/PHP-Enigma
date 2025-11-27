# API Reference Index

## JulienBoudry\Enigma
| Class Name | Description |
| ------------- | ------------- |
| [Enigma](ref/JulienBoudry/Enigma/Enigma/class_Enigma.md) | _This class emulates the historical Enigma machine used during World War II. Three different models can be emulated (Wehrmacht/Luftwaffe, Kriegsmarine M3, and Kriegsmarine M4), each with its own set of..._ |
| [EnigmaPlugboard](ref/JulienBoudry/Enigma/EnigmaPlugboard/class_EnigmaPlugboard.md) | _The plugboard allows the operator to swap pairs of letters before and after the signal passes through the rotors. This adds an additional layer of encryption.  The initial setup has no swaps (each let..._ |
| [EnigmaReflector](ref/JulienBoudry/Enigma/EnigmaReflector/class_EnigmaReflector.md) | _After passing through the plugboard and all rotors, the reflector redirects the signal back through the rotors in reverse order. Because no letter connects to itself, the signal always takes a differe..._ |
| [EnigmaRotor](ref/JulienBoudry/Enigma/EnigmaRotor/class_EnigmaRotor.md) | _The rotors are the key element of the Enigma. Each provides a monoalphabetical substitution through its internal wiring, but unlike the plugboard and reflector, rotors move, causing the substitution t..._ |
| [EnigmaSetup](ref/JulienBoudry/Enigma/EnigmaSetup/class_EnigmaSetup.md) | _This class stores the wiring configuration, compatible Enigma models, and notch positions for a specific rotor or reflector type. It is used to initialize the available components of an Enigma machine..._ |
| [EnigmaTextConverter](ref/JulienBoudry/Enigma/EnigmaTextConverter/class_EnigmaTextConverter.md) | _Historical Enigma machines could only process the 26 letters A-Z. This class provides conversion utilities to transform any input text into a format suitable for Enigma encryption.  Common historical ..._ |
| [EnigmaWiring](ref/JulienBoudry/Enigma/EnigmaWiring/class_EnigmaWiring.md) | _This class implements the wiring used by rotors, reflectors, and the plugboard. Each wiring provides a monoalphabetical substitution, mapping each input letter to a different output letter.  Example w..._ |
| [RotorConfiguration](ref/JulienBoudry/Enigma/RotorConfiguration/class_RotorConfiguration.md) | _This class encapsulates the collection of rotors and provides type-safe access to rotors by their position. It also validates that the correct number of rotors is configured for the given Enigma model..._ |
| [RotorSelection](ref/JulienBoudry/Enigma/RotorSelection/class_RotorSelection.md) | _This class encapsulates the choice of which rotors to use in each position before they are actually mounted in the machine. It provides type-safe access to rotor types by their position._ |

| Enum Name | Description |
| ------------- | ------------- |
| [EnigmaModel](ref/JulienBoudry/Enigma/EnigmaModel/enum_EnigmaModel.md) | _Defines the different historical Enigma machine variants that can be emulated. Each model has its own specific set of available rotors and reflectors._ |
| [Letter](ref/JulienBoudry/Enigma/Letter/enum_Letter.md) | _This backed enum provides type-safe letter handling for all Enigma operations. The integer backing values (0-25) are used internally for efficient wiring calculations.  Note: PHP enums cannot implemen..._ |
| [ReflectorType](ref/JulienBoudry/Enigma/ReflectorType/enum_ReflectorType.md) | _Defines the different reflector variants (Umkehrwalze) available for Enigma machines. Different Enigma models support different reflector types._ |
| [RotorPosition](ref/JulienBoudry/Enigma/RotorPosition/enum_RotorPosition.md) | _Defines the slots where rotors can be mounted. Most Enigma models have 3 positions (P1, P2, P3), while the Kriegsmarine M4 has an additional fourth "Greek" position that never rotates._ |
| [RotorType](ref/JulienBoudry/Enigma/RotorType/enum_RotorType.md) | _Defines the different rotor variants (Walzen) available for Enigma machines. Each rotor has unique internal wiring and notch positions. Different Enigma models support different subsets of these rotor..._ |

