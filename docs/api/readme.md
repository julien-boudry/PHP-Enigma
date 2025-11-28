# API Reference Index

## JulienBoudry\Enigma
| Class Name | Description |
| ------------- | ------------- |
| [Enigma](ref/JulienBoudry/Enigma/Enigma/class_Enigma.md) | _This class emulates the historical Enigma machine used during World War II. Multiple models can be emulated: - Military models (Wehrmacht/Luftwaffe, Kriegsmarine M3/M4) with plugboard - Commercial mod..._ |
| [EnigmaConfiguration](ref/JulienBoudry/Enigma/EnigmaConfiguration/class_EnigmaConfiguration.md) | _This immutable value object holds all the configuration parameters needed to set up an Enigma machine. It can be created from scratch, generated randomly, or extracted from an existing Enigma machine._ |
| [EnigmaPlugboard](ref/JulienBoudry/Enigma/EnigmaPlugboard/class_EnigmaPlugboard.md) | _The plugboard allows the operator to swap pairs of letters before and after the signal passes through the rotors. This adds an additional layer of encryption.  The initial setup has no swaps (each let..._ |
| [EnigmaRandomConfigurator](ref/JulienBoudry/Enigma/EnigmaRandomConfigurator/class_EnigmaRandomConfigurator.md) | _This class provides methods to generate cryptographically secure random configurations compatible with specific Enigma models. For testing purposes, a deterministic random engine can be injected.  Gen..._ |
| [EnigmaTextConverter](ref/JulienBoudry/Enigma/EnigmaTextConverter/class_EnigmaTextConverter.md) | _Historical Enigma machines could only process the 26 letters A-Z. This class provides conversion utilities to transform any input text into a format suitable for Enigma encryption.  Common historical ..._ |
| [EnigmaWiring](ref/JulienBoudry/Enigma/EnigmaWiring/class_EnigmaWiring.md) | _This class implements the wiring used by rotors, reflectors, and the plugboard. Each wiring provides a monoalphabetical substitution, mapping each input letter to a different output letter.  Example w..._ |
| [RotorConfiguration](ref/JulienBoudry/Enigma/RotorConfiguration/class_RotorConfiguration.md) | _This class encapsulates the collection of rotors and provides type-safe access to rotors by their position. It accepts either RotorType enums (which will be converted to AbstractRotor instances) or pr..._ |

| Enum Name | Description |
| ------------- | ------------- |
| [EnigmaModel](ref/JulienBoudry/Enigma/EnigmaModel/enum_EnigmaModel.md) | _Defines the different historical Enigma machine variants that can be emulated. Each model has its own specific set of available rotors and reflectors._ |
| [EntryWheelType](ref/JulienBoudry/Enigma/EntryWheelType/enum_EntryWheelType.md) | _The entry wheel is the first component the signal passes through when entering the rotor assembly. Different Enigma models use different entry wheel types._ |
| [Letter](ref/JulienBoudry/Enigma/Letter/enum_Letter.md) | _This backed enum provides type-safe letter handling for all Enigma operations. The integer backing values (0-25) are used internally for efficient wiring calculations.  Note: PHP enums cannot implemen..._ |
| [ReflectorType](ref/JulienBoudry/Enigma/ReflectorType/enum_ReflectorType.md) | _Defines the different reflector variants (Umkehrwalze) available for Enigma machines. Different Enigma models support different reflector types._ |
| [RotorPosition](ref/JulienBoudry/Enigma/RotorPosition/enum_RotorPosition.md) | _Defines the slots where rotors can be mounted. Most Enigma models have 3 positions (P1, P2, P3), while the Kriegsmarine M4 has an additional fourth "Greek" position that never rotates.  Signal flow: K..._ |
| [RotorType](ref/JulienBoudry/Enigma/RotorType/enum_RotorType.md) | _Defines the different rotor variants (Walzen) available for Enigma machines. Each rotor has unique internal wiring and notch positions. Different Enigma models support different subsets of these rotor..._ |

## JulienBoudry\Enigma\EntryWheel
| Class Name | Description |
| ------------- | ------------- |
| [AbstractEntryWheel](ref/JulienBoudry/Enigma/EntryWheel/AbstractEntryWheel/class_AbstractEntryWheel.md) | _The entry wheel is the first component the signal passes through when entering the rotor assembly. It maps keyboard positions to rotor contact positions.  Different Enigma models use different entry w..._ |
| [AlphabeticalEntryWheel](ref/JulienBoudry/Enigma/EntryWheel/AlphabeticalEntryWheel/class_AlphabeticalEntryWheel.md) | _Military Enigma models (Wehrmacht, Kriegsmarine) use alphabetical order: A→0, B→1, C→2, ... (identity mapping)  This is effectively a pass-through - the letter position equals the contact position...._ |
| [QwertzEntryWheel](ref/JulienBoudry/Enigma/EntryWheel/QwertzEntryWheel/class_QwertzEntryWheel.md) | _Commercial models (Enigma K, Swiss-K, Railway) use QWERTZ keyboard order: Q→0, W→1, E→2, R→3, T→4, Z→5, U→6, I→7, O→8, A→9, S→10, D→11, F→12, G→13, H→14, J→15, K→16, P→17, Y→18, X→19, C→20, V→21, B→22..._ |
| [TirpitzEntryWheel](ref/JulienBoudry/Enigma/EntryWheel/TirpitzEntryWheel/class_TirpitzEntryWheel.md) | _The Enigma T was used for communication between Germany and Japan. It uses a unique entry wheel order that is neither alphabetical nor QWERTZ: K→0, Z→1, R→2, O→3, U→4, Q→5, H→6, Y→7, A→8, I→9, G→10, B..._ |


## JulienBoudry\Enigma\Exception
| Class Name | Description |
| ------------- | ------------- |
| [EnigmaConfigurationException](ref/JulienBoudry/Enigma/Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md) | _This includes: - Incompatible rotor/model combinations - Incompatible reflector/model combinations - Invalid rotor positions (e.g., Greek rotor in wrong position) - Duplicate rotors  These errors can ..._ |
| [EnigmaWiringException](ref/JulienBoudry/Enigma/Exception/EnigmaWiringException/class_EnigmaWiringException.md) | _This exception is thrown for hardware-level wiring errors that cannot be bypassed, such as: - Invalid DORA reflector pairs (wrong count, duplicate letters, self-connections) - Invalid rotor wiring con..._ |


## JulienBoudry\Enigma\Reflector
| Class Name | Description |
| ------------- | ------------- |
| [AbstractReflector](ref/JulienBoudry/Enigma/Reflector/AbstractReflector/class_AbstractReflector.md) | _After passing through the plugboard and all rotors, the reflector redirects the signal back through the rotors in reverse order. Because no letter connects to itself, the signal always takes a differe..._ |
| [ReflectorB](ref/JulienBoudry/Enigma/Reflector/ReflectorB/class_ReflectorB.md) | _Standard reflector used with Wehrmacht/Luftwaffe and Kriegsmarine M3 models._ |
| [ReflectorBThin](ref/JulienBoudry/Enigma/Reflector/ReflectorBThin/class_ReflectorBThin.md) | _Thin reflector used exclusively with the Kriegsmarine M4 model. The thin design allows space for the fourth rotor._ |
| [ReflectorC](ref/JulienBoudry/Enigma/Reflector/ReflectorC/class_ReflectorC.md) | _Alternative reflector used with Wehrmacht/Luftwaffe and Kriegsmarine M3 models._ |
| [ReflectorCThin](ref/JulienBoudry/Enigma/Reflector/ReflectorCThin/class_ReflectorCThin.md) | _Thin reflector used exclusively with the Kriegsmarine M4 model. The thin design allows space for the fourth rotor._ |
| [ReflectorDora](ref/JulienBoudry/Enigma/Reflector/ReflectorDora/class_ReflectorDora.md) | _The UKW-D was a rewirable reflector introduced by the Wehrmacht/Luftwaffe in January 1944. Unlike fixed reflectors (B, C), operators could configure their own wiring using plug cables.  The physical d..._ |
| [ReflectorK](ref/JulienBoudry/Enigma/Reflector/ReflectorK/class_ReflectorK.md) | _Standard commercial wiring (handelsübliche Schaltung). Also used by Swiss-K (the Swiss only rewired the rotors, not the reflector).  Note: The commercial models use QWERTZ entry wheel, but the reflect..._ |
| [ReflectorRailway](ref/JulienBoudry/Enigma/Reflector/ReflectorRailway/class_ReflectorRailway.md) | _Rewired reflector used by the German Reichsbahn (Railway). Wiring recovered in 2023 from physical measurement of UKW K456._ |
| [ReflectorSwissK](ref/JulienBoudry/Enigma/Reflector/ReflectorSwissK/class_ReflectorSwissK.md) | _The Swiss used the same reflector wiring as the commercial Enigma K. They only modified the rotor wirings for additional security._ |
| [ReflectorTirpitz](ref/JulienBoudry/Enigma/Reflector/ReflectorTirpitz/class_ReflectorTirpitz.md) | _The Enigma T was used for German-Japanese military communications during WW2. It has a unique reflector wiring and uses the Tirpitz entry wheel._ |


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
| [RotorKI](ref/JulienBoudry/Enigma/Rotor/RotorKI/class_RotorKI.md) | _Standard commercial wiring (handelsübliche Schaltung). Used in Enigma K (A27) from 1927-1944. Notch at position G (turnover at Y)._ |
| [RotorKII](ref/JulienBoudry/Enigma/Rotor/RotorKII/class_RotorKII.md) | _Standard commercial wiring (handelsübliche Schaltung). Used in Enigma K (A27) from 1927-1944. Notch at position M (turnover at E)._ |
| [RotorKIII](ref/JulienBoudry/Enigma/Rotor/RotorKIII/class_RotorKIII.md) | _Standard commercial wiring (handelsübliche Schaltung). Used in Enigma K (A27) from 1927-1944. Notch at position V (turnover at N)._ |
| [RotorRailwayI](ref/JulienBoudry/Enigma/Rotor/RotorRailwayI/class_RotorRailwayI.md) | _Rewired rotor used by the German Reichsbahn (Railway). Wiring recovered in 2023 from Enigma K serial number K438. Notch at position G (turnover at Y)._ |
| [RotorRailwayII](ref/JulienBoudry/Enigma/Rotor/RotorRailwayII/class_RotorRailwayII.md) | _Rewired rotor used by the German Reichsbahn (Railway). Wiring recovered in 2023 from Enigma K serial number K438. Notch at position M (turnover at E)._ |
| [RotorRailwayIII](ref/JulienBoudry/Enigma/Rotor/RotorRailwayIII/class_RotorRailwayIII.md) | _Rewired rotor used by the German Reichsbahn (Railway). Wiring recovered in 2023 from Enigma K serial number K438. Notch at position V (turnover at N)._ |
| [RotorSwissKI](ref/JulienBoudry/Enigma/Rotor/RotorSwissKI/class_RotorSwissKI.md) | _Modified wiring used by the Swiss Army, Air Force, and Foreign Ministry. The Swiss rewired the rotors after receiving the machines from Germany. Notch at position G (turnover at Y)._ |
| [RotorSwissKII](ref/JulienBoudry/Enigma/Rotor/RotorSwissKII/class_RotorSwissKII.md) | _Modified wiring used by the Swiss Army, Air Force, and Foreign Ministry. The Swiss rewired the rotors after receiving the machines from Germany. Notch at position M (turnover at E)._ |
| [RotorSwissKIII](ref/JulienBoudry/Enigma/Rotor/RotorSwissKIII/class_RotorSwissKIII.md) | _Modified wiring used by the Swiss Army, Air Force, and Foreign Ministry. The Swiss rewired the rotors after receiving the machines from Germany. Notch at position V (turnover at N)._ |
| [RotorTirpitzI](ref/JulienBoudry/Enigma/Rotor/RotorTirpitzI/class_RotorTirpitzI.md) | _Used for German-Japanese military communications during WW2. Has 5 notches at positions E, H, K, N, Q._ |
| [RotorTirpitzII](ref/JulienBoudry/Enigma/Rotor/RotorTirpitzII/class_RotorTirpitzII.md) | _Used for German-Japanese military communications during WW2. Has 5 notches at positions E, H, K, N, Q._ |
| [RotorTirpitzIII](ref/JulienBoudry/Enigma/Rotor/RotorTirpitzIII/class_RotorTirpitzIII.md) | _Used for German-Japanese military communications during WW2. Has 5 notches at positions E, H, K, N, Q._ |
| [RotorTirpitzIV](ref/JulienBoudry/Enigma/Rotor/RotorTirpitzIV/class_RotorTirpitzIV.md) | _Used for German-Japanese military communications during WW2. Has 5 notches at positions E, H, K, N, Q._ |
| [RotorTirpitzV](ref/JulienBoudry/Enigma/Rotor/RotorTirpitzV/class_RotorTirpitzV.md) | _Used for German-Japanese military communications during WW2. Has 5 notches at positions E, H, K, N, Q._ |
| [RotorTirpitzVI](ref/JulienBoudry/Enigma/Rotor/RotorTirpitzVI/class_RotorTirpitzVI.md) | _Used for German-Japanese military communications during WW2. Has 5 notches at positions E, H, K, N, Q._ |
| [RotorTirpitzVII](ref/JulienBoudry/Enigma/Rotor/RotorTirpitzVII/class_RotorTirpitzVII.md) | _Used for German-Japanese military communications during WW2. Has 5 notches at positions E, H, K, N, Q._ |
| [RotorTirpitzVIII](ref/JulienBoudry/Enigma/Rotor/RotorTirpitzVIII/class_RotorTirpitzVIII.md) | _Used for German-Japanese military communications during WW2. Has 5 notches at positions E, H, K, N, Q._ |
| [RotorV](ref/JulienBoudry/Enigma/Rotor/RotorV/class_RotorV.md) | _Notch at position Z (turnover at A)._ |
| [RotorVI](ref/JulienBoudry/Enigma/Rotor/RotorVI/class_RotorVI.md) | _Double notch at positions M and Z (turnovers at N and A)._ |
| [RotorVII](ref/JulienBoudry/Enigma/Rotor/RotorVII/class_RotorVII.md) | _Double notch at positions M and Z (turnovers at N and A)._ |
| [RotorVIII](ref/JulienBoudry/Enigma/Rotor/RotorVIII/class_RotorVIII.md) | _Double notch at positions M and Z (turnovers at N and A)._ |


