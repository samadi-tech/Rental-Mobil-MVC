<?php

namespace SamTech\Repository;

use PHPUnit\Framework\TestCase;
use SamTech\Domain\Admin;
use SamTech\Config\Database;

class AdminRepositoryTest extends TestCase
{
    private AdminRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new AdminRepository(Database::getConection());

        $this->repository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $admin = new Admin();
        $admin->username = "samadi10";
        $admin->password = "rahasia";
        $admin->nama = "ADI NUGROHO";

        $this->repository->save($admin);

        $result = $this->repository->findByUsername($admin->username);

        self::assertEquals($admin->username, $result->username);
        self::assertEquals($admin->password, $result->password);
    }

    public function testUsernameFailed()
    {
        $admin = $this->repository->findByUsername("samtech");

        self::assertNull($admin);
    }
}
