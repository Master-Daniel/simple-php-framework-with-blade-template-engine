<?php

return [
    'session_name' => 'realnap_session',
    'lifetime' => 86400, // 1 day
    'secure' => getenv('SESSION_SECURE') === 'true', // Set to true for HTTPS
    'http_only' => true,
    'same_site' => 'Lax', // Options: 'Lax', 'Strict', 'None'
];
