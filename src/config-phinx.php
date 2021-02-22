<?php

declare(strict_types=1);

require_once 'Config/DbConfig.php';

use App\Config\DbConfig;

return [
    'paths' => [
        'migrations' => '/app/src/migrations',
        'seeds' => '/app/src/seeds'
    ],
    'migration_base_class' => '\App\Migration\Migration',
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => DbConfig::DB_NAME,
        'dev' => [
            'adapter' => DbConfig::DB_DEFAULT_DRIVER,
            'host' => DbConfig::DB_HOST,
            'name' => DbConfig::DB_NAME,
            'user' => DbConfig::DB_USER,
            'pass' => DbConfig::DB_PASSWORD,
            'port' => DbConfig::DB_PORT,
        ]
    ]
];
