<?php
namespace Uit\Lighthouse\Rules;

use Artisan;
use Log;
use Illuminate\Contracts\Validation\Rule;
use Nuwave\Lighthouse\Exceptions\DefinitionException;
use October\Rain\Exception\ValidationException;
use Uit\Lighthouse\Classes\SchemaBuilder;

class ValidSchema implements Rule
{
    private $exception;

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws ValidationException
     */
    public function passes($attribute, $value)
    {
        try {
            Artisan::call('lighthouse:validate-schema');
            return true;
        } catch (DefinitionException $definitionException) {
            throw new ValidationException([$attribute => "The defined schema is not valid:\n" . $definitionException->getMessage()]);
        }
    }

    /**
     * Validation callback method.
     *
     * @param string $attribute
     * @param mixed $value
     * @param array $params
     * @return bool
     * @throws ValidationException
     */
    public function validate($attribute, $value, $params)
    {
        Log::info(var_export($params, true));
        $changeSchemaId = $params[0];
        \File::move(plugins_path('uit/lighthouse/graphql/schema.graphql'), plugins_path('uit/lighthouse/graphql/schema.graphql.valid'));
        SchemaBuilder::validationBuild($changeSchemaId, $value);
        $valid = $this->passes($attribute, $value);
        \File::move(plugins_path('uit/lighthouse/graphql/schema.graphql.valid'), plugins_path('uit/lighthouse/graphql/schema.graphql'));
        return $valid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->exception->getMessage();
    }
}