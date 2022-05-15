<?php

namespace SamTech\Repository;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Bantuan;

class BantuanRepositoryTest extends TestCase
{
    private BantuanRepository $BantuanRepository;


    protected function setUp(): void
    {
        $this->BantuanRepository = new BantuanRepository(Database::getConection());
        $this->BantuanRepository->deleteAll();
    }

    public function testSaveSucces()
    {
        $bantuan = new Bantuan();
        $bantuan->nama = "PENGIRIM";
        $bantuan->subject = "SUBJECT";
        $bantuan->pesan = "ISI PESAN";

        $this->BantuanRepository->save($bantuan);
        $this->BantuanRepository->findAll();
    }
}
