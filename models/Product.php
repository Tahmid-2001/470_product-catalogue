<?php
require_once __DIR__ . '/../config/database.php';

class Product {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Fetch all products
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fetch single product by ID (for detail view later)
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Admin methods for product management
    public function addProduct($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO products (product_name, product_type, description, product_specification, product_price, stock_quantity, expiration_date)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $data['product_name'],
            $data['product_type'],
            $data['description'],
            $data['product_specification'],
            $data['product_price'],
            $data['stock_quantity'],
            $data['expiration_date'] ?: null
        ]);
        return $this->pdo->lastInsertId();
    }

    public function deleteProduct($productId) {
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->rowCount() > 0;
    }
}
?>
