<?php
require_once __DIR__ . '/../config/database.php';

class Cart {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // Add an item to the cart
    public function addItem($userId, $productId) {
        // Check if already in cart
        $stmt = $this->pdo->prepare("
            SELECT cart_id, quantity
            FROM cart
            WHERE user_id = ? AND product_id = ?
        ");
        $stmt->execute([$userId, $productId]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // Increment quantity
            $stmt = $this->pdo->prepare("
                UPDATE cart
                SET quantity = quantity + 1
                WHERE cart_id = ?
            ");
            $stmt->execute([$item['cart_id']]);
        } else {
            // Insert new row
            $stmt = $this->pdo->prepare("
                INSERT INTO cart (user_id, product_id, quantity)
                VALUES (?, ?, 1)
            ");
            $stmt->execute([$userId, $productId]);
        }
    }

    // Get all items for a user
    public function getByUser($userId) {
        $stmt = $this->pdo->prepare("
            SELECT c.cart_id, p.product_id, p.product_name, p.product_image, c.quantity, p.product_price
            FROM cart c
            JOIN products p ON c.product_id = p.product_id
            WHERE c.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Remove a single item
    public function removeItem($cartId) {
        $stmt = $this->pdo->prepare("DELETE FROM cart WHERE cart_id = ?");
        $stmt->execute([$cartId]);
    }

    // Empty the entire cart (used after checkout)
    public function emptyCart($userId) {
        $stmt = $this->pdo->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->execute([$userId]);
    }
}
