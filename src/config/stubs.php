<?php


$make_middleware = [

    'file' => '{DummyFile}Middleware.stub',

    'content' =>
    file_get_contents(resources_path('stubs/{DummyFile}Middleware.stub')),

    'make_path' => app_path('http/middleware'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}Middleware' => ':name:',
        ],

        'content' => [

            '{DummyFile}' => ':name:',

            '{DummyClass}' => ':name:',

            '{DummyNamespace}' => 'Src\\App\\Http\\Middleware\\Classes',
        ],

        'content2' => [

            '{DummyFile}' => ':name:',

            '{DummyClass}' => ':name:',

            '{DummyNamespace}' => 'Src\\App\\Http\\Middleware\\Attributes',
        ]

    ]
];


$make_provider = [
    'file' => '{DummyFile}ServiceProvider.stub',
    'content' => file_get_contents(resources_path('stubs/{DummyFile}ServiceProvider.stub')),
    'make_path' => app_path('providers'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}' => ':name:',
        ],
        'content' => [

            '{DummyFile}' => ':name:',

            '{DummyClass}' => ':name:',

            '{DummyNamespace}' => 'Src\\App\\Providers',
        ]
    ]
];


$make_service = [

    'file' => '{DummyFile}Service.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Service.stub')),

    'make_path' => app_path('services'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}Service' => ':name:',
        ],
        'content' => [

            '{DummyFile}' => ':name:',

            '{DummyClass}' => ':name:',

            '{DummyNamespace}' => 'Src\\App\\Services',
        ]
    ]
];


$make_class = [
    'file' => '{DummyFile}Class.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Class.stub')),

    'make_path' => utils_path('classes'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}Class' => ':name:',
        ],
        'content' => [

            '{DummyFile}' => ':name:',

            '{DummyClass}' => ':name:',

            '{DummyNamespace}' => 'Src\\Utils\\Classes',
        ]
    ]
];


$make_attribute = [
    'file' => '{DummyFile}Attribute.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Attribute.stub')),

    'make_path' => utils_path('attributes'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}Attribute' => ':name:',
        ],
        'content' => [
            '{DummyFile}' => ':name:',

            '{DummyClass}' => ':name:',

            '{DummyNamespace}' => 'Src\\Utils\\Attributes',
        ]
    ]
];


$make_model = [

    'file' => '{DummyFile}Model.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Model.stub')),

    'make_path' => app_path('models'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}' => ':model:',
        ],
        'content' => [

            '{DummyFile}' => ':model:',

            '{DummyNamespace}' => 'Src\\App\\Models',

            '{DummyFile|snake}' => ':model:',
        ]
    ]
];



$make_interface = [
    'file' => '{DummyFile}Interface.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Interface.stub')),

    'make_path' => types_path('interfaces'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}' => ':name:',
        ],
        'content' => [

            '{DummyFile}Interface' => ':name:',

            '{DummyNamespace}' => 'Src\\Types\\Interfaces',

            '{DummyFile|snake}' => ':name:',
        ]
    ]
];

$make_trait = [
    'file' => '{DummyFile}Trait.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Trait.stub')),

    'make_path' => types_path('traits'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}Trait' => ':name:',
        ],
        'content' => [

            '{DummyFile}Trait' => ':name:',

            '{DummyNamespace}' => 'Src\\Utils\\Traits',

            '{DummyTrait|snake}' => ':name:',
        ]
    ]
];



$make_repository = [


    'file' => '{DummyFile}Repository.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Repository.stub')),

    'make_path' => app_path('repositories'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}' => ':name:',

            '{DummyFile|snake}' => ':name:'
        ],
        'content' => [
            '{DummyFile}' => ':name:',

            '{DummyFile|snake}' => ':name:',

            '{DummyNamespace}' => 'Src\\App\\Repositories'
        ]
    ]
];

$make_controller = [

    'file' => '{DummyFile}Controller.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Controller.stub')),

    'make_path' => app_path('http/controllers'),

    'replace' => [

        'file' => [

            'stub' => 'php',

            '{DummyFile}' => ':name:',

            '{DummyFile|snake}' => ':name:'
        ],
        'content' => [

            '{DummyFile}' => ':name:',

            '{DummyFile|snake}' => ':name:',

            '{DummyNamespace}' => 'Src\App\Http\Controllers'
        ]
    ]
];

$make_command = [

    'file' => '{DummyFile}Command.stub',

    'content' => file_get_contents(resources_path('stubs/{DummyFile}Command.stub')),

    'make_path' => base_path('bootstrap/Foundation/commands'),

    'replace' => [

        'file' => [
            'stub' => 'php',

            '{DummyFile}' => ':name:'
        ],

        'content' => [

            '{DummyClass}' => ':name:',

            '{DummyNamespace}' => 'Src\\Bootstrap\\Foundation\\Commands'
        ]
    ]
];




$configs = [

    'make:middleware' => $make_middleware,

    'make:provider' => $make_provider,

    'make:service' => $make_service,

    'make:class' => $make_class,

    'make:interface' => $make_interface,

    'make:trait' => $make_trait,

    'make:attribute' => $make_attribute,

    'make:model' => $make_model,

    'make:controller' => $make_controller,

    'make:repository' => $make_repository,

    'make:command' => $make_command,

];

return $configs;
