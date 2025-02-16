<?php

return [
    'enabled' => getenv('CACHE_ENABLED') === 'true',
    'driver' => getenv('CACHE_DRIVER') ?: 'file', // Options: file, redis, memcached
    'path' => __DIR__ . '/../storage/cache/',
];
