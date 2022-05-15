<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Model\Request\BantuanKirimRequest;
use SamTech\Repository\BantuanRepository;
use SamTech\Domain\Bantuan;
use SamTech\Model\Response\BantuanKirimResponse;

class BantuanServiceTest extends TestCase
{
    private BantuanService $service;
    private BantuanRepository $repo;

    protected function setUp(): void
    {
        $con = Database::getConection();
        $this->repo = new BantuanRepository($con);
        $this->service = new BantuanService($this->repo);

        $this->repo->deleteAll();
    }

    public function testPesanSucces()
    {
        $pesan = new BantuanKirimRequest;
        $pesan->nama = "PENGIRIM";
        $pesan->subject = "JUDUL PESAN";
        $pesan->pesan = "ISI PESAN";

        $this->service->kirim($pesan);
        $response = new BantuanKirimResponse;
        $response->bantuan = $pesan;


        self::assertEquals($pesan->nama, $response->bantuan->nama);
        self::assertEquals($pesan->subject, $response->bantuan->subject);
    }

    public function testFindAll()
    {
        $pesan = new BantuanKirimRequest;
        $pesan->nama = "ADI";
        $pesan->subject = "JUDUL PESAN";
        $pesan->pesan = "ISI PESAN";

        $this->service->kirim($pesan);
    }
}
