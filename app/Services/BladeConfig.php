<?php

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;
use Dannyokec\Realnaps\Helpers\Helpers;

// Define paths
$views = BASE_PATH . '/resources/views';
$cache = BASE_PATH . '/storage/cache';

// Ensure cache directory exists
if (!is_dir($cache)) {
    mkdir($cache, 0777, true);
}

// Setup Filesystem
$filesystem = new Filesystem();

// Create Blade Compiler
$bladeCompiler = new BladeCompiler($filesystem, $cache);

// Register custom Blade directives
$helpers = new Helpers();

$bladeCompiler->directive('csrf', function () use ($helpers) {
    return '<input type="hidden" name="csrf_token" value="' . $helpers->csrf_field() . '">';
});

$bladeCompiler->directive('old', function ($expression) {
    return "<?php echo (new Dannyokec\Realnaps\Helpers\Helpers)->old($expression); ?>";
}); 

$bladeCompiler->directive('route', function ($expression) {
    return "<?php echo (new Dannyokec\Realnaps\Helpers\Helpers)->route($expression); ?>";
});

$bladeCompiler->directive('session', function ($expression) {
    return "(new Dannyokec\Realnaps\Helpers\Helpers)->session($expression)";
});

$bladeCompiler->directive('auth', function () {
    return "<?php if (isset(\$_SESSION['user'])): ?>";
});

$bladeCompiler->directive('endauth', function () {
    return "<?php endif; ?>";
});

// Setup Engine Resolver
$resolver = new EngineResolver();
$resolver->register('blade', function () use ($bladeCompiler) {
    return new CompilerEngine($bladeCompiler);
});

$resolver->register('php', function ($filesystem) {
    return new PhpEngine($filesystem);
});

// Setup View Factory
$finder = new FileViewFinder($filesystem, [$views]);
$blade = new Factory($resolver, $finder, new Dispatcher(new Container()));

// Return Blade instance
return $blade;
