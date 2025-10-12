<?php

return [
    'groups' => [
        'kelompok-1' => [
            'name'     => 'FoodFinder — Kelompok 1',
            'base_url' => env('FF1_BASE', 'https://foodfinder.ct.ws'),
            'path'     => env('FF1_PATH', '/api.php'),
            'token'    => env('FF1_TOKEN', ''),

            'list_params' => ['action' => 'list', 'i' => env('FF1_LIST_I', '1')],
            'actions'     => [
                'create' => ['action' => 'create'],
                'update' => ['action' => 'update'],
                'delete' => ['action' => 'delete'],
            ],

            'headers' => [
                'common' => [
                    'Accept'     => 'application/json',
                    'User-Agent' => env('FF1_UA', ''),
                    'Referer'    => env('FF1_REFERER', ''),
                    'Cookie'     => env('FF1_COOKIE', ''),
                ],
                'by_action' => [
                    'create' => ['Content-Type' => 'application/json'],
                    'update' => ['Content-Type' => 'application/json'],
                    'delete' => ['Content-Type' => 'application/json'],
                ],
            ],

            'fields' => [
                'id'   => ['id','ID','id_makanan'],
                'name' => ['nama','name','title'],
                'desc' => ['deskripsi','description','desc'],
            ],
        ],
        // Tambahkan kelompok-2..8 dengan pola yang sama (ganti env prefix)
    ],
];
