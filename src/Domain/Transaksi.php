<?php

namespace SamTech\Domain;

class Transaksi
{
    public int $id;
    public int $id_member;
    public int $id_mobil;
    public string $tgl_pinjam;
    public string $tgl_kembali;
    public int $tarif;
}
