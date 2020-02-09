<?php
namespace Uit\Lighthouse\Models;

use Model;
use Uit\Lighthouse\Classes\SchemaBuilder;

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
    public $rules = [
        'base_schema' => 'validSchema'
    ];

    public function afterSave() {
        SchemaBuilder::build();
    }
}