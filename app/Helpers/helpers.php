<?php

namespace EliteCodec\SwiftPeso\Helpers;

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

    public function verifyCsrfToken($token)
    {
        if (!isset($token) || $token !== $_SESSION['_token']) {
            $_SESSION['error'] = "Invalid csrf token.";
            return json_encode(['message' => 'Invalid Csrf Token']);
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

    public function getJsonBody(): array
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
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

    public function sendOtp($data)
    {
        try {
            $post_data = json_encode([
                'email_address' => $data['email'],
                'code' => $data['otp'],
                "expiry_time" => "30 mins",
                'api_key' => $_ENV['TREMIL_API_KEY'],
                'email_configuration_id' => $_ENV['TREMIL_EMAIL_ID']
            ]);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $_ENV['TREMIL_API'] . "/otp/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $post_data,
                CURLOPT_HTTPHEADER => [
                    'Content-Type: application/json'
                ],
            ]);

            // Execute the request
            $response = curl_exec($curl);
            curl_close($curl);

            $response_data = json_decode($response, true);
            if ($response_data && isset($response_data['code']) && $response_data['code'] === 'ok') {
                return ["status" => 200, "message" => "User registered successfully. OTP sent to email."];
            } else {
                error_log("Error Sending OTP: " . var_dump($response_data));
                return ['message' => 'User created successfully. Failed to send otp', 'status' => 403];
            }
        } catch (\Throwable $th) {
            error_log("Error Sending OTP: " . $th);
            return ['message' => 'Internal Server Error', 'status' => 500];
        }
    }

    public function jsonResponse(array $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function sanitizeString($value): ?string
    {
        return is_string($value) ? htmlspecialchars(trim($value)) : null;
    }

    public function sanitizeDecimal($value): ?float
    {
        return is_numeric($value) ? floatval($value) : null;
    }

    public function sanitizeInt($value): ?int
    {
        return is_numeric($value) ? intval($value) : null;
    }

    public function sanitizeDate($value): ?string
    {
        if (empty($value) || !is_string($value)) {
            return null;
        }

        $timestamp = strtotime($value);
        return $timestamp ? date('Y-m-d', $timestamp) : null;
    }
}
