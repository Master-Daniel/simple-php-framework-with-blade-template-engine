<?php

return [
    'app_name' => getenv('APP_NAME') ?: 'My Dashboard',
    'base_url' => getenv('APP_URL') ?: 'http://localhost/dashboard',
    'debug' => getenv('APP_DEBUG') === 'true',
    'timezone' => getenv('APP_TIMEZONE') ?: 'UTC',
    'locale' => getenv('APP_LOCALE') ?: 'en',
];
