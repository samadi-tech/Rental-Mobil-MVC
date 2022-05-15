<?php

namespace SamTech\Repository;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Mobil;

class MobilRepositoryTest extends TestCase
{
    private MobilRepository $repository;

    protected function setUp(): void
    {
        $this->repository = new MobilRepository(Database::getConection());
        $this->repository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $mobil = new Mobil();
        $mobil->id = "AV01";
        $mobil->nama = "Avanza";
        $mobil->merek = "HONDA";
        $mobil->bbm = "30 L";
        $mobil->tahun = "2017";
        $mobil->kapasitas = "8 Orang";
        $mobil->keterangan = "Mobil masih layak digunakan.";
        $mobil->biaya = 400000;
        $mobil->image = "avanza.jpeg";

        $this->repository->save($mobil);

        $result = $this->repository->findById($mobil->id);

        self::assertEquals($mobil->nama, $result->nama);
        self::assertEquals($mobil->merek, $result->merek);
    }

    public function testFindByIdNotFound()
    {
        $mobil = $this->repository->findById("AZ10");

        self::assertNull($mobil);
    }
}
