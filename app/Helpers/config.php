<?php

function config($key)
{
    $segments = explode('.', $key);
    $file = __DIR__ . "/../../config/{$segments[0]}.php";

    if (file_exists($file)) {
        $config = require $file;

        return $config[$segments[1]] ?? null;
    }

    return null;
}
