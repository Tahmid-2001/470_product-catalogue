<?php
session_start();

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/AdminController.php';

$action = $_GET['action'] ?? 'login';
$auth = new AuthController();

switch ($action) {
    // Authentication
    case 'login':
        $auth->showLogin();
        break;
    case 'login_post':
        $auth->login();
        break;
    case 'register':
        $auth->showRegister();
        break;
    case 'register_post':
        $auth->register();
        break;
    case 'logout':
        $auth->logout();
        break;

    // User Dashboard & Products
    case 'user_dashboard':
        (new UserController())->showDashboard();
        break;
    case 'list_products':
        (new UserController())->listProducts();
        break;
    case 'product_detail':
        (new UserController())->productDetail();
        break;

    // UserController routes
    case 'add_to_cart':
        (new UserController())->addToCart();
        break;
    case 'view_cart':
        (new UserController())->viewCart();
        break;
    case 'remove_from_cart':
        (new UserController())->removeFromCart();
        break;
    case 'checkout':
        (new UserController())->checkout();
        break;
    case 'order_status':
        (new UserController())->orderStatus();
        break;

    // Admin Dashboard
    case 'admin_dashboard':
        (new AdminController())->showDashboard();
        break;

    // Admin User Management
    case 'admin_manage_users':
        (new AdminController())->manageUsers();
        break;
    case 'admin_edit_user':
        (new AdminController())->editUser();
        break;
    case 'admin_update_user':
        (new AdminController())->updateUser();
        break;
    case 'admin_delete_user':
        (new AdminController())->deleteUser();
        break;

    // Admin Order Management
    case 'admin_manage_orders':
        (new AdminController())->manageOrders();
        break;
    case 'admin_update_order_status':
        (new AdminController())->updateOrderStatus();
        break;

    // Admin Product Management
    case 'admin_manage_products':
        (new AdminController())->manageProducts();
        break;
    case 'admin_add_product':
        (new AdminController())->addProduct();
        break;
    case 'admin_remove_product':
        (new AdminController())->removeProduct();
        break;

    // Admin View Products
    case 'admin_view_products':
        (new AdminController())->viewProducts();
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        echo "Page not found.";
        break;
}
?>
