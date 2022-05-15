<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Admin;
use SamTech\Exceptions\ValidationAdminException;
use SamTech\Model\Request\AdminLoginRequest;
use SamTech\Model\Request\AdminRegisterRequest;
use SamTech\Repository\AdminRepository;

class AdminServiceTest extends TestCase
{
    private AdminService $service;
    private AdminRepository $repo;

    protected function setUp(): void
    {
        $con = Database::getConection();
        $this->repo = new AdminRepository($con);
        $this->service = new AdminService($this->repo);

        $this->repo->deleteAll();
    }

    public function testRegisterSucces()
    {
        $request = new AdminRegisterRequest();
        $request->username = "samadi10";
        $request->password = "rahasia";
        $request->nama = "ADI NUGROHO";

        $response = $this->service->register($request);

        self::assertEquals($request->username, $response->admin->username);
        self::assertEquals($request->nama, $response->admin->nama);
        self::assertNotEquals($request->password, $response->admin->password);

        self::assertTrue(password_verify($request->password, $response->admin->password));
    }

    public function testRegisterFailed()
    {
        $this->expectException(ValidationAdminException::class);

        $request = new AdminRegisterRequest();
        $request->username = "";
        $request->password = "";
        $request->nama = "";

        $this->service->register($request);
    }

    public function testRegisterDuplicate()
    {
        $this->expectException(ValidationAdminException::class);

        $admin = new Admin();
        $admin->username = "samadi10";
        $admin->password = "rahasia";
        $admin->nama = "ADI NUGROHO";

        $this->repo->save($admin);


        $request = new AdminRegisterRequest();
        $request->username = "samadi10";
        $request->password = "rahasia";
        $request->nama = "ADI NUGROHO";

        $this->service->register($request);
    }

    public function testLoginFailed()
    {

        $admin = new admin();
        $admin->id = 145;
        $admin->username = "samadi";
        $admin->password = "rahasia";

        $this->expectException(ValidationAdminException::class);

        $login = new AdminLoginRequest();
        $login->username = "samadi";
        $login->password = null;

        $this->service->login($login);
    }

    public function testLoginSucces()
    {

        $admin = new admin();
        $admin->id = 145;
        $admin->username = "samadi";
        $admin->password = password_hash("rahasia", PASSWORD_BCRYPT);

        $this->expectException(ValidationAdminException::class);

        $login = new AdminLoginRequest();
        $login->username = "samadi";
        $login->password = "rahasia";

        $response = $this->service->login($login);

        self::assertEquals($admin->username, $response->admin->username);
        self::assertTrue(password_verify($login->password, $response->admin->password));
    }
}
