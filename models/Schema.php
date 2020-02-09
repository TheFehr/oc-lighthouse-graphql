<?php namespace Uit\Lighthouse\Models;

use Model;
use Input;
use Uit\Lighthouse\Rules\ValidSchema;
use Validator;
use Log;
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
    public $rules = [];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function afterSave()
    {
        SchemaBuilder::build();
        parent::afterSave();
    }

    protected function beforeValidate()
    {
        $model = $this;

        if ($model->published) {
            Log::info("Validating schema");
            Validator::extend('schemaValid', function ($attribute, $value, $parameters) use ($model) {
                return (new ValidSchema())->validate($attribute, $value, [$model->id]);
            });
            $this->rules['schema'] = 'schemaValid';
        }
    }
}
