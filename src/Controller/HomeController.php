<?php

namespace SamTech\Controller;


use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Repository\MobilRepository;
use SamTech\Service\MobilService;

class HomeController
{
    private MobilService $mobil;
    public function __construct()
    {
        $con = Database::getConection();
        $repo = new MobilRepository($con);
        $this->mobil = new MobilService($repo);
    }

    function index()
    {
        $mobil = $this->mobil->showData();

        View::ViewHome("Home/index", [
            "title" => "Rental Mobil | SamTech",
            "mobil" => $mobil

        ]);
    }

    function login()
    {
        View::ViewHome("Home/login", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function register()
    {
        View::ViewHome("Home/register", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function booking()
    {
        View::ViewHome("Home/booking", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function tentang()
    {
        View::ViewHome("Home/tentang", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function error()
    {
        View::ViewLogin("Home/error", [
            "title" => "Page Not Found | 404"
        ]);
    }
}
