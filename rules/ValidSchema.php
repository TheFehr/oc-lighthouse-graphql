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
        Artisan::call('lighthouse:validate-schema');
        return true;
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
        $valid = false;
        $validFilePath = plugins_path('uit/lighthouse/graphql/schema.graphql');
        $validFileBackupPath = plugins_path('uit/lighthouse/graphql/schema.graphql.valid');

        Log::info(var_export($params, true));
        $changeSchemaId = $params[0];
        if (\File::exists($validFilePath)) {
            \File::move($validFilePath, $validFileBackupPath);
        }
        try {
            SchemaBuilder::validationBuild($changeSchemaId, $value);
            $valid = $this->passes($attribute, $value);
        } catch (DefinitionException $definitionException) {
            if (\File::exists($validFileBackupPath)) {
                \File::move($validFileBackupPath, $validFilePath);
            }
            throw new ValidationException([$attribute => "The defined schema is not valid:\n" . $definitionException->getMessage()]);
        }

        return $valid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The defined schema is not valid";
    }
}