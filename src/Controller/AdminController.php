<?php

namespace SamTech\Controller;

use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationAdminException;
use SamTech\Exceptions\ValidationException;
use SamTech\Model\Request\AdminRegisterReq;
use SamTech\Model\Request\AdminRegisterRequest;
use SamTech\Repository\AdminRepository;
use SamTech\Service\AdminService;

class AdminController
{
    private AdminService $service;

    public function __construct()
    {
        $con = Database::getConection();
        $repo = new AdminRepository($con);
        $this->service = new AdminService($repo);
    }

    function admin()
    {
        $admin = $this->service->showData();

        View::ViewAdmin("Admin/admin", [
            "title" => "Adminitrator | Rental Mobil | SamTech",
            "error" => "",
            "data" => $admin

        ]);
    }


    public function register()
    {
        $request = new AdminRegisterRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->nama = $_POST['nama'];

        if (isset($_POST['tambah'])) {
            try {
                $this->service->register($request);
                View::Redirect("/admin/admin");
            } catch (ValidationAdminException $exception) {
                View::ViewAdmin("admin/admin", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()

                ]);
            }
        }
    }
}
