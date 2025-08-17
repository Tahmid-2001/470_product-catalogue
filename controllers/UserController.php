<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Cart.php';
require_once __DIR__ . '/../models/Order.php';

class UserController {
    private $productModel;
    private $cartModel;
    private $orderModel;

    public function __construct() {
        if (empty($_SESSION['user']) || $_SESSION['user']['account_type'] !== 'user') {
            header('Location: index.php?action=login');
            exit;
        }
        $this->productModel = new Product();
        $this->cartModel    = new Cart();
        $this->orderModel   = new Order();
    }

    // Show the User Dashboard with buttons
    public function showDashboard() {
        require __DIR__ . '/../views/user/dashboard.php';
    }

    // List all products (for search/filter)
    public function listProducts() {
        $products = $this->productModel->getAll();
        require __DIR__ . '/../views/user/products.php';
    }

    // Show detailed view of a single product, with Order button
    public function productDetail() {
        $productId = $_GET['id'] ?? null;
        if (!$productId) {
            header('Location: index.php?action=list_products');
            exit;
        }
        $product = $this->productModel->getById($productId);
        if (!$product) {
            header('Location: index.php?action=list_products');
            exit;
        }
        require __DIR__ . '/../views/user/product_detail.php';
    }

    // Add a product to the cart
    public function addToCart() {
        $userId    = $_SESSION['user']['user_id'];
        $productId = $_GET['product_id'] ?? null;
        if ($productId) {
            $this->cartModel->addItem($userId, $productId);
            $_SESSION['message'] = "Added to cart";
        }
        header('Location: index.php?action=view_cart');
        exit;
    }

    // View cart contents
    public function viewCart() {
        $userId = $_SESSION['user']['user_id'];
        $items  = $this->cartModel->getByUser($userId);
        require __DIR__ . '/../views/user/cart.php';
    }

    // Remove a single item from the cart
    public function removeFromCart() {
        $cartId = $_GET['cart_id'] ?? null;
        if ($cartId) {
            $this->cartModel->removeItem($cartId);
        }
        header('Location: index.php?action=view_cart');
        exit;
    }

    // Proceed to checkout
    public function checkout() {
        $userId = $_SESSION['user']['user_id'];
        $this->orderModel->createFromCart($userId);
        $_SESSION['message'] = "Order placed successfully.";
        header('Location: index.php?action=order_status');
        exit;
    }

    // Show order status list
    public function orderStatus() {
        $userId = $_SESSION['user']['user_id'];
        $orders = $this->orderModel->getByUser($userId);
        require __DIR__ . '/../views/user/status.php';
    }
}
