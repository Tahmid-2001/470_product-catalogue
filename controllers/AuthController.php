<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        // Remove session_start() from here - it's already called in index.php
    }

    public function showLogin() {
        require __DIR__ . '/../views/auth/login.php';
    }

    public function showRegister() {
        require __DIR__ . '/../views/auth/register.php';
    }

    public function register() {
        $result = $this->userModel->register($_POST);
        if ($result === 'exists') {
            $error = "Account under the same email exists.";
            require __DIR__ . '/../views/auth/register.php';
        } else {
            header('Location: index.php?action=login&registered=1');
        }
    }

    public function login() {
        $user = $this->userModel->login($_POST['email'], $_POST['password']);
        if (!$user) {
            $error = "Invalid Email or password.";
            require __DIR__ . '/../views/auth/login.php';
        } else {
            $_SESSION['user'] = $user;
            if ($user['account_type'] === 'admin') {
                header('Location: index.php?action=admin_dashboard');
            } else {
                header('Location: index.php?action=user_dashboard');
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
    }
}
?>
