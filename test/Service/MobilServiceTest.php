<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationMobil;
use SamTech\Model\MobilRegisterReq;
use SamTech\Repository\MobilRepository;

class MobilServiceTest extends TestCase
{
    private MobilService $mobileService;
    private MobilRepository $mobilRepo;


    protected function setUp(): void
    {
        $mobilRepo = $this->mobilRepo = new MobilRepository(Database::getConection());
        $this->mobileService = new MobilService($mobilRepo);

        $this->mobilRepo->deleteAll();
    }

    public function testRegisterSucces()
    {
        $request = new MobilRegisterReq();
        $request->id = 7;
        $request->nama = "samadi";
        $request->merek = "rahasia";
        $request->dimensi = "";
        $request->bbm = "";
        $request->mesin = "";
        $request->tahun = "";
        $request->tarif = 0;
        $request->image = "";

        $response = $this->mobileService->register($request);

        self::assertEquals($request->id, $response->mobil->id);
        self::assertEquals($request->nama, $response->mobil->nama);
        self::assertEquals($request->merek, $response->mobil->merek);
    }

    public function testRegisterFailed()
    {
        $this->expectException(ValidationMobil::class);

        $request = new MobilRegisterReq();
        $request->id = null;
        $request->nama = "";

        $this->mobileService->register($request);
    }
}
