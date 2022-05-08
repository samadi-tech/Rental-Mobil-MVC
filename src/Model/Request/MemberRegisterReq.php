<?php

namespace SamTech\Model\Request;

class MemberRegisterReq
{
    public ?int $id = null;
    public ?string $username = null;
    public ?string $password = null;
    public ?string $nama = null;
    public ?string $ttl = null;
    public ?string $alamat = null;
    public ?string $telepon = null;
    public ?string $image = null;
}
