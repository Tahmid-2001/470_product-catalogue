<?php
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/UserController.php';

$action = $_GET['action'] ?? 'login';
$auth = new AuthController();

switch ($action) {
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

    case 'admin_dashboard':
        // placeholder: require admin dashboard view
        echo "Admin Dashboard – under construction.";
        break;
    case 'product_detail':
        (new UserController())->productDetail();
        break;

    // UserController routes (after product_detail):
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


    default:
        header('HTTP/1.0 404 Not Found');
        echo "Page not found.";
        break;
}
