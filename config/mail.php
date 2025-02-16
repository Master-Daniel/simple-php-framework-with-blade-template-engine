<?php

return [
    'driver' => getenv('MAIL_DRIVER') ?: 'smtp',
    'host' => getenv('MAIL_HOST') ?: 'smtp.mailtrap.io',
    'port' => getenv('MAIL_PORT') ?: 2525,
    'username' => getenv('MAIL_USERNAME') ?: '',
    'password' => getenv('MAIL_PASSWORD') ?: '',
    'encryption' => getenv('MAIL_ENCRYPTION') ?: 'tls',
    'from_address' => getenv('MAIL_FROM_ADDRESS') ?: 'noreply@example.com',
    'from_name' => getenv('MAIL_FROM_NAME') ?: 'RealNap',
];
