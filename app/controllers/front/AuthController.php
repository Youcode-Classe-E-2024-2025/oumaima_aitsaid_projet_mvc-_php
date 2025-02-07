<?php
namespace App\Controllers\Front;

use App\Core\Controller;
use App\Core\Auth;

class AuthController extends Controller {
    private $auth;

    public function __construct() {
        parent::__construct();
        $this->auth = new Auth();
    }

    public function loginForm() {
        $this->render('front/auth/login');
    }

    public function login() {
        if ($this->auth->login($_POST['email'], $_POST['password'])) {
            header('Location: /dashboard');
            exit();
        }
        $this->render('front/auth/login', ['error' => 'Identifiants invalides']);
    }

    public function logout() {
        $this->auth->logout();
        header('Location: /');
        exit();
    }
    public function registerForm() {
        $this->render('front/auth/register');
    }
    
    public function register() {
        $validator = new Validator();
        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ];
    
        if ($validator->validate($_POST, $rules)) {
            $userData = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $this->auth->hashPassword($_POST['password']),
                'role' => 'client'
            ];
    
            if ($this->auth->register($userData)) {
                $this->auth->login($_POST['email'], $_POST['password']);
                header('Location: /dashboard');
                exit();
            }
        }
    
        $this->render('front/auth/register', [
            'errors' => $validator->getErrors()
        ]);
    }
}