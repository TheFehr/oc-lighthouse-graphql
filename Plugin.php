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
        
        App::error(function($e) {
            if(preg_match('/direrror/',$e->getMessage())) {
    				return 'The plugin directory does not exist and could not be created.';
    	    }
            if(preg_match('/yamlerror/',$e->getMessage())) {
    				return 'The YAML content could not be created.';
    	    }  
            if(preg_match('/fileerror/',$e->getMessage())) {
    				return 'The YAML file could not be opened.';
    	    }    
            if(preg_match('/writeerror/',$e->getMessage())) {
    				return 'The YAML file could not be written.';
    	    }     	    
        });
    } 
    
    public function registerPermissions()
    {
        return [
            'rainlab.builder.manage_schemas' => [
                'tab' => 'rainlab.builder::lang.plugin.name',
                'label' => 'rainlab.builder::lang.plugin.manage_schemas']
        ];
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
