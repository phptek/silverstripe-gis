# MapField

[Home](../../.) > [API](index.md) > MapField

![feature name](../images/MapField.png)

Form field for editing geometries.

## Configuration

- [Smindel\GIS\Forms\MapField::$default_location](MapField.config.default_location.md) - Location to center empty MapFields and GridFieldMaps to

## Methods

- [Smindel\GIS\Forms\MapField::setControl()](MapField.method.setControl.md) - Hide controls for selected shape types
- [Smindel\GIS\Forms\MapField::setMultiEnabled()](MapField.method.setMultiEnabled.md) - Enable multi geometries like MultiPoint, MultiLineString or MultiPolygon

## Examples

### Adding a MapField to a admin form

After adding a new geo type to your DataObjects db fields, the form scaffolder automatically gives you a MapField to your edit form. If you need to add one to your admin form manually e.g. because the form doesn't use the default scaffolder like CMS you can add it to your DataObject like this:

    <?php

    use Smindel\GIS\Forms\MapField;

    class CityPage
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
