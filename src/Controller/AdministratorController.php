<?php

namespace SamTech\Controller;

use SamTech\App\View;

class AdministratorController
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
}
