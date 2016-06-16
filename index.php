<?php

use PageKit\Application;

return[
    'name' => 'chat',
    'type' => 'extension',
    'main' => function(Application $app){},
    'autoload' => [
        'Pagekit\\Chat\\' => 'src'
    ],
    'resources' => [
        'chat' => ''
    ],
    'config' => [
        'entries' => [
            ['message' => 'Create the server', 'done' => false],
            ['message' => 'Shutdown the server', 'done' => true],
            ['message' => 'Give parameters to your server', 'done' => false]
        ],
        'Port' => [
            ['message' => 'port', 'number' => 8080]
        ],
        'rooms' => [
            ['message' => 'number of rooms', 'number' => 5]
        ]
    ],
    'permissions' => [
        'chat:create chat room' => [
            'title' => 'create a chat room'
        ],
        'chat:join chat room' => [
            'title' => 'join a chat room'
        ]
    ],
    'nodes' => [
        'chat' => [
            'name' => '@chat',
            'label' => 'chat',
            'controller' => 'Pagekit\\Chat\\Controller\\ChatController',
            'protected' => true,
        ],
        'parameter' => [
            'name' => '@parameter',
            'label' => 'parameter',
            'controller' => 'Pagekit\\Chat\\Controller\\ParameterController',
            'protected' => true,
        ],
        'server' => [
            'name' => '@server',
            'label' => 'server',
            'controller' => 'Pagekit\\Chat\\Controller\\ServerController',
            'protected' => true,
            'frontpage' => true
        ]
    ],
    'routes' => [
        '/chat' => [
            'name' => '@chat',
            'controller' => 'Pagekit\\Chat\\Controller\\ChatController'
        ],
        '/chat/parameter' => [
            'name' => '@chat/parameter',
            'controller' => 'Pagekit\\Chat\\Controller\\ParameterController'
        ],
        '/chat/server' => [
            'name' => '@chat/server',
            'controller' => 'Pagekit\\Chat\\Controller\\ServerController'
        ]
    ],
    'menu' => [
        'chat' => [
            'label' => 'Chat',
            'url' => '@chat/parameter',
            'icon' => 'chat:chat.png',
            'active' => '@chat/parameter',
            'access' => 'chat : chat:create chat room || chat:join chat room',
            'priority' => 110
        ],
        'chat:parameter' => [
            'label' => 'Parameter',
            'parent' => 'chat',
            'url' => '@chat/parameter',
            'access' => 'chat:set the parameters of a chat room',
            'active' => '@chat/parameter'
        ],
        'chat:server' => [
            'label' => 'Server',
            'parent' => 'chat',
            'url' => '@chat/server',
            'access' => 'chat:create chat room',
            'active' => '@chat/server'
        ]
    ]
];

