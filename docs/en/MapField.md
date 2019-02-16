# MapField

[Home](../../.) > [API](index.md) > MapField

![feature name](../images/MapField.png)

Extends FormField. Form field for editing geo types.

## Configuration

### private static Smindel\GIS\Forms\MapField::$default_location = array

Location to center empty MapFields and GridFieldMaps to

```php
MapField::$default_location = [
    'lon' => $lon = (float)174.78,
    'lat' => $lat = (float)-41.29,
];
```
- __$lon__ is the default location's longitude as a float
- __$lat__ is it's latitude as a float

## Methods

### public function Smindel\GIS\Forms\MapField::setControl(string $shapeType, bool $enabled = true) : Smindel\GIS\Forms\MapField

Hide controls for selected shape types

- __$shapeType__ Leaflet shape type, Note: those are different from the GIS shapes
- __$enabled__ whether to enable or disable the control in the widget

Returns the MapField instance for chaining

### public function Smindel\GIS\Forms\MapField::enableMulti($enable = true)

Enable multi geometries like MultiPoint or MultiPolygon

- __$enable__ whether to enable or disable the control in the widget

Returns the MapField instance for chaining

## Examples

### Adding a MapField to an admin form

After adding a new geo type to your DataObjects db fields, the form scaffolder automatically gives you a MapField to your ModelAdmin form. If you need to add one to your admin form manually e.g. because the form doesn't use the default scaffolder like CMS you can add it to your DataObject like this:

app/src/Model/CityPage.php

```php
<?php

use Smindel\GIS\Forms\MapField;

class CityPage extends Page
{
    private static $db = [
        'Location' => 'Geometry',
    ]

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', MapField::create('Location'), 'Content');
        return $fields;
    }
}
```
