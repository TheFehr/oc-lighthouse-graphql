<?php namespace TheFehr\Lighthouse;

use App;
use Backend;
use TheFehr\Lighthouse\FormWidgets\GraphQLSchemaEditor;
use Validator;
use System\Classes\PluginBase;
use TheFehr\Lighthouse\Rules\ValidSchema;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.Builder'];
    
    public function boot()
    {
        App::register('\TheFehr\Lighthouse\Provider\LighthouseServiceProvider');
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'GraphQL',
                'description' => 'Manage GraphQL Server.',
                'category'    => 'GraphQL',
                'icon'        => 'icon-globe',
                'class'       => 'TheFehr\Lighthouse\Models\Settings',
                'order'       => 500
            ]
        ];
    }
}
