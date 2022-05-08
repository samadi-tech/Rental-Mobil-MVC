<?php

namespace SamTech\Domain;

class Transaksi
{
    public int $id;
    public int $idmember;
    public int $idmobil;
    public string $tglpinjam;
    public string $tglkembali;
    public int $tarif;
}
