<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Order.php';

class AdminController {
    private $userModel;
    private $productModel;
    private $orderModel;

    public function __construct() {
        if (empty($_SESSION['user']) || $_SESSION['user']['account_type'] !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }
        $this->userModel = new User();
        $this->productModel = new Product();
        $this->orderModel = new Order();
    }

    // Show Admin Dashboard
    public function showDashboard() {
        require __DIR__ . '/../views/admin/dashboard.php';
    }

    // User Account Control
    public function manageUsers() {
        $users = $this->userModel->getAllUsers();
        require __DIR__ . '/../views/admin/manage_users.php';
    }

    public function editUser() {
        $userId = $_GET['user_id'] ?? null;
        if (!$userId) {
            header('Location: index.php?action=admin_manage_users');
            exit;
        }
        $user = $this->userModel->getUserById($userId);
        if (!$user) {
            header('Location: index.php?action=admin_manage_users');
            exit;
        }
        require __DIR__ . '/../views/admin/edit_user.php';
    }

    public function updateUser() {
        $userId = $_POST['user_id'] ?? null;
        if ($userId) {
            $this->userModel->updateUser($userId, $_POST);
            $_SESSION['message'] = "User updated successfully.";
        }
        header('Location: index.php?action=admin_manage_users');
        exit;
    }

    public function deleteUser() {
        $userId = $_GET['user_id'] ?? null;
        if ($userId) {
            $this->userModel->deleteUser($userId);
            $_SESSION['message'] = "User deleted successfully.";
        }
        header('Location: index.php?action=admin_manage_users');
        exit;
    }

    // Order Status Management
    public function manageOrders() {
        $orders = $this->orderModel->getAllOrders();
        require __DIR__ . '/../views/admin/manage_orders.php';
    }

    public function updateOrderStatus() {
        $orderId = $_POST['order_id'] ?? null;
        $status = $_POST['status'] ?? null;
        if ($orderId && $status) {
            $this->orderModel->updateOrderStatus($orderId, $status);
            $_SESSION['message'] = "Order status updated successfully.";
        }
        header('Location: index.php?action=admin_manage_orders');
        exit;
    }

    // Product Management
    public function manageProducts() {
        require __DIR__ . '/../views/admin/manage_products.php';
    }

    public function addProduct() {
        $result = $this->productModel->addProduct($_POST);
        if ($result) {
            $_SESSION['message'] = "Product added successfully.";
        }
        header('Location: index.php?action=admin_manage_products');
        exit;
    }

    public function removeProduct() {
        $productId = $_POST['product_id'] ?? null;
        if ($productId) {
            $result = $this->productModel->deleteProduct($productId);
            if ($result) {
                $_SESSION['message'] = "Product removed successfully.";
            } else {
                $_SESSION['message'] = "Product not found.";
            }
        }
        header('Location: index.php?action=admin_manage_products');
        exit;
    }

    // View Products List
    public function viewProducts() {
        $products = $this->productModel->getAll();
        require __DIR__ . '/../views/admin/view_products.php';
    }
}
?>
