<?php

namespace SamTech\Service;

use SamTech\Config\Database;
use SamTech\Domain\Member;
use SamTech\Exceptions\ValidationMember;
use SamTech\Model\Request\AdminLoginRequest;
use SamTech\Model\Request\MemberLoginRequest;
use SamTech\Model\Request\MemberRegisterReq;
use SamTech\Model\Request\MemberRegisterRequest;
use SamTech\Model\Response\AdminLoginResponse;
use SamTech\Model\Response\MemberLoginResponse;
use SamTech\Model\Response\MemberRegisterRes;
use SamTech\Model\Response\MemberRegisterResponse;
use SamTech\Repository\MemberRepository;

class MemberService
{

    private MemberRepository $repo;

    public function __construct(MemberRepository $memberRepo)
    {
        $this->repo = $memberRepo;
    }

    public function register(MemberRegisterRequest $request): MemberRegisterResponse
    {
        $this->validateMemberRegister($request);

        try {
            Database::beginTransaction();
            $member = $this->repo->findByUsername($request->username);

            if ($member != null) {
                throw new ValidationMember("Member is not empty !");
            }

            $member = new Member();
            $member->username = $request->username;
            $member->password = password_hash($request->password, PASSWORD_BCRYPT);
            $member->nama = $request->nama;
            $member->ttl = $request->ttl;
            $member->alamat = $request->alamat;
            $member->telepon = $request->telepon;
            $member->image = $request->image;


            $this->repo->save($member);

            $response = new MemberRegisterResponse();
            $response->member = $member;

            Database::commitTransaction();

            return $response;
        } catch (ValidationMember $exceptions) {
            Database::rollBackTransaction();
            throw new ValidationMember("Member is wrong !");
        }
    }

    private function validateMemberRegister(MemberRegisterRequest $request)
    {
        if ($request->username == null || $request->username == "" || $request->password == "" || trim($request->username) == "" || trim($request->password) == "" || $request->nama == null || $request->nama == "" || trim($request->nama) == "") {
            throw new ValidationMember("Username, Password, Nama can't blank !");
        }
    }

    public function showData(): ?array
    {
        $members = $this->repo->findAll();

        return $members;
    }

    public function login(MemberLoginRequest $request): MemberLoginResponse
    {
        $this->validateMemberLogin($request);

        try {
            $member = $this->repo->findByUsername($request->username);

            if ($member == null) {
                throw new ValidationMember("ID, Password is Wrong !");
            }

            if (password_verify($request->password, $member->password)) {
                $response = new MemberLoginResponse;
                $response->member = $member;

                return $response;
            } else {
                throw new ValidationMember("ID, Password is Wrong !");
            }
        } catch (ValidationMember $e) {
            throw new ValidationMember("ID, Password is Wrong !");
        }
    }

    private function validateMemberLogin(MemberLoginRequest $request)
    {
        if ($request->username == null || $request->username == "" || $request->password == "" || trim($request->username) == "" || trim($request->password) == "") {
            throw new ValidationMember("Username, Password, Nama can't blank !");
        }
    }
}
