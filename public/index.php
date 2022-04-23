<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SamtechSkripsi\App\Router;
use SamtechSkripsi\Controller\AdminController;
use SamtechSkripsi\Controller\HomeController;
use SamtechSkripsi\Controller\LoginController;
// use SamtechSkripsi\Controller\ProductController;
use SamtechSkripsi\Middleware\AuthMiddleware;


Router::add("GET", "/", HomeController::class, "index",);
Router::add("GET", "/login", LoginController::class, "Login",);
Router::add("GET", "/register", LoginController::class, "Register");

// Router::add("GET", "/product/([0-9a-zA-Z]*)/category/([0-9a-zA-Z]*)", ProductController::class, "Category");

Router::add("GET", "/admin", AdminController::class, "index", [AuthMiddleware::class]);


Router::run();
