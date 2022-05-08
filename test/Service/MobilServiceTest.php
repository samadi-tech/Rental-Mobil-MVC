<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Mobil;
use SamTech\Exceptions\ValidationMobil;
use SamTech\Model\Request\MobilRegisterReq;
use SamTech\Repository\MobilRepository;

class MobilServiceTest extends TestCase
{
    private MobilService $service;
    private MobilRepository $repo;


    protected function setUp(): void
    {
        $con = Database::getConection();
        $this->repo = new MobilRepository($con);
        $this->service = new MobilService($this->repo);

        $this->repo->deleteAll();
    }

    public function testRegisterSucces()
    {
        $request = new MobilRegisterReq();
        $request->id = 12;
        $request->nama = "Avanza";
        $request->merek = "Honda";
        $request->dimensi = "30 71 6";
        $request->bbm = "20l";
        $request->mesin = "mesin aman";
        $request->tahun = "2020";
        $request->biaya = 200000;
        $request->image = "avanza.jpg";

        $response = $this->service->register($request);

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

        $this->service->register($request);
    }
    public function testRegisterDuplicate()
    {
        $mobil = new Mobil();
        $mobil->id = 10;
        $mobil->nama = "Avanza";
        $mobil->merek = "Honda";
        $mobil->dimensi = "30 71 6";
        $mobil->bbm = "20l";
        $mobil->mesin = "lancar jaya";
        $mobil->tahun = "2020";
        $mobil->biaya = 200000;
        $mobil->image = "avanza.jpg";

        $this->repo->save($mobil);
        $this->expectException(ValidationMobil::class);


        $request = new MobilRegisterReq();
        $request->id = 10;
        $request->nama = "Avanza";
        $request->merek = "Honda";
        $request->dimensi = "30 71 6";
        $request->bbm = "20l";
        $request->mesin = "lancar jaya";
        $request->tahun = "2020";
        $request->biaya = 200000;
        $request->image = "avanza.jpg";

        $this->service->register($request);
    }
}
