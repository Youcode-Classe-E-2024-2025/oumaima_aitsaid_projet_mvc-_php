<?php
namespace App\Core;

class Auth {
    private $db;
    private $session;
    private $security;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->session = new Session();
        $this->security = new Security();
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && $this->security->verifyPassword($password, $user['password'])) {
            $this->session->set('user_id', $user['id']);
            $this->session->set('user_role', $user['role']);
            $this->session->set('user_name', $user['name']);
            
            // Generate and store authentication token
            $token = $this->security->generateRandomToken();
            $this->session->set('auth_token', $token);
            
            return true;
        }
        return false;
    }
    public function register($userData) {
        $stmt = $this->db->prepare("
            INSERT INTO users (name, email, password, role) 
            VALUES (:name, :email, :password, :role)
        ");
        
        return $stmt->execute($userData);
    }
    

    public function logout() {
        $this->session->destroy();
        return true;
    }

    public function isAuthenticated() {
        return $this->session->get('user_id') !== null;
    }

    public function getCurrentUser() {
        if (!$this->isAuthenticated()) {
            return null;
        }

        $stmt = $this->db->prepare("SELECT id, name, email, role FROM users WHERE id = :id");
        $stmt->execute(['id' => $this->session->get('user_id')]);
        return $stmt->fetch();
    }

    public function hasRole($role) {
        return $this->session->get('user_role') === $role;
    }

    public function requireRole($role) {
        if (!$this->hasRole($role)) {
            header('Location: /login');
            exit();
        }
    }

    public function requireAuth() {
        if (!$this->isAuthenticated()) {
            header('Location: /login');
            exit();
        }
    }

    public function regenerateSession() {
        session_regenerate_id(true);
        $token = $this->security->generateRandomToken();
        $this->session->set('auth_token', $token);
    }

}
