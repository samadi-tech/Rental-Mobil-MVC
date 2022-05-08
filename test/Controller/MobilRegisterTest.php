<?php

namespace SamTech\Controller;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Repository\MobilRepository;

class MobilRegisterTest extends TestCase
{
    private MobilController $mobilController;

    protected function setUp(): void
    {
        $this->mobilController = new MobilController();

        $mobilRepo = new MobilRepository(Database::getConection());
        $mobilRepo->deleteAll();
    }

    public function testMobilRegister()
    {
        $this->mobilController->register();

        $this->expectOutputRegex("[nama]");
    }

    public function testPostRegisterError()
    {
    }
    public function testPostRegisterDuplicate()
    {
    }
}
