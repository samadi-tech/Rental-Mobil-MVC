<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SamTech\App\Router;
use SamTech\Controller\AdminController;
use SamTech\Controller\HomeController;
use SamTech\Controller\LoginController;
// use SamTech\Controller\ProductController;
// use SamTech\Middleware\AuthMiddleware;


Router::add("GET", "/", HomeController::class, "index",);
Router::add("GET", "/transaksi/login", HomeController::class, "login",);
Router::add("GET", "/transaksi/register", HomeController::class, "register",);
Router::add("GET", "/transaksi/booking", HomeController::class, "booking",);
Router::add("GET", "/bantuan", HomeController::class, "bantuan",);
Router::add("GET", "/tentang", HomeController::class, "tentang",);


Router::add("GET", "/login", LoginController::class, "Login");

// Router::add("GET", "/product/([0-9a-zA-Z]*)/category/([0-9a-zA-Z]*)", ProductController::class, "Category");
// Router::add("GET", "/admin", AdminController::class, "index", [AuthMiddleware::class]);

Router::add("GET", "/admin", AdminController::class, "index");
Router::add("GET", "/admin/members", AdminController::class, "members");
Router::add("GET", "/admin/transaksi", AdminController::class, "transaksi");
Router::add("GET", "/admin/cars", AdminController::class, "cars");
Router::add("GET", "/admin/admin", AdminController::class, "admin");


Router::add("GET", "/error", HomeController::class, "error");


Router::run();
