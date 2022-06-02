<?php

return [
    'role_structure' => [
        'super_admin' => [
            'users' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'slider' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'articles' => 'c,r,u,d',
            'brands' => 'c,r,u,d',
            'messages' => 'c,r,u,d',


        ],
        'admin' => [],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
