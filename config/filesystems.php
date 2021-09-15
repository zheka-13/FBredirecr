<?php
return [
    'default' => 'local',
    'disks'   => [
        'local' => [
            'driver' => 'local',
            'root'   => storage_path('app'),
        ],
        'logs' => [
            'driver' => 'local',
            'root'   => storage_path('logs'),
        ],
    ]
];
