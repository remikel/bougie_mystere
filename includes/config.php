<?php

class Config {
    private static $config = null;
    
    public static function load() {
        if (self::$config === null) {
            self::$config = [];
            
            // Load .env file if exists
            $envFile = __DIR__ . '/../.env';
            if (file_exists($envFile)) {
                $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                        list($key, $value) = explode('=', $line, 2);
                        self::$config[trim($key)] = trim($value);
                    }
                }
            }
            
            // Fallback to hardcoded values (for backward compatibility)
            self::$config = array_merge([
                'MAILJET_API_KEY' => 'a1289d5009ad3b1720e5d4f71fcc0a6b',
                'MAILJET_SECRET_KEY' => 'b783a5aa39dfd20b2a3df353c6f58672',
                'MAILJET_FROM_EMAIL' => 'hello@noemiepulido-graphiste.com',
                'MAILJET_FROM_NAME' => 'Le père Nono',
                'APP_DEBUG' => false,
                'GENERATED_IMAGES_PATH' => './images/generated/',
                'BASE_URL' => 'http://localhost:8000',
                'SESSION_TIMEOUT' => 3600
            ], self::$config);
        }
        
        return self::$config;
    }
    
    public static function get($key, $default = null) {
        $config = self::load();
        return isset($config[$key]) ? $config[$key] : $default;
    }
}