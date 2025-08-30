<?php
require_once __DIR__ . '/../config/database.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function register($data) {
        // Check for existing email
        $stmt = $this->pdo->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->execute([$data['email']]);
        if ($stmt->fetch()) {
            return 'exists';
        }

        // Insert new user without password hashing
        $stmt = $this->pdo->prepare("
            INSERT INTO users (full_name, email, password, contact_number, age, account_type)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['full_name'],
            $data['email'],
            $data['password'], // plain-text storage
            $data['contact_number'],
            $data['age'],
            $data['account_type']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Direct comparison against stored plain-text password
        if (!$user || $user['password'] !== $password) {
            return false;
        }
        
        return $user;
    }

    // Admin methods for user management
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users WHERE account_type = 'user' ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE users 
            SET full_name = ?, email = ?, password = ?, contact_number = ?, age = ?
            WHERE user_id = ?
        ");
        $stmt->execute([
            $data['full_name'],
            $data['email'],
            $data['password'],
            $data['contact_number'],
            $data['age'],
            $userId
        ]);
    }

    public function deleteUser($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE user_id = ? AND account_type = 'user'");
        $stmt->execute([$userId]);
    }
}
?>
