<?php

namespace Smindel\GIS\ORM;

use SilverStripe\PostgreSQL\PostgreSQLSchemaManager;
use SilverStripe\ORM\DB;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Control\Director;
use SilverStripe\Core\Config\Config;
use Smindel\GIS\GIS;
use Smindel\GIS\ORM\FieldType\DBGeometry;
use Exception;

/*
http://postgis.net/docs/PostGIS_Special_Functions_Index.html#PostGIS_3D_Functions
*/

if (!class_exists(PostgreSQLSchemaManager::class)) {
    return;
}

class PostGISSchemaManger extends PostgreSQLSchemaManager
{
    public function geography($values)
    {
        return 'geography';
    }

    public function geometry($values)
    {
        return 'geometry';
    }

    public function translateToWrite($field)
    {
        return $this->prepareFromText($field);
    }

    public function translateToRead($field)
    {
        $table = $field->getTable();
        $column = $field->getName();
        $identifier = $table ? sprintf('"%s"."%s"', $table, $column) : sprintf('"%s"', $column);
        return sprintf('ST_AsEWKT(%s) "%s"', $identifier, $column);
    }

    public function translateFilterWithin($field, $value, $inclusive)
    {
        if (!preg_match('/"([^"]+)"."([^"]+)"/', $field, $matches)) throw new Exception('Invalid $field parameter');
        $statementFragment = ['ST_GeomFromText(?, ?)' => GIS::split_ewkt($value)];

        $null = $inclusive ? '' : ' OR ' . DB::get_conn()->nullCheckClause($field, true);
        $fragment = sprintf('%sST_Covers(%s,%s)%s', $inclusive ? '' : 'NOT ', key($statementFragment), $field, $null);
        return [$fragment => reset($statementFragment)];
    }

    public function translateFilterGeoType($field, $value, $inclusive)
    {
        $null = $inclusive ? '' : ' OR ' . DB::get_conn()->nullCheckClause($field, true);
        $fragment = sprintf(
            '%sLOWER(ST_GeometryType(%s)) = ?%s',
            $inclusive ? '' : 'NOT ',
            $field,
            $null
        );
        return [$fragment => 'st_' . strtolower($value)];
    }

    public function translateFilterIntersects($field, $value, $inclusive)
    {
        $null = $inclusive ? '' : ' OR ' . DB::get_conn()->nullCheckClause($field, true);
        $fragment = sprintf('%sST_Intersects(ST_GeomFromText(?, ?),%s)%s', $inclusive ? '' : 'NOT ', $field, $null);
        return [$fragment => GIS::split_ewkt($value)];
    }

    public function translateFilterDWithin($field, $value, $inclusive)
    {
        $null = $inclusive ? '' : ' OR ' . DB::get_conn()->nullCheckClause($field, true);
        $fragment = sprintf('ST_Distance(ST_GeomFromText(?, ?),%s,true) %s ?%s', $field, $inclusive ? '<=' : '> ', $null);
        list($wkt, $srid) = GIS::split_ewkt($value[0]);
        $distance = $value[1];
        return [$fragment => [$wkt, $srid, $distance]];
    }

    public function translateDistanceQuery($geo1,$geo2)
    {
        list($wkt1, $srid1) = GIS::split_ewkt($geo1);
        list($wkt2, $srid2) = GIS::split_ewkt($geo2);
        return sprintf("ST_Distance(ST_GeomFromText('%s', %d),ST_GeomFromText('%s', %d),true)", $wkt1, $srid1, $wkt2, $srid2);
    }

    public function schemaUpdate($callback)
    {
        // @todo: terrible hack to make the postgis extension manually installed in the "public" schema
        // abailable in the unit test db
        if (Director::is_cli() && !Director::isLive()) {
            DB::get_conn()->setSchemaSearchPath(DB::get_conn()->currentSchema(), 'public');
        }
        parent::schemaUpdate($callback);
    }

    protected function prepareFromText($field)
    {
        list($wkt, $srid) = GIS::split_ewkt($field->getValue(), (int)$field->srid);

        if ($field instanceof DBGeometry) {
            return ['ST_GeomFromText(?, ?)' => [$wkt, $srid]];
        }

        if ($srid != 4326) {
            list($wkt) = GIS::split_ewkt(GIS::array_to_ewkt(GIS::reproject_array(GIS::ewkt_to_array($field->getValue()))));
        }
        return ['ST_GeogFromText(?)' => [$wkt]];
    }
}