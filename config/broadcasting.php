<?php
return [
    'default' => env('BROADCAST_CONNECTION', 'pusher'),
    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'encrypted' => env('PUSHER_APP_ENCRYPTED', true),
                'host' => env('PUSHER_HOST', 'api-' . env('PUSHER_APP_CLUSTER', 'mt1') . '.pusher.com'),
                'port' => env('PUSHER_PORT', 443),
                'scheme' => env('PUSHER_SCHEME', 'https'),
            ],
        ],
        'null' => [
            'driver' => 'null',
        ],
    ],
];