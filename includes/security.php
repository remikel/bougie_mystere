<?php

class Security {
    
    /**
     * Generate CSRF token
     */
    public static function generateCSRFToken() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }
    
    /**
     * Verify CSRF token
     */
    public static function verifyCSRFToken($token) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    /**
     * Sanitize input data
     */
    public static function sanitizeInput($input) {
        if (is_array($input)) {
            return array_map([self::class, 'sanitizeInput'], $input);
        }
        
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Validate email address
     */
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    /**
     * Validate text input with length limits
     */
    public static function validateText($text, $minLength = 1, $maxLength = 255) {
        $text = trim($text);
        $length = strlen($text);
        return $length >= $minLength && $length <= $maxLength;
    }
    
    /**
     * Validate allowed values from a whitelist
     */
    public static function validateFromWhitelist($value, $allowedValues) {
        return in_array($value, $allowedValues, true);
    }
    
    /**
     * Rate limiting check
     */
    public static function checkRateLimit($identifier, $maxRequests = 5, $timeWindow = 300) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $key = 'rate_limit_' . $identifier;
        $now = time();
        
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = [];
        }
        
        // Clean old entries
        $_SESSION[$key] = array_filter($_SESSION[$key], function($timestamp) use ($now, $timeWindow) {
            return ($now - $timestamp) < $timeWindow;
        });
        
        // Check if limit exceeded
        if (count($_SESSION[$key]) >= $maxRequests) {
            return false;
        }
        
        // Add current request
        $_SESSION[$key][] = $now;
        return true;
    }
    
    /**
     * Generate secure filename
     */
    public static function generateSecureFilename($email, $extension = '.jpeg') {
        $hash = hash('sha256', $email . microtime(true) . random_bytes(16));
        return substr($hash, 0, 16) . date('Ymd_His') . $extension;
    }
}