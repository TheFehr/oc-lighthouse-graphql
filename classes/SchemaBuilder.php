<?php

namespace TheFehr\Lighthouse\Classes;

use TheFehr\Lighthouse\Models\Schema;
use TheFehr\Lighthouse\Models\Settings;

class SchemaBuilder
{
    public static function build($path)
    {
        $schemes = Schema::published()->get();
        $schemesBody = Settings::get('base_schema') . "\n" . $schemes->implode("schema", "\n");
        \File::put($path, $schemesBody);
    }

    public static function validationBuild($changedSchemaId, $newSchemaValue, $path)
    {
        $schemes = Schema::published()->whereNot('id', $changedSchemaId)->get();
        $schemesBody = Settings::get('base_schema') . "\n" . $schemes->implode("schema", "\n") . $newSchemaValue;
        \File::put($path, $schemesBody);
    }
}
