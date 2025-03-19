<?php

namespace Dannyokec\Realnaps\Helpers;

class Helpers
{
    public function route($name, $params = [])
    {
        // Convert dot notation to structured path (e.g., 'user.profile' → 'user/profile')
        $url = '/' . str_replace('.', '/', $name);

        // Replace placeholders with actual values (e.g., 'user/{id}/profile' → 'user/42/profile')
        foreach ($params as $key => $value) {
            $url = preg_replace('/\{' . preg_quote($key, '/') . '\}/', $value, $url);
        }

        // Remove any remaining placeholders (if not provided in $params)
        $url = preg_replace('/\{[a-zA-Z0-9_]+\}/', '', $url);

        return rtrim($url, '/'); // Ensure no trailing slash
    }

    public static function csrf_field()
    {
        if (!isset($_SESSION['_token'])) {
            $_SESSION['_token'] = bin2hex(random_bytes(32)); // Generate CSRF token if not set
        }
        return $_SESSION['_token'];
    }

    public function verifyCsrfToken($token) {
        if (!isset($token) || $token !== $_SESSION['_token']) {
            $_SESSION['error'] = "Invalid csrf token.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function old($key, $default = '')
    {
        return $_SESSION['old'][$key] ?? $default;
    }

    public function session($key = null, $default = null)
    {
        if (is_null($key)) {
            return $_SESSION ?? [];
        }

        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $value;
        }

        return $default;
    }

    public function generateUUID()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0x0fff) | 0x4000, // Version 4 UUID
            random_int(0, 0x3fff) | 0x8000, // Variant
            random_int(0, 0xffff),
            random_int(0, 0xffff),
            random_int(0, 0xffff)
        );
    }

    public function generateRandomString($length = 6)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }
}
