# API Reference Index

## JulienBoudry\EnigmaMachine
| Class Name | Description |
| ------------- | ------------- |
| [Enigma](ref/JulienBoudry/EnigmaMachine/Enigma/class_Enigma.md) | _Represents an Enigma cipher machine._ |
| [EnigmaConfiguration](ref/JulienBoudry/EnigmaMachine/EnigmaConfiguration/class_EnigmaConfiguration.md) | _Represents an Enigma machine configuration._ |
| [EnigmaPlugboard](ref/JulienBoudry/EnigmaMachine/EnigmaPlugboard/class_EnigmaPlugboard.md) | _Represents the Plugboard (Steckerbrett) of an Enigma machine._ |
| [EnigmaRandomConfigurator](ref/JulienBoudry/EnigmaMachine/EnigmaRandomConfigurator/class_EnigmaRandomConfigurator.md) | _Generates random configurations for Enigma machines._ |
| [EnigmaTextConverter](ref/JulienBoudry/EnigmaMachine/EnigmaTextConverter/class_EnigmaTextConverter.md) | _Converts arbitrary text to Enigma-compatible format (A-Z only)._ |
| [EnigmaWiring](ref/JulienBoudry/EnigmaMachine/EnigmaWiring/class_EnigmaWiring.md) | _Represents the internal wiring of Enigma components._ |
| [RotorConfiguration](ref/JulienBoudry/EnigmaMachine/RotorConfiguration/class_RotorConfiguration.md) | _Represents the configuration of rotors for an Enigma machine._ |

| Enum Name | Description |
| ------------- | ------------- |
| [EnigmaModel](ref/JulienBoudry/EnigmaMachine/EnigmaModel/enum_EnigmaModel.md) | _Enumeration of Enigma machine models._ |
| [EntryWheelType](ref/JulienBoudry/EnigmaMachine/EntryWheelType/enum_EntryWheelType.md) | _Types of Entry Wheels (Eintrittswalze, ETW) used in Enigma machines._ |
| [Letter](ref/JulienBoudry/EnigmaMachine/Letter/enum_Letter.md) | _Enumeration representing the 26 letters of the Enigma alphabet._ |
| [ReflectorType](ref/JulienBoudry/EnigmaMachine/ReflectorType/enum_ReflectorType.md) | _Enumeration of available reflector types._ |
| [RotorPosition](ref/JulienBoudry/EnigmaMachine/RotorPosition/enum_RotorPosition.md) | _Enumeration of rotor positions in the Enigma machine._ |
| [RotorType](ref/JulienBoudry/EnigmaMachine/RotorType/enum_RotorType.md) | _Enumeration of available rotor types._ |

## JulienBoudry\EnigmaMachine\EntryWheel
| Class Name | Description |
| ------------- | ------------- |
| [AbstractEntryWheel](ref/JulienBoudry/EnigmaMachine/EntryWheel/AbstractEntryWheel/class_AbstractEntryWheel.md) | _Abstract base class for Entry Wheels (Eintrittswalze, ETW)._ |
| [AlphabeticalEntryWheel](ref/JulienBoudry/EnigmaMachine/EntryWheel/AlphabeticalEntryWheel/class_AlphabeticalEntryWheel.md) | _Alphabetical Entry Wheel used in military Enigma models._ |
| [QwertzEntryWheel](ref/JulienBoudry/EnigmaMachine/EntryWheel/QwertzEntryWheel/class_QwertzEntryWheel.md) | _QWERTZ Entry Wheel used in commercial Enigma models._ |
| [TirpitzEntryWheel](ref/JulienBoudry/EnigmaMachine/EntryWheel/TirpitzEntryWheel/class_TirpitzEntryWheel.md) | _Tirpitz Entry Wheel used in the Enigma T (Tirpitz)._ |


## JulienBoudry\EnigmaMachine\Exception
| Class Name | Description |
| ------------- | ------------- |
| [EnigmaConfigurationException](ref/JulienBoudry/EnigmaMachine/Exception/EnigmaConfigurationException/class_EnigmaConfigurationException.md) | _Exception thrown when an Enigma machine configuration is invalid._ |
| [EnigmaWiringException](ref/JulienBoudry/EnigmaMachine/Exception/EnigmaWiringException/class_EnigmaWiringException.md) | _Exception thrown when wiring configuration is invalid._ |


## JulienBoudry\EnigmaMachine\Reflector
| Class Name | Description |
| ------------- | ------------- |
| [AbstractReflector](ref/JulienBoudry/EnigmaMachine/Reflector/AbstractReflector/class_AbstractReflector.md) | _Abstract base class for Enigma Reflectors (Umkehrwalze)._ |
| [ReflectorB](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorB/class_ReflectorB.md) | _Reflector B (Umkehrwalze B)._ |
| [ReflectorBThin](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorBThin/class_ReflectorBThin.md) | _Reflector B Thin (Umkehrwalze B Dünn)._ |
| [ReflectorC](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorC/class_ReflectorC.md) | _Reflector C (Umkehrwalze C)._ |
| [ReflectorCThin](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorCThin/class_ReflectorCThin.md) | _Reflector C Thin (Umkehrwalze C Dünn)._ |
| [ReflectorDora](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorDora/class_ReflectorDora.md) | _UKW-D (Umkehrwalze Dora) - Rewirable Reflector._ |
| [ReflectorK](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorK/class_ReflectorK.md) | _Commercial Enigma K (A27) Reflector (Umkehrwalze)._ |
| [ReflectorRailway](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorRailway/class_ReflectorRailway.md) | _Railway Enigma (Rocket) Reflector (Umkehrwalze)._ |
| [ReflectorSwissK](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorSwissK/class_ReflectorSwissK.md) | _Swiss-K Reflector (Umkehrwalze)._ |
| [ReflectorTirpitz](ref/JulienBoudry/EnigmaMachine/Reflector/ReflectorTirpitz/class_ReflectorTirpitz.md) | _Enigma T (Tirpitz) Reflector (Umkehrwalze)._ |


