<?php

namespace SamTech\Model;

class TransaksiAddReq
{
    public ?int $id = null;
    public ?int $id_member = null;
    public ?int $id_mobil = null;
    public ?string $tgl_pinjam = null;
    public ?string $tgl_kembali = null;
    public ?int $tarif = null;
}
