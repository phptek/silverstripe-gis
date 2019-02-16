# ORM Fileters

[Home](../../.) > [API](index.md) > ORM Filters

The module adds spatial filters to the ORM in order to query DataObjects. Most of them test relationships and accept a geometry as a parameter, except ST_Distance which expects an array of geometry and distance and ST_GeometryType which expects a shape type:

## Filters

- [ST_Contains](ORM-Filter.filter.ST_Contains.md) - Filter geometries that contain the given geometry
- [ST_Crosses](ORM-Filter.filter.ST_Crosses.md) - Filter geometries that cross the given geometry
- [ST_Disjoint](ORM-Filter.filter.ST_Disjoint.md) - Filter geometries that are disjoint from the given geometry
- [ST_Distance](ORM-Filter.filter.ST_Distance.md) - Filter geometries that are within distance of the given geometry
- [ST_Equals](ORM-Filter.filter.ST_Equals.md) - Filter geometries that are equal to the given geometry
- [ST_GeometryType](ORM-Filter.filter.ST_GeometryType.md) - Filter geometries of the given shape type
- [ST_Intersects](ORM-Filter.filter.ST_Intersects.md) - Filter geometries that intersect with the given geometry
- [ST_Overlaps](ORM-Filter.filter.ST_Overlaps.md) - Filter geometries that overlap the given geometry
- [ST_Touches](ORM-Filter.filter.ST_Touches.md) - Filter geometries that touch the given geometry
- [ST_Within](ORM-Filter.filter.ST_Within.md) - Filter geometries that lie within the given geometry

All filters can also be inverted using the `:not` modifier.