## JulienBoudry\EnigmaMachine\Rotor
| Class Name | Description |
| ------------- | ------------- |
| [AbstractRotor](ref/JulienBoudry/EnigmaMachine/Rotor/AbstractRotor/class_AbstractRotor.md) | _Abstract base class for Enigma rotors (Walzen)._ |
| [RotorBeta](ref/JulienBoudry/EnigmaMachine/Rotor/RotorBeta/class_RotorBeta.md) | _Rotor Beta - Greek rotor for Kriegsmarine M4 only._ |
| [RotorGamma](ref/JulienBoudry/EnigmaMachine/Rotor/RotorGamma/class_RotorGamma.md) | _Rotor Gamma - Greek rotor for Kriegsmarine M4 only._ |
| [RotorI](ref/JulienBoudry/EnigmaMachine/Rotor/RotorI/class_RotorI.md) | _Rotor I - Available on all Enigma models._ |
| [RotorII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorII/class_RotorII.md) | _Rotor II - Available on all Enigma models._ |
| [RotorIII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorIII/class_RotorIII.md) | _Rotor III - Available on all Enigma models._ |
| [RotorIV](ref/JulienBoudry/EnigmaMachine/Rotor/RotorIV/class_RotorIV.md) | _Rotor IV - Available on all Enigma models._ |
| [RotorKI](ref/JulienBoudry/EnigmaMachine/Rotor/RotorKI/class_RotorKI.md) | _Commercial Enigma K Rotor I._ |
| [RotorKII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorKII/class_RotorKII.md) | _Commercial Enigma K Rotor II._ |
| [RotorKIII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorKIII/class_RotorKIII.md) | _Commercial Enigma K Rotor III._ |
| [RotorRailwayI](ref/JulienBoudry/EnigmaMachine/Rotor/RotorRailwayI/class_RotorRailwayI.md) | _Railway Enigma (Rocket) Rotor I._ |
| [RotorRailwayII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorRailwayII/class_RotorRailwayII.md) | _Railway Enigma (Rocket) Rotor II._ |
| [RotorRailwayIII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorRailwayIII/class_RotorRailwayIII.md) | _Railway Enigma (Rocket) Rotor III._ |
| [RotorSwissKI](ref/JulienBoudry/EnigmaMachine/Rotor/RotorSwissKI/class_RotorSwissKI.md) | _Swiss-K Rotor I (Swiss Air Force wiring)._ |
| [RotorSwissKII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorSwissKII/class_RotorSwissKII.md) | _Swiss-K Rotor II (Swiss Air Force wiring)._ |
| [RotorSwissKIII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorSwissKIII/class_RotorSwissKIII.md) | _Swiss-K Rotor III (Swiss Air Force wiring)._ |
| [RotorTirpitzI](ref/JulienBoudry/EnigmaMachine/Rotor/RotorTirpitzI/class_RotorTirpitzI.md) | _Rotor I for Enigma T (Tirpitz)._ |
| [RotorTirpitzII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorTirpitzII/class_RotorTirpitzII.md) | _Rotor II for Enigma T (Tirpitz)._ |
| [RotorTirpitzIII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorTirpitzIII/class_RotorTirpitzIII.md) | _Rotor III for Enigma T (Tirpitz)._ |
| [RotorTirpitzIV](ref/JulienBoudry/EnigmaMachine/Rotor/RotorTirpitzIV/class_RotorTirpitzIV.md) | _Rotor IV for Enigma T (Tirpitz)._ |
| [RotorTirpitzV](ref/JulienBoudry/EnigmaMachine/Rotor/RotorTirpitzV/class_RotorTirpitzV.md) | _Rotor V for Enigma T (Tirpitz)._ |
| [RotorTirpitzVI](ref/JulienBoudry/EnigmaMachine/Rotor/RotorTirpitzVI/class_RotorTirpitzVI.md) | _Rotor VI for Enigma T (Tirpitz)._ |
| [RotorTirpitzVII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorTirpitzVII/class_RotorTirpitzVII.md) | _Rotor VII for Enigma T (Tirpitz)._ |
| [RotorTirpitzVIII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorTirpitzVIII/class_RotorTirpitzVIII.md) | _Rotor VIII for Enigma T (Tirpitz)._ |
| [RotorV](ref/JulienBoudry/EnigmaMachine/Rotor/RotorV/class_RotorV.md) | _Rotor V - Available on all Enigma models._ |
| [RotorVI](ref/JulienBoudry/EnigmaMachine/Rotor/RotorVI/class_RotorVI.md) | _Rotor VI - Available on Kriegsmarine M3 and M4 only._ |
| [RotorVII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorVII/class_RotorVII.md) | _Rotor VII - Available on Kriegsmarine M3 and M4 only._ |
| [RotorVIII](ref/JulienBoudry/EnigmaMachine/Rotor/RotorVIII/class_RotorVIII.md) | _Rotor VIII - Available on Kriegsmarine M3 and M4 only._ |


