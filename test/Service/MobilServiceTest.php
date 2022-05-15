<?php

namespace SamTech\Service;

use PHPUnit\Framework\TestCase;
use SamTech\Config\Database;
use SamTech\Domain\Mobil;
use SamTech\Exceptions\ValidationMobilException;
use SamTech\Model\Request\MobilAddRequest;
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

    public function testAddSuccess()
    {
        $request = new MobilAddRequest();
        $request->id = "AV01";
        $request->nama = "Avanza";
        $request->merek = "HONDA";
        $request->bbm = "30 L";
        $request->tahun = "2017";
        $request->kapasitas = "8 Orang";
        $request->keterangan = "Mobil masih layak digunakan.";
        $request->biaya = 400000;
        $request->image = "avanza.jpeg";

        $response = $this->service->add($request);

        self::assertEquals($request->id, $response->mobil->id);
        self::assertEquals($request->nama, $response->mobil->nama);
        self::assertEquals($request->merek, $response->mobil->merek);
    }

    public function testAddFailed()
    {
        $this->expectException(ValidationMobilException::class);

        $request = new MobilAddRequest();
        $request->id = null;
        $request->nama = null;

        $this->service->add($request);
    }

    public function testRegisterDuplicate()
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

        $this->repo->save($mobil);
        $this->expectException(ValidationMobilException::class);


        $request = new MobilAddRequest();
        $request->id = "AV01";
        $request->nama = "Avanza";
        $request->merek = "HONDA";
        $request->bbm = "30 L";
        $request->tahun = "2017";
        $request->kapasitas = "8 Orang";
        $request->keterangan = "Mobil masih layak digunakan.";
        $request->biaya = 400000;
        $request->image = "avanza.jpeg";

        $response = $this->service->add($request);
    }
}
