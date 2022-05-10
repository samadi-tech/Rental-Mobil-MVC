<?php

namespace SamTech\Controller;

use SamTech\App\Helper;
use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationMobil;
use SamTech\Model\Request\MobilRegisterReq;
use SamTech\Repository\MobilRepository;
use SamTech\Service\MobilService;

class MobilController
{
    private MobilService $mobil;
    public function __construct()
    {
        $con = Database::getConection();
        $mobilRepo = new MobilRepository($con);
        $this->mobil = new MobilService($mobilRepo);
    }

    function mobil()
    {
        View::ViewAdmin("Admin/mobil", [
            "title" => "Data Mobil | Rental Mobil | SamTech",

        ]);
    }


    public function register()
    {
        $request = new MobilRegisterReq();
        $request->id = $_POST['id'];
        $request->nama = $_POST['nama'];
        $request->merek = $_POST['merek'];
        $request->bbm = $_POST['bbm'];
        $request->dimensi = $_POST['dimensi'];
        $request->mesin = $_POST['mesin'];
        $request->tahun = $_POST['tahun'];
        $request->biaya = $_POST['biaya'];
        $request->image = Helper::UploadGambar();

        if (isset($_POST['tambah'])) {
            try {
                $this->mobil->register($request);
            } catch (ValidationMobil $exception) {
                View::ViewAdmin("admin/mobil", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()
                ]);
            }
        }
    }
}
