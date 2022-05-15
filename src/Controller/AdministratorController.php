<?php

namespace SamTech\Controller;

use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Repository\BantuanRepository;
use SamTech\Service\BantuanService;

class AdministratorController
{

    function index()
    {
        View::ViewAdmin("Admin/index", [
            "title" => "Adminitrator | Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }
}
