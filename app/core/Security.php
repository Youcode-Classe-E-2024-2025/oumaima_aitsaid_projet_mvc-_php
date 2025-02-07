<?php
namespace App\Core;

class Security {
    private $session;

    public function __construct() {
        $this->session = new Session();
    }

    public function generateCsrfToken() {
        $token = bin2hex(random_bytes(32));
        $this->session->set('csrf_token', $token);
        return $token;
    }

    public function validateCsrfToken($token) {
        return hash_equals($this->session->get('csrf_token'), $token);
    }

    public function sanitizeInput($input) {
        if (is_array($input)) {
            return array_map([$this, 'sanitizeInput'], $input);
        }
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_ARGON2ID);
    }

    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    public function generateRandomToken($length = 32) {
        return bin2hex(random_bytes($length));
    }

    public function preventXSS($value) {
        return strip_tags($value);
    }

    public function sanitizeFileName($filename) {
        return preg_replace('/[^a-zA-Z0-9._-]/', '', $filename);
    }

    public function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function encryptData($data, $key) {
        $iv = random_bytes(16);
        $encrypted = openssl_encrypt($data, 'AES-256-CBC', $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }

    public function decryptData($encryptedData, $key) {
        $data = base64_decode($encryptedData);
        $iv = substr($data, 0, 16);
        $encrypted = substr($data, 16);
        return openssl_decrypt($encrypted, 'AES-256-CBC', $key, 0, $iv);
    }
}
