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
        $transaksi->idmember = 12;
        $transaksi->idmobil = 23;
        $transaksi->tglpinjam = "2022-05-09";
        $transaksi->tglkembali = "2022-05-09";
        $transaksi->tarif = 2000000;

        $this->transRepo->save($transaksi);

        $result = $this->transRepo->findById($transaksi->id);

        self::assertEquals($transaksi->id, $result->id);
        self::assertEquals($transaksi->idmember, $result->idmember);
        self::assertEquals($transaksi->idmobil, $result->idmobil);
    }
}
