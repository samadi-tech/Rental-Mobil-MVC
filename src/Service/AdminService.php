<?php

namespace SamTech\Service;

use SamTech\Domain\Admin;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationAdminException;
use SamTech\Model\Request\AdminLoginRequest;
use SamTech\Model\Request\AdminRegisterRequest;
use SamTech\Model\Response\AdminLoginResponse;
use SamTech\Model\Response\AdminRegisterResponse;
use SamTech\Repository\AdminRepository;

class AdminService
{

    private AdminRepository $repo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->repo = $adminRepo;
    }

    public function register(AdminRegisterRequest $request): AdminRegisterResponse
    {
        $this->validationAdminRegister($request);

        try {
            Database::beginTransaction();

            $admin = $this->repo->findByUsername($request->username);

            if ($admin != null) {
                throw new ValidationAdminException("Admin is Wrong!");
            }

            $admin = new Admin();
            $admin->username = $request->username;
            $admin->password = password_hash($request->password, PASSWORD_BCRYPT);
            $admin->nama = $request->nama;


            $this->repo->save($admin);

            $response = new AdminRegisterResponse();
            $response->admin = $admin;

            Database::commitTransaction();

            return $response;
        } catch (\Exception $exceptions) {
            Database::rollBackTransaction();
            throw $exceptions;
        }
    }

    private function validationAdminRegister(AdminRegisterRequest $request)
    {
        if ($request->username == null || $request->username == "" || $request->password == "" || trim($request->username) == "" || trim($request->password) == "" || $request->nama == null || $request->nama == "" || trim($request->nama) == "") {
            throw new ValidationAdminException("Username, Password, Nama can't NULL !");
        }
    }

    public function showData(): ?array
    {
        $admin = $this->repo->findAll();

        return $admin;
    }

    public function login(AdminLoginRequest $request): AdminLoginResponse
    {
        $this->validationAdminLogin($request);

        try {
            $Admin = $this->repo->findByUsername($request->username);

            if ($Admin == null) {
                throw new ValidationAdminException("ID, Password is Wrong !");
            }

            if (password_verify($request->password, $Admin->password)) {
                $response = new AdminLoginResponse;
                $response->admin = $Admin;

                return $response;
            } else {
                throw new ValidationAdminException("ID, Password is Wrong !");
            }
        } catch (ValidationAdminException $e) {
            throw new ValidationAdminException("ID, Password is Wrong !");
        }
    }

    private function validationAdminLogin(AdminLoginRequest $request)
    {
        if ($request->username == null || $request->username == "" || $request->password == "" || trim($request->username) == "" || trim($request->password) == "") {
            throw new ValidationAdminException("Username, Password, Nama can't NULL !");
        }
    }
}
