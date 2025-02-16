<?php

return [
    'hash_algorithm' => PASSWORD_BCRYPT,
    'jwt_secret' => getenv('JWT_SECRET') ?: 'your_jwt_secret_key',
    'token_expiry' => 3600, // 1 hour
];
