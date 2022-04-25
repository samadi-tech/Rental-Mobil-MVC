<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SamtechSkripsi\App\Router;
use SamtechSkripsi\Controller\AdminController;
use SamtechSkripsi\Controller\HomeController;
use SamtechSkripsi\Controller\LoginController;
// use SamtechSkripsi\Controller\ProductController;
// use SamtechSkripsi\Middleware\AuthMiddleware;


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
