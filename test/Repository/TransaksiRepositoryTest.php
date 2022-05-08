<?php

namespace SamTech\Repository;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Transaksi;

class TransaksiRepositoryTest extends TestCase
{

    private TransaksiRepository $transRepo;

    protected function setUp(): void
    {
        $this->transRepo = new TransaksiRepository(Database::getConection());

        $this->transRepo->deleteAll();
    }

    public function testSaveSuccess()
    {
        $transaksi = new Transaksi();
        $transaksi->id = 44;
        $transaksi->id_member = 34;
        $transaksi->id_mobil = 34;
        $transaksi->tgl_pinjam = "2022-05-09";
        $transaksi->tgl_kembali = "2022-05-09";
        $transaksi->tarif = 0;

        $this->transRepo->save($transaksi);

        $result = $this->transRepo->findById($transaksi->id);

        self::assertEquals($transaksi->id, $result->id);
        self::assertEquals($transaksi->id_member, $result->id_member);
        self::assertEquals($transaksi->id_mobil, $result->id_mobil);
    }
}
