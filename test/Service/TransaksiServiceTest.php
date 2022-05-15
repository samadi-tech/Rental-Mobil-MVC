<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Transaksi;
use SamTech\Exceptions\ValidationTransaksi;
use SamTech\Model\Request\TransaksiAddReq as RequestTransaksiAddReq;
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

        // $this->transRepo->deleteAll();
    }

    public function testAddSuccess()
    {
        $request = new RequestTransaksiAddReq();
        $request->id = "7";
        $request->idmember = "7";
        $request->idmobil = "7";
        $request->tglpinjam = "2022-05-09";
        $request->tglkembali = "2022-05-09";
        $request->tarif = 0;


        $response = $this->transService->add($request);

        self::assertEquals($request->id, $response->transaksi->id);
        self::assertEquals($request->idmember, $response->transaksi->idmember);
        self::assertEquals($request->idmobil, $response->transaksi->idmobil);
    }

    public function testAddFailed()
    {
        $this->expectException(ValidationTransaksi::class);


        $request = new RequestTransaksiAddReq();
        $request->id = null;
        $request->idmember = null;
        $request->idmobil = null;
        $request->tglpinjam = "2022-05-09";
        $request->tglkembali = "2022-05-09";
        $request->tarif = 0;


        $response = $this->transService->add($request);
    }
}
