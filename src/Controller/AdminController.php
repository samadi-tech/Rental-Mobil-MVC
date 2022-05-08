<?php

namespace SamTech\Controller;

use PDOStatement;
use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationException;
use SamTech\Model\AdminRegisterReq;
use SamTech\Repository\AdminRepository;
use SamTech\Service\AdminService;

class AdminController
{
    private AdminService $adminService;

    public function __construct()
    {
        $con = Database::getConection();
        $adminRepo = new AdminRepository($con);
        $this->adminService = new AdminService($adminRepo);
    }

    function admin()
    {
        View::ViewAdmin("Admin/admin", [
            "title" => "Adminitrator | Rental Mobil | SamTech",
            "error" => ""

        ]);
    }


    public function postAdmin()
    {
        $request = new AdminRegisterReq();
        $request->id = $_POST['id'];
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        if (isset($_POST['tambah'])) {
            try {
                $this->adminService->register($request);
                View::redirect("/admin/admin");
            } catch (ValidationException $exception) {
                View::ViewAdmin("Admin/admin", [
                    "title" => "Adminitrator | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()

                ]);
            }
        }
    }
}
