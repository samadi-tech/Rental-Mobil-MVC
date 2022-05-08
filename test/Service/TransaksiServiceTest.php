<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Transaksi;
use SamTech\Exceptions\ValidationTransaksi;
use SamTech\Model\TransaksiAddReq;
use SamTech\Repository\TransaksiRepository;

class TransaksiServiceTest extends TestCase
{
    private TransaksiService $transService;
    private TransaksiRepository $transRepo;

    protected function setUp(): void
    {
        $con = Database::getConection();
        $this->transRepo = new TransaksiRepository($con);
        $this->transService = new TransaksiService($this->transRepo);

        $this->transRepo->deleteAll();
    }

    public function testAddSuccess()
    {
        $request = new TransaksiAddReq();
        $request->id = 7;
        $request->id_member = 7;
        $request->id_mobil = 7;
        $request->tgl_pinjam = "2022-05-09";
        $request->tgl_kembali = "2022-05-09";
        $request->tarif = 0;


        $response = $this->transService->add($request);

        self::assertEquals($request->id, $response->transaksi->id);
        self::assertEquals($request->id_member, $response->transaksi->id_member);
        self::assertEquals($request->id_mobil, $response->transaksi->id_mobil);
    }

    public function testAddFailed()
    {
        $this->expectException(ValidationTransaksi::class);


        $request = new TransaksiAddReq();
        $request->id = null;
        $request->id_member = null;
        $request->id_mobil = null;
        $request->tgl_pinjam = "2022-05-09";
        $request->tgl_kembali = "2022-05-09";
        $request->tarif = 0;


        $response = $this->transService->add($request);
    }
}
