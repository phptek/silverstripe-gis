# MapField

[Home](../../.) > [API](index.md) > MapField

![feature name](../images/MapField.png)

Form field for editing geometries.

## Configuration

#### private static Smindel\GIS\Forms\MapField::$default_location = array

```php
MapField::$default_location = [
    'lon' => $lon = (float)174.78,
    'lat' => $lat = (float)-41.29
]
```
__$lon__ is the default location's longitude, __$lat__ is it's latitude.

- [Smindel\GIS\Forms\MapField::$default_location](MapField.config.default_location.md) - Location to center empty MapFields and GridFieldMaps to

## Methods

### Smindel\GIS\Forms\MapField::__construct()

- [Smindel\GIS\Forms\MapField::__construct()](MapField.method.__construct.md) - Constructor
- [Smindel\GIS\Forms\MapField::setControl()](MapField.method.setControl.md) - Hide controls for selected shape types
- [Smindel\GIS\Forms\MapField::setMultiEnabled()](MapField.method.setMultiEnabled.md) - Enable multi geometries like MultiPoint or MultiPolygon

## Examples

### Adding a MapField to an admin form

After adding a new geo type to your DataObjects db fields, the form scaffolder automatically gives you a MapField to your ModelAdmin form. If you need to add one to your admin form manually e.g. because the form doesn't use the default scaffolder like CMS you can add it to your DataObject like this:

app/src/Model/CityPage.php

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
