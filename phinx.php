<?php

use Dotenv\Dotenv;

// Define base path
define('BASE_PATH', __DIR__); // Adjust if needed

require_once BASE_PATH . '/vendor/autoload.php';

// Load the .env file
if (file_exists(BASE_PATH . '/.env')) {
    $dotenv = Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();
}

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/database/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter'    => getenv('DB_DRIVER') ?: ($_ENV['DB_DRIVER'] ?? 'mysql'),
            'host'       => getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? 'localhost'),
            'name'       => getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'production_db'),
            'user'       => getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root'),
            'pass'       => getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? ''),
            'port'       => getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? '3306'),
            'charset'    => getenv('DB_CHARSET') ?: ($_ENV['DB_CHARSET'] ?? 'utf8mb4'),
            'collation'  => getenv('DB_COLLATION') ?: ($_ENV['DB_COLLATION'] ?? 'utf8mb4_unicode_ci'),
            'driver'     => getenv('DB_DRIVER') ?: ($_ENV['DB_DRIVER'] ?? 'mysql'),
        ],
        'development' => [
            'adapter'    => getenv('DB_DRIVER') ?: ($_ENV['DB_DRIVER'] ?? 'mysql'),
            'host'       => getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? 'localhost'),
            'name'       => getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'development_db'),
            'user'       => getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root'),
            'pass'       => getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? ''),
            'port'       => getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? '3306'),
            'charset'    => getenv('DB_CHARSET') ?: ($_ENV['DB_CHARSET'] ?? 'utf8mb4'),
            'collation'  => getenv('DB_COLLATION') ?: ($_ENV['DB_COLLATION'] ?? 'utf8mb4_unicode_ci'),
            'driver'     => getenv('DB_DRIVER') ?: ($_ENV['DB_DRIVER'] ?? 'mysql'),
        ],
        'testing' => [
            'adapter'    => getenv('DB_DRIVER') ?: ($_ENV['DB_DRIVER'] ?? 'mysql'),
            'host'       => getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? 'localhost'),
            'name'       => getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'testing_db'),
            'user'       => getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root'),
            'pass'       => getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? ''),
            'port'       => getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? '3306'),
            'charset'    => getenv('DB_CHARSET') ?: ($_ENV['DB_CHARSET'] ?? 'utf8mb4'),
            'collation'  => getenv('DB_COLLATION') ?: ($_ENV['DB_COLLATION'] ?? 'utf8mb4_unicode_ci'),
            'driver'     => getenv('DB_DRIVER') ?: ($_ENV['DB_DRIVER'] ?? 'mysql'),
        ]
    ],
    'version_order' => 'creation'
];
