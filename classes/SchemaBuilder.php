<?php


namespace Uit\Lighthouse\Classes;


use Uit\Lighthouse\Models\Schema;
use Uit\Lighthouse\Models\Settings;

class SchemaBuilder
{
    public static function build()
    {
        $schemes = Schema::published()->get();
        $schemesBody = Settings::get('base_schema') . $schemes->implode("schema", "\n");
        \File::put(plugins_path('uit/lighthouse/graphql/schema.graphql'), $schemesBody);
    }

    public static function validationBuild($changedSchema)
    {

    }
}