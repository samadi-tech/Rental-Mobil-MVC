<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Member;
use SamTech\Exceptions\ValidationMember;
use SamTech\Model\Request\MemberLoginRequest;
use SamTech\Model\Request\MemberRegisterRequest;
use SamTech\Repository\MemberRepository;

class MemberServiceTest extends TestCase
{
    private MemberService $service;
    private MemberRepository $repo;

    protected function setUp(): void
    {
        $con = Database::getConection();
        $this->repo = new MemberRepository($con);
        $this->service = new MemberService($this->repo);

        $this->repo->deleteAll();
    }

    public function testRegisterSucces()
    {
        $request = new MemberRegisterRequest();
        $request->username = "samadi";
        $request->password = "rahasia";
        $request->nama = "ADI NUGROHO";
        $request->ttl = "Kab.Semarang, 10 Juli 1998";
        $request->alamat = "Tangerang, Banten";
        $request->telepon = "085xxxxxxxxx";
        $request->image = "adie.jpg";



        $response = $this->service->register($request);

        self::assertEquals($request->username, $response->member->username);
        self::assertNotEquals($request->password, $response->member->password);

        self::assertTrue(password_verify($request->password, $response->member->password));
    }

    public function testRegisterFailed()
    {
        $this->expectException(ValidationMember::class);

        $request = new MemberRegisterRequest();
        $request->username = "";
        $request->password = "";

        $this->service->register($request);
    }

    public function testRegisterDuplicate()
    {
        $member = new Member();
        $member->username = "samadi";
        $member->password = "rahasia";
        $member->nama = "ADI NUGROHO";
        $member->ttl = "Kab.Semarang, 10 Juli 1998";
        $member->alamat = "Tangerang, Banten";
        $member->telepon = "085xxxxxxxxx";
        $member->image = "adie.jpg";

        $this->repo->save($member);
        $this->expectException(ValidationMember::class);


        $request = new MemberRegisterRequest();
        $request->username = "samadi";
        $request->password = "rahasia";
        $request->nama = "ADI NUGROHO";
        $request->ttl = "Kab.Semarang, 10 Juli 1998";
        $request->alamat = "Tangerang, Banten";
        $request->telepon = "085xxxxxxxxx";
        $request->image = "adie.jpg";


        $this->service->register($request);
    }

    public function testLoginFailed()
    {
        $member = new Member();
        $member->id = 145;
        $member->username = "samadi";
        $member->password = "rahasia";

        $this->expectException(ValidationMember::class);

        $login = new MemberLoginRequest();
        $login->username = "samadi";
        $login->password = null;

        $this->service->login($login);
    }

    public function testLoginSucces()
    {

        $member = new Member();
        $member->id = 145;
        $member->username = "samadi";
        $member->password = password_hash("rahasia", PASSWORD_BCRYPT);

        $this->expectException(ValidationMember::class);

        $login = new MemberLoginRequest();
        $login->username = "samadi";
        $login->password = "rahasia";

        $response = $this->service->login($login);

        self::assertEquals($member->username, $response->member->username);
        self::assertTrue(password_verify($login->password, $response->member->password));
    }
}
