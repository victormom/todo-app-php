<?php
// src/controllers/AuthController.php

class AuthController {
    private $db;
    private $user;

    public function __construct($db) {
        $this->db = $db;
        $this->user = new User($db);
    }

    public function showLogin() {
        if($this->isLoggedIn()) {
            header('Location: /index.php?action=tasks');
            exit();
        }
        include __DIR__ . '/../views/auth/login.php';
    }

    public function showRegister() {
        if($this->isLoggedIn()) {
            header('Location: /index.php?action=tasks');
            exit();
        }
        include __DIR__ . '/../views/auth/register.php';
    }

    public function login() {
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            // Validaciones
            if(empty($email)) {
                $errors[] = "El email es requerido";
            }
            if(empty($password)) {
                $errors[] = "La contraseña es requerida";
            }

            if(empty($errors)) {
                $this->user->email = $email;
                $this->user->password = $password;

                if($this->user->login()) {
                    $_SESSION['user_id'] = $this->user->id;
                    $_SESSION['username'] = $this->user->username;
                    $_SESSION['email'] = $this->user->email;
                    
                    header('Location: /index.php?action=tasks');
                    exit();
                } else {
                    $errors[] = "Credenciales incorrectas";
                }
            }
        }

        $_SESSION['errors'] = $errors;
        header('Location: /index.php?action=login');
        exit();
    }

    public function register() {
        $errors = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';

            // Validaciones
            if(empty($username)) {
                $errors[] = "El nombre de usuario es requerido";
            }
            if(empty($email)) {
                $errors[] = "El email es requerido";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "El email no es válido";
            }
            if(empty($password)) {
                $errors[] = "La contraseña es requerida";
            } elseif(strlen($password) < 6) {
                $errors[] = "La contraseña debe tener al menos 6 caracteres";
            }
            if($password !== $confirm_password) {
                $errors[] = "Las contraseñas no coinciden";
            }

            // Verificar si el email ya existe
            if(empty($errors)) {
                $this->user->email = $email;
                if($this->user->emailExists()) {
                    $errors[] = "Este email ya está registrado";
                }
            }

            if(empty($errors)) {
                $this->user->username = $username;
                $this->user->email = $email;
                $this->user->password = $password;

                if($this->user->register()) {
                    $_SESSION['success'] = "Registro exitoso. Por favor inicia sesión.";
                    header('Location: /index.php?action=login');
                    exit();
                } else {
                    $errors[] = "Error al registrar el usuario";
                }
            }
        }

        $_SESSION['errors'] = $errors;
        header('Location: /index.php?action=register');
        exit();
    }

    public function logout() {
        session_destroy();
        header('Location: /index.php?action=login');
        exit();
    }

    private function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}
