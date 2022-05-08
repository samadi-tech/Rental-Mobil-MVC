<?php
require_once __DIR__ . '/../vendor/autoload.php';

use SamTech\App\Router;
use SamTech\Config\Database;
use SamTech\Controller\AdminController;
use SamTech\Controller\AdministratorController;
use SamTech\Controller\HomeController;
use SamTech\Controller\LoginController;
use SamTech\Controller\MemberController;
use SamTech\Controller\MobilController;
use SamTech\Controller\TransaksiController;

// use SamTech\Controller\ProductController;
// use SamTech\Middleware\AuthMiddleware;

Database::getConection("prod");

Router::add("GET", "/", HomeController::class, "index",);
Router::add("GET", "/transaksi/login", HomeController::class, "login",);
Router::add("GET", "/bantuan", HomeController::class, "bantuan",);
Router::add("GET", "/tentang", HomeController::class, "tentang",);

Router::add("GET", "/transaksi/booking", HomeController::class, "booking",);
Router::add("POST", "/transaksi/booking", TransaksiController::class, "tambah");

Router::add("GET", "/transaksi/register", HomeController::class, "register",);
Router::add("POST", "/transaksi/register", MemberController::class, "register");

Router::add("GET", "/login", LoginController::class, "Login");

// Router::add("GET", "/product/([0-9a-zA-Z]*)/category/([0-9a-zA-Z]*)", ProductController::class, "Category");
// Router::add("GET", "/admin", AdminController::class, "index", [AuthMiddleware::class]);

Router::add("GET", "/admin", AdministratorController::class, "index");


Router::add("GET", "/admin/transaksi", TransaksiController::class, "transaksi");
Router::add("POST", "/admin/transaksi", TransaksiController::class, "tambah");


Router::add("GET", "/admin/admin", AdminController::class, "admin");
Router::add("POST", "/admin/admin", AdminController::class, "register");

Router::add("GET", "/admin/mobil", MobilController::class, "mobil");
Router::add("POST", "/admin/mobil", MobilController::class, "register");

Router::add("GET", "/admin/members", MemberController::class, "members");
Router::add("POST", "/admin/members", MemberController::class, "register");



Router::add("GET", "/error", HomeController::class, "error");


Router::run();
