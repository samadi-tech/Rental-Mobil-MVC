<?php

namespace SamTech\Controller;

use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationAdminException;
use SamTech\Model\Request\AdminLoginRequest;
use SamTech\Repository\AdminRepository;
use SamTech\Service\AdminService;

class LoginController
{

    private AdminService $service;

    public function __construct()
    {
        $con = Database::getConection();
        $adminRepo = new AdminRepository($con);
        $this->service = new AdminService($adminRepo);
    }

    function Login()
    {
        $data = [
            "title" => "Login Page"
        ];
        View::ViewLogin("Login/index", $data);
    }

    function postLogin()
    {
        $request = new AdminLoginRequest;
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];

        try {
            $this->service->login($request);

            View::Redirect("/admin");
        } catch (ValidationAdminException $e) {
            View::ViewLogin("Login/index", [
                "title" => "Login Gagal !"
            ]);

            throw new ValidationAdminException($e->getMessage());
        }
    }
}
