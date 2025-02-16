<?php

// Enable error reporting (for development)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Load Composer dependencies
require BASE_PATH . '/vendor/autoload.php';
require BASE_PATH . '/app/Helpers/config.php';

// Load environment variables (if using .env)
if (file_exists(BASE_PATH . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();
}

// Start session
session_start();

// Initialize Database Connection
try {
    $db = new PDO(
        "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// Initialize Blade (Template Engine)
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;

$views = BASE_PATH . '/resources/views'; // Change this if your views folder is elsewhere
$cache = BASE_PATH . '/storage/cache'; // Make sure this folder exists

if (!is_dir($cache)) {
    mkdir($cache, 0777, true);
}

// Setup Filesystem and View Engine Resolver
$filesystem = new Filesystem();
$resolver = new EngineResolver();
$resolver->register('blade', function () use ($filesystem, $cache) {
    return new CompilerEngine(new BladeCompiler($filesystem, $cache));
});

$resolver->register('php', function () use ($filesystem) {
    return new PhpEngine($filesystem);
});

// Setup View Factory
$finder = new FileViewFinder($filesystem, [$views]);
$blade = new Factory($resolver, $finder, new Dispatcher(new Container()));

// Pass $blade and $db to routes
require BASE_PATH . '/routes/web.php';
