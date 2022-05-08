<?php

namespace SamTech\Repository;

use PHPUnit\Framework\TestCase;
use SamTech\Domain\Admin;
use SamTech\Config\Database;

class AdminRepositoryTest extends TestCase
{
    private AdminRepository $adminRepository;

    protected function setUp(): void
    {
        $this->adminRepository = new AdminRepository(Database::getConection());
        $this->adminRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $admin = new Admin();
        $admin->id = 44;
        $admin->username = "samadi";
        $admin->password = "rahasia";

        $this->adminRepository->save($admin);

        $result = $this->adminRepository->findById($admin->id);

        self::assertEquals($admin->id, $result->id);
        self::assertEquals($admin->username, $result->username);
        self::assertEquals($admin->password, $result->password);
    }

    public function testFindByIdNotFound()
    {
        $admin = $this->adminRepository->findById("122");

        self::assertNull($admin);
    }
}
