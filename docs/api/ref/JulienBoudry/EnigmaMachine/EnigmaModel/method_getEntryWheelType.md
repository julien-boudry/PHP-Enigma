> JulienBoudry \ [EnigmaModel](enum_EnigmaModel.md)
# Method getEntryWheelType()
> [Read it at source](https://github.com/julien-boudry/PHP-Enigma/tree/master/src/EnigmaModel.php#L102)

```php
public function EnigmaModel->getEntryWheelType( ): JulienBoudry\EnigmaMachine\EntryWheelType
```

## Description
Get the entry wheel type for this model.

Commercial models use QWERTZ keyboard order for the entry wheel.
Enigma T uses its own unique entry wheel order.
Military models use alphabetical (ABCDEF...) order.

## Return
**Type:** [`JulienBoudry\EnigmaMachine\EntryWheelType`](../EntryWheelType/enum_EntryWheelType.md)


