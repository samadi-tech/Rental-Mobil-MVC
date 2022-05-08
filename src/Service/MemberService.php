<?php

namespace SamTech\Service;

use SamTech\Config\Database;
use SamTech\Domain\Member;
use SamTech\Exceptions\ValidationMember;
use SamTech\Model\MemberRegisterReq;
use SamTech\Model\MemberRegisterRes;
use SamTech\Repository\MemberRepository;

class MemberService
{

    private MemberRepository $memberRepo;

    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepo = $memberRepo;
    }

    public function register(MemberRegisterReq $request): MemberRegisterRes
    {
        $this->validateMemberRegisterReq($request);

        try {
            Database::beginTransaction();
            $member = $this->memberRepo->findById($request->id);

            if ($member != null) {
                throw new ValidationMember("admin udah ada");
            }

            $member = new Member();
            $member->id = $request->id;
            $member->username = $request->username;
            $member->password = password_hash($request->password, PASSWORD_BCRYPT);
            $member->nama = $request->nama;
            $member->ttl = $request->ttl;
            $member->alamat = $request->alamat;
            $member->telepon = $request->telepon;
            $member->image = $request->image;


            $this->memberRepo->save($member);

            $response = new MemberRegisterRes();
            $response->member = $member;

            Database::commitTransaction();

            return $response;
        } catch (\Exception $exceptions) {
            Database::rollBackTransaction();
            throw $exceptions;
        }
    }

    public function validateMemberRegisterReq(MemberRegisterReq $request)
    {
        if ($request->id == null || $request->username == ""  || $request->password == "") {
            throw new ValidationMember("id cannot blank");
        }
    }
}
