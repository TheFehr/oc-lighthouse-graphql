<?php namespace TheFehr\Lighthouse\FormWidgets;

use Backend\Classes\FormWidgetBase;
use File;
use Str;

/**
 * GraphQLSchemaEditor Form Widget
 */
class GraphQLSchemaEditor extends FormWidgetBase
{
    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'thefehr_lighthouse_graph_q_l_schema_editor';

    /**
     * @inheritDoc
     */
    public function init()
    {
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('graphqlschemaeditor');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
        $this->vars['webpackAssetsUrl'] = asset('plugins/thefehr/lighthouse/formwidgets/graphqlschemaeditor/assets/');
        $this->vars['webpackUrl'] = asset('plugins/thefehr/lighthouse/formwidgets/graphqlschemaeditor/assets/graphqlschemaeditor.js');
    }

    /**
     * @inheritDoc
     */
    public function loadAssets()
    {
        $this->addCss('https://code.cdn.mozilla.net/fonts/fira.css');
    }

    /**
     * @inheritDoc
     */
    public function getSaveValue($value)
    {
        return $value;
    }
}
