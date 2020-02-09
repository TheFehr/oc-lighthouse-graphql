<?php namespace Uit\Lighthouse;

use App;
use Backend;
use Validator;
use System\Classes\PluginBase;
use Uit\Lighthouse\Rules\ValidSchema;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
    }

    public function boot()
    {
        Validator::extend('validSchema', ValidSchema::class);

        App::register('\Uit\Lighthouse\Provider\LighthouseServiceProvider');
        //AliasLoader::getInstance()->alias('Socialite', 'Laravel\Socialite\Facades\Socialite');

        // $pluginNamespace = str_replace('\\', '.', strtolower(__NAMESPACE__));

        // // Get the packages to boot
        // $packages = Config::get($pluginNamespace . '::packages');

        // // Boot each package
        // foreach ($packages as $name => $options) {
        //     // Setup the configuration for the package, pulling from this plugin's config
        //     if (!empty($options['config']) && !empty($options['config_namespace'])) {
        //         Config::set($options['config_namespace'], $options['config']);
        //     }
        // }

    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'GraphQL',
                'description' => 'Manage GraphQL Server.',
                'category'    => 'GraphQL',
                'icon'        => 'icon-globe',
                'class'       => 'Uit\Lighthouse\Models\Settings',
                'order'       => 500
            ]
        ];
    }
}
