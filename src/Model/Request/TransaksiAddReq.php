<?php

namespace SamTech\Model\Request;

class TransaksiAddReq
{
    public ?int $id = null;
    public ?int $idmember = null;
    public ?int $idmobil = null;
    public ?string $tglpinjam = null;
    public ?string $tglkembali = null;
    public ?int $tarif = null;
}
