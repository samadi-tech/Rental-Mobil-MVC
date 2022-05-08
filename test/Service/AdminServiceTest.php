<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Model\Request\AdminRegisterReq;
use SamTech\Config\Database;
use SamTech\Domain\Admin;
use SamTech\Exceptions\ValidationException;
use SamTech\Repository\AdminRepository;

class AdminServiceTest extends TestCase
{
    private AdminService $adminService;
    private AdminRepository $adminRepo;

    protected function setUp(): void
    {
        $con = Database::getConection();
        $this->adminRepo = new AdminRepository($con);
        $this->adminService = new AdminService($this->adminRepo);

        $this->adminRepo->deleteAll();
    }

    public function testRegisterSucces()
    {
        $request = new AdminRegisterReq();
        $request->id = 1;
        $request->username = "samadi";
        $request->password = "rahasia";

        $response = $this->adminService->register($request);

        self::assertEquals($request->id, $response->admin->id);
        self::assertEquals($request->username, $response->admin->username);
        self::assertNotEquals($request->password, $response->admin->password);

        self::assertTrue(password_verify($request->password, $response->admin->password));
    }

    public function testRegisterFailed()
    {
        $this->expectException(ValidationException::class);

        $request = new AdminRegisterReq();
        $request->id = 23;
        $request->username = "";
        $request->password = "";

        $this->adminService->register($request);
    }

    public function testRegisterDuplicate()
    {
        $admin = new Admin();
        $admin->id = 23;
        $admin->username = "samadi";
        $admin->password = "rahasia";

        $this->adminRepo->save($admin);
        $this->expectException(ValidationException::class);


        $request = new AdminRegisterReq();
        $request->id = 23;
        $request->username = "samadi";
        $request->password = "rahasia";

        $this->adminService->register($request);
    }
}
