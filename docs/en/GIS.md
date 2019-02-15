# ClassName

[Home](../../.) > [API](index.md) > GIS

GIS utility class

## Configuration

- [Smindel\GIS\GIS::$default_srid](GIS.config.default_srid.md) - Default spacial reference sytem id
- [Smindel\GIS\GIS::$projections](GIS.config.projections.md) - [proj4 definitions](https://epsg.io/) for SRIDs 4326, 3857 and 2193 are preconfigured

## Methods

- [Smindel\GIS\GIS::array_to_ewkt()](GIS.method.array_to_ewkt.md) - Transforms a geometry from array to EWKT representation
- [Smindel\GIS\GIS::distance()](GIS.method.distance.md) - Returns the distance between geometries
- [Smindel\GIS\GIS::ewkt_to_array()](GIS.method.ewkt_to_array.md) - Transforms a geometry from EWKT to array representation
- [Smindel\GIS\GIS::get_type()](GIS.method.get_type.md) - Returns the shape type of a geometry
- [Smindel\GIS\GIS::of()](GIS.method.of.md) - Returns the name of the geometry property of the given DataObject class
- [Smindel\GIS\GIS::reproject_array()](GIS.method.reproject_array.md) - Re-projects a geometry
- [Smindel\GIS\GIS::split_ewkt()](GIS.method.split_ewkt.md) - Splits an $ewkt string into the [SRID](https://en.wikipedia.org/wiki/Spatial_reference_system#Identifier) and [WKT](https://en.wikipedia.org/wiki/Well-known_text_representation_of_geometry)
