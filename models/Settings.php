<?php
namespace TheFehr\Lighthouse\Models;

use Config;
use Model;
use TheFehr\Lighthouse\Classes\SchemaBuilder;

class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    // A unique code
    public $settingsCode = 'uit_lighthouse_settings';

    // Reference to field configuration
    public $settingsFields = 'fields.yaml';

    /**
     * @var array Validation rules
     */
    public $rules = [];

    public function afterSave()
    {
        SchemaBuilder::build(Config::get('thefehr.lighthouse::schema.register'));
    }
}
