<?php

return [
    'role_structure' => [
        'superadministrator' => [
            'users' => 'c,r,u,d,ad',
            'role' => 'c,r,u,d,ad',
        ],
    ],
    'permission_structure' => [

    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'ad'=>'activate-deactivate'
    ]
];
