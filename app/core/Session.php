<?php
namespace App\Core;

class Session {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function has($key) {
        return isset($_SESSION[$key]);
    }

    public function remove($key) {
        unset($_SESSION[$key]);
    }

    public function destroy() {
        session_destroy();
        $_SESSION = [];
    }

    public function flash($key, $message = null) {
        if ($message !== null) {
            $this->set($key, $message);
        } else {
            $value = $this->get($key);
            $this->remove($key);
            return $value;
        }
    }

    public function regenerate() {
        session_regenerate_id(true);
    }
}
