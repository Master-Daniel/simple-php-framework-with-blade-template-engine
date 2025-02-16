<?php

use Bramus\Router\Router;
use Dannyokec\Realnaps\Controllers\DashboardController;

require BASE_PATH . '/vendor/autoload.php';

$router = new Router();

// Define home route
$router->get('/', function () use ($blade) {
    echo $blade->make('home', ['title' => 'Welcome'])->render();
});

// Define dashboard route
$router->get('/dashboard', function () use ($db, $blade) {
    $controller = new DashboardController($db, $blade);
    $controller->index();
});

// Handle 404 errors
$router->set404(function () use ($blade) {
    http_response_code(404);
    echo $blade->make('errors.404')->render();
});

// Run the router
$router->run();
