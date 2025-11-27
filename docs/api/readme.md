# API Reference Index

## JulienBoudry\Enigma
| Class Name | Description |
| ------------- | ------------- |
| [Enigma](ref/JulienBoudry/Enigma/Enigma/class_Enigma.md) | _This class emulates the historical Enigma machine used during World War II. Three different models can be emulated (Wehrmacht/Luftwaffe, Kriegsmarine M3, and Kriegsmarine M4), each with its own set of..._ |
| [EnigmaPlugboard](ref/JulienBoudry/Enigma/EnigmaPlugboard/class_EnigmaPlugboard.md) | _The plugboard allows the operator to swap pairs of letters before and after the signal passes through the rotors. This adds an additional layer of encryption.  The initial setup has no swaps (each let..._ |
| [EnigmaTextConverter](ref/JulienBoudry/Enigma/EnigmaTextConverter/class_EnigmaTextConverter.md) | _Historical Enigma machines could only process the 26 letters A-Z. This class provides conversion utilities to transform any input text into a format suitable for Enigma encryption.  Common historical ..._ |
| [EnigmaWiring](ref/JulienBoudry/Enigma/EnigmaWiring/class_EnigmaWiring.md) | _This class implements the wiring used by rotors, reflectors, and the plugboard. Each wiring provides a monoalphabetical substitution, mapping each input letter to a different output letter.  Example w..._ |
| [RotorConfiguration](ref/JulienBoudry/Enigma/RotorConfiguration/class_RotorConfiguration.md) | _This class encapsulates the collection of rotors and provides type-safe access to rotors by their position. It accepts either RotorType enums (which will be converted to AbstractRotor instances) or pr..._ |

| Enum Name | Description |
| ------------- | ------------- |
| [EnigmaModel](ref/JulienBoudry/Enigma/EnigmaModel/enum_EnigmaModel.md) | _Defines the different historical Enigma machine variants that can be emulated. Each model has its own specific set of available rotors and reflectors._ |
| [Letter](ref/JulienBoudry/Enigma/Letter/enum_Letter.md) | _This backed enum provides type-safe letter handling for all Enigma operations. The integer backing values (0-25) are used internally for efficient wiring calculations.  Note: PHP enums cannot implemen..._ |
| [ReflectorType](ref/JulienBoudry/Enigma/ReflectorType/enum_ReflectorType.md) | _Defines the different reflector variants (Umkehrwalze) available for Enigma machines. Different Enigma models support different reflector types._ |
| [RotorPosition](ref/JulienBoudry/Enigma/RotorPosition/enum_RotorPosition.md) | _Defines the slots where rotors can be mounted. Most Enigma models have 3 positions (P1, P2, P3), while the Kriegsmarine M4 has an additional fourth "Greek" position that never rotates._ |
| [RotorType](ref/JulienBoudry/Enigma/RotorType/enum_RotorType.md) | _Defines the different rotor variants (Walzen) available for Enigma machines. Each rotor has unique internal wiring and notch positions. Different Enigma models support different subsets of these rotor..._ |

## JulienBoudry\Enigma\Reflector
| Class Name | Description |
| ------------- | ------------- |
| [AbstractReflector](ref/JulienBoudry/Enigma/Reflector/AbstractReflector/class_AbstractReflector.md) | _After passing through the plugboard and all rotors, the reflector redirects the signal back through the rotors in reverse order. Because no letter connects to itself, the signal always takes a differe..._ |
| [ReflectorB](ref/JulienBoudry/Enigma/Reflector/ReflectorB/class_ReflectorB.md) | _Standard reflector used with Wehrmacht/Luftwaffe and Kriegsmarine M3 models._ |
| [ReflectorBThin](ref/JulienBoudry/Enigma/Reflector/ReflectorBThin/class_ReflectorBThin.md) | _Thin reflector used exclusively with the Kriegsmarine M4 model. The thin design allows space for the fourth rotor._ |
| [ReflectorC](ref/JulienBoudry/Enigma/Reflector/ReflectorC/class_ReflectorC.md) | _Alternative reflector used with Wehrmacht/Luftwaffe and Kriegsmarine M3 models._ |
| [ReflectorCThin](ref/JulienBoudry/Enigma/Reflector/ReflectorCThin/class_ReflectorCThin.md) | _Thin reflector used exclusively with the Kriegsmarine M4 model. The thin design allows space for the fourth rotor._ |


## JulienBoudry\Enigma\Rotor
| Class Name | Description |
| ------------- | ------------- |
| [AbstractRotor](ref/JulienBoudry/Enigma/Rotor/AbstractRotor/class_AbstractRotor.md) | _The rotors are the key element of the Enigma. Each provides a monoalphabetical substitution through its internal wiring, but unlike the plugboard and reflector, rotors move, causing the substitution t..._ |
| [RotorBeta](ref/JulienBoudry/Enigma/Rotor/RotorBeta/class_RotorBeta.md) | _This rotor is placed in the leftmost (Greek) position and does not rotate. No notches (never triggers turnover)._ |
| [RotorGamma](ref/JulienBoudry/Enigma/Rotor/RotorGamma/class_RotorGamma.md) | _This rotor is placed in the leftmost (Greek) position and does not rotate. No notches (never triggers turnover)._ |
| [RotorI](ref/JulienBoudry/Enigma/Rotor/RotorI/class_RotorI.md) | _Notch at position Q (turnover at R)._ |
| [RotorII](ref/JulienBoudry/Enigma/Rotor/RotorII/class_RotorII.md) | _Notch at position E (turnover at F)._ |
| [RotorIII](ref/JulienBoudry/Enigma/Rotor/RotorIII/class_RotorIII.md) | _Notch at position V (turnover at W)._ |
| [RotorIV](ref/JulienBoudry/Enigma/Rotor/RotorIV/class_RotorIV.md) | _Notch at position J (turnover at K)._ |
| [RotorV](ref/JulienBoudry/Enigma/Rotor/RotorV/class_RotorV.md) | _Notch at position Z (turnover at A)._ |
| [RotorVI](ref/JulienBoudry/Enigma/Rotor/RotorVI/class_RotorVI.md) | _Double notch at positions M and Z (turnovers at N and A)._ |
| [RotorVII](ref/JulienBoudry/Enigma/Rotor/RotorVII/class_RotorVII.md) | _Double notch at positions M and Z (turnovers at N and A)._ |
| [RotorVIII](ref/JulienBoudry/Enigma/Rotor/RotorVIII/class_RotorVIII.md) | _Double notch at positions M and Z (turnovers at N and A)._ |


