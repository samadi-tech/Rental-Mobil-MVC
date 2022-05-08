<?php

namespace SamTech\Repository;

use PHPUnit\Framework\TestCase;
use SamTech\Domain\Member;
use SamTech\Config\Database;

class MemberRepositoryTest extends TestCase
{
    private MemberRepository $memberRepository;

    protected function setUp(): void
    {
        $this->memberRepository = new MemberRepository(Database::getConection());
        $this->memberRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $member = new Member();
        $member->id = 44;
        $member->username = "samadi";
        $member->password = "rahasia";
        $member->nama = "";
        $member->ttl = "";
        $member->alamat = "";
        $member->telepon = "";
        $member->image = "";

        $this->memberRepository->save($member);

        $result = $this->memberRepository->findById($member->id);

        self::assertEquals($member->id, $result->id);
        self::assertEquals($member->username, $result->username);
        self::assertEquals($member->password, $result->password);
    }

    public function testFindByIdNotFound()
    {
        $member = $this->memberRepository->findById(12);

        self::assertNull($member);
    }
}
