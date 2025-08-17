<?php
require_once __DIR__ . '/../config/database.php';

class Order {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Create orders from the user's cart
    public function createFromCart($userId) {
        // Start transaction
        $this->pdo->beginTransaction();

        // Fetch cart items
        $stmt = $this->pdo->prepare("
            SELECT c.cart_id, c.product_id, c.quantity, p.product_price
            FROM cart c
            JOIN products p ON c.product_id = p.product_id
            WHERE c.user_id = ?
        ");
        $stmt->execute([$userId]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Insert into orders and decrement stock
        $insertStmt = $this->pdo->prepare("
            INSERT INTO orders
            (user_id, product_id, product_name, quantity, total_price)
            VALUES (?, ?, ?, ?, ?)
        ");
        $updateStock = $this->pdo->prepare("
            UPDATE products
            SET stock_quantity = stock_quantity - ?
            WHERE product_id = ?
        ");
        foreach ($items as $it) {
            $total = $it['product_price'] * $it['quantity'];
            // Insert order row
            $insertStmt->execute([
                $userId,
                $it['product_id'],
                $this->getProductName($it['product_id']),
                $it['quantity'],
                $total
            ]);
            // Decrement product stock
            $updateStock->execute([$it['quantity'], $it['product_id']]);
        }

        // Clear the cart
        $clearCart = $this->pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $clearCart->execute([$userId]);

        // Commit transaction
        $this->pdo->commit();
    }

    // Fetch order history for user
    public function getByUser($userId) {
        $stmt = $this->pdo->prepare("
            SELECT order_id, product_name, quantity, total_price, order_status, order_date
            FROM orders
            WHERE user_id = ?
            ORDER BY order_date DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Helper: get product name
    private function getProductName($productId) {
        $stmt = $this->pdo->prepare("SELECT product_name FROM products WHERE product_id = ?");
        $stmt->execute([$productId]);
        return $stmt->fetchColumn();
    }
}
