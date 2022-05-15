<?php

namespace SamTech\Repository;

use PHPUnit\Framework\TestCase;
use SamTech\Domain\Member;
use SamTech\Config\Database;

class MemberRepositoryTest extends TestCase
{
    private MemberRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new MemberRepository(Database::getConection());
        $this->repository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $member = new Member();
        $member->username = "samadi";
        $member->password = "rahasia";
        $member->nama = "ADI NUGROHO";
        $member->ttl = "Kab.Semarang, 10 Juli 1998";
        $member->alamat = "Tangerang, Banten";
        $member->telepon = "085xxxxxxxxx";
        $member->image = "adie.jpg";

        $this->repository->save($member);

        $result = $this->repository->findByUsername($member->username);
        self::assertEquals($member->username, $result->username);
        self::assertEquals($member->password, $result->password);
    }

    public function testFindByIdNotFound()
    {
        $member = $this->repository->findByUsername("member");

        self::assertNull($member);
    }
}
