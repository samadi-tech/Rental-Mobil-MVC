<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Member;
use SamTech\Exceptions\ValidationMember;
use SamTech\Model\MemberRegisterReq;
use SamTech\Repository\MemberRepository;

class MemberServiceTest extends TestCase
{
    private MemberService $memberService;
    private MemberRepository $memberRepo;

    protected function setUp(): void
    {
        $con = Database::getConection();
        $this->memberRepo = new MemberRepository($con);
        $this->memberService = new MemberService($this->memberRepo);

        $this->memberRepo->deleteAll();
    }

    public function testRegisterSucces()
    {
        $request = new MemberRegisterReq();
        $request->id = 7;
        $request->username = "samadi";
        $request->password = "rahasia";
        $request->nama = "";
        $request->ttl = "";
        $request->alamat = "";
        $request->telepon = "";
        $request->image = "";


        $response = $this->memberService->register($request);

        self::assertEquals($request->id, $response->member->id);
        self::assertEquals($request->username, $response->member->username);
        self::assertNotEquals($request->password, $response->member->password);

        self::assertTrue(password_verify($request->password, $response->member->password));
    }

    public function testRegisterFailed()
    {
        $this->expectException(ValidationMember::class);

        $request = new MemberRegisterReq();
        $request->username = "";
        $request->password = "";

        $this->memberService->register($request);
    }

    public function testRegisterDuplicate()
    {
        $member = new Member();
        $member->id = 23;
        $member->username = "samadi";
        $member->password = "rahasia";
        $member->nama = "rahasia";
        $member->ttl = "rahasia";
        $member->alamat = "rahasia";
        $member->telepon = "rahasia";
        $member->image = "rahasia";

        $this->memberRepo->save($member);
        $this->expectException(ValidationMember::class);


        $request = new MemberRegisterReq();
        $request->id = 23;
        $request->username = "samadi";
        $request->password = "rahasia";
        $request->nama = "";
        $request->ttl = "";
        $request->alamat = "";
        $request->telepon = "";
        $request->image = "";

        $response = $this->memberService->register($request);
    }
}
