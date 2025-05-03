<?php

// app/Traits/LoggerTrait.php
namespace EliteCodec\SwiftPeso\Traits;

trait LoggerTrait
{
    /**
     * Create error log.
     *
     * @param string $message
     * @param int $context
     * @return void
     */
    protected function logError(string $message, string $context = 'general'): void
    {
        $logDir = BASE_PATH . '/storage/logs';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0777, true);
        }

        $date = date('Y-m-d');
        $logFile = "$logDir/{$context}_$date.log";
        $timestamp = date('[Y-m-d H:i:s]');
        $formatted = "$timestamp $message" . PHP_EOL;

        file_put_contents($logFile, $formatted, FILE_APPEND);
    }
}
