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
            $data['password'],          // plain-text storage
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
}
