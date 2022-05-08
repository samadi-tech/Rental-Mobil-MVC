<?php

namespace SamTech\Service;

use SamTech\Domain\Admin;
use SamTech\Model\AdminRegisterReq;
use SamTech\Model\AdminRegisterRes;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationException;
use SamTech\Repository\AdminRepository;

class AdminService
{

    private AdminRepository $AdminRepo;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->AdminRepo = $adminRepo;
    }

    public function register(AdminRegisterReq $request): AdminRegisterRes
    {
        $this->validateRegisterReq($request);

        try {
            Database::beginTransaction();
            $admin = $this->AdminRepo->findById($request->id);

            if ($admin != null) {
                throw new ValidationException("admin udah ada");
            }

            $admin = new Admin();
            $admin->id = $request->id;
            $admin->username = $request->username;
            $admin->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->AdminRepo->save($admin);

            $response = new AdminRegisterRes();
            $response->admin = $admin;

            Database::commitTransaction();

            return $response;
        } catch (\Exception $exceptions) {
            Database::rollBackTransaction();
            throw $exceptions;
        }
    }

    public function validateRegisterReq(AdminRegisterReq $request)
    {
        if ($request->id == null || $request->username == ""  || $request->password == "") {
            throw new ValidationException("id cannot blank");
        }
    }
}
