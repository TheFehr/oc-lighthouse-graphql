<?php
namespace Uit\Lighthouse\Rules;

use Artisan;
use Illuminate\Contracts\Validation\Rule;
use Uit\Lighthouse\Classes\SchemaBuilder;

class ValidSchema implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
//        try {
            traceLog('validation schema...');
            Artisan::call('lighthouse:validate-schema');
            traceLog('done validating schema ...');

            return true;
//        } catch (Exception $_) {
//            return false;
//        }
    }

    /**
     * Validation callback method.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  array  $params
     * @return bool
     */
    public function validate($attribute, $value, $params)
    {
        return new \Exception(var_export([$attribute, $value, $params], true));
        return $this->passes($attribute, SchemaBuilder::build());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // TODO: Implement message() method.
    }
}