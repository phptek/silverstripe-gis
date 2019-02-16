# WebMapTileService

[Home](../../.) > [API](index.md) > WebMapTileService

![feature name](../images/WebMapTileService.png)

The configuration of the WebMapTileService applies to all Web Map Tile Services you expose. They can be overwritten in your DataObject classes.

## Configuration

- [Smindel\GIS\Control\WebMapTileService::$tile_buffer](WebMapTileService.config.tile_buffer.md) - Buffer around the tile
- [Smindel\GIS\Control\WebMapTileService::$tile_size](WebMapTileService.config.tile_size.md) - Tile size
- [Smindel\GIS\Control\WebMapTileService::$wrap_date](WebMapTileService.config.wrap_date.md) - How to wrap around the date line
- [Smindel\GIS\Control\WebMapTileService::$cache_path](WebMapTileService.config.cache_path.md) - Path to the cache directory
- [Smindel\GIS\Control\WebMapTileService::$cache_ttl](WebMapTileService.config.cache_ttl.md) - Maximum age of cached tiles
- [Smindel\GIS\Control\WebMapTileService::$default_style](WebMapTileService.config.default_style.md) - Default rendering style

This service is configured through your [DataObject class](#dataobject-setup).

In order to access the endpoint for the tiles you have to use the namespaced class name with the backslashes replaced with dashes:

    http://yourdomain/webmaptileservice/VendorName-ProductName-DataObjectClassName/Z/X/Y.png

If you want to filter records, you can do so by using the configured or default search fields. You can even use filter modifiers:

    .../DataObjectClassName/Z/X/Y.png?FieldName:StartsWith:not=searchTerm

Map frontends like Leaflet or Openlayers usually supply variable names for Z (Zoom), X and Y. For leaflet that would look like this:

```javascript
L.tileLayer('http://yourdomain/webmaptileservice/City/{z}/{x}/{y}.png').addTo(map);
```

If you set the special query parameter debug=1 the tile will be rendered with debugging info like borders, Z, X and Y values and the number of records that have been rendered.
