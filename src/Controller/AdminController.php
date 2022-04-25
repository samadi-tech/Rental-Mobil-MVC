<?php

namespace SamTech\Controller;

use SamTech\App\View;

class AdminController
{
    function index()
    {
        View::ViewAdmin("Admin/index", [
            "title" => "Adminitrator | Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function members()
    {
        View::ViewAdmin("Admin/members", [
            "title" => "Adminitrator | Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function transaksi()
    {
        View::ViewAdmin("Admin/transaksi", [
            "title" => "Adminitrator | Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function cars()
    {
        View::ViewAdmin("Admin/cars", [
            "title" => "Adminitrator | Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function admin()
    {
        View::ViewAdmin("Admin/admin", [
            "title" => "Adminitrator | Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }
}
