<?php namespace Uit\Lighthouse\Models;

use Model;
use Uit\Lighthouse\Classes\SchemaBuilder;

/**
 * Model
 */
class Schema extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'uit_lighthouse_schemes';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'schema' => 'validSchema'
    ];

    public function scopePublished($query){
        return $query->where('published', true);
    }

    public function afterSave() {
        SchemaBuilder::build();
    }
}
