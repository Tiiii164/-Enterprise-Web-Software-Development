<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_user' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'Staff' => [
            'ideas' => 'c,r,u'
        ],
        'Manager' => [
            'user' => 'c,r,u,d',
            'ideas' => 'c,r,u,d',
            'topics' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'departments' => 'c,r,u,d',
        ],
        'QaManager' => [
        ],
        'Admin' => [
            'user' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'ideas' => 'c,r,u,d',
            'topics' => 'c,r,u,d',
            'category' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'departments' => 'c,r,u,d',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
