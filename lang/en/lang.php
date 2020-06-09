<?php return [
    'plugin' => [
        'name' => 'Lighthouse',
        'description' => 'This plugin adds a graphql server endpoint as well as extends the RainLab Builder plugin to auto-generate a GraphQL Schema from database columns.'
    ],
    'models' => [
        'schema' => [
            'single' => 'Schema',
            'plural' => 'Schemes',
            'attributes' => [
                'activity' => 'Active',
                'name' => 'Name',
                'schema' => 'Schema'
            ]
        ],
        'base_schema' => [
            'single' => 'Base Schema',
            'attributes' => [
                'schema' => 'schema'
            ]
        ]
    ],
    'global' => [
        'updated_at' => 'Updated at'
    ]
];
