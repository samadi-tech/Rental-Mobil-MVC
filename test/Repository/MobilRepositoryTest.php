<?php

namespace SamTech\Repository;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Mobil;

class MobilRepositoryTest extends TestCase
{
    private MobilRepository $mobilRepository;

    protected function setUp(): void
    {
        $this->mobilRepository = new MobilRepository(Database::getConection());
        $this->mobilRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $mobil = new Mobil();
        $mobil->id = 44;
        $mobil->nama = "Avanza";
        $mobil->dimensi = "30";
        $mobil->bbm = "";
        $mobil->merek = "";
        $mobil->mesin = "";
        $mobil->tahun = "";
        $mobil->biaya = 0;
        $mobil->image = "";

        $this->mobilRepository->save($mobil);

        $result = $this->mobilRepository->findById($mobil->id);

        self::assertEquals($mobil->id, $result->id);
        self::assertEquals($mobil->nama, $result->nama);
        self::assertEquals($mobil->merek, $result->merek);
    }

    public function testFindByIdNotFound()
    {
        $mobil = $this->mobilRepository->findById(12);

        self::assertNull($mobil);
    }
}
