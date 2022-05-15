<?php

namespace SamTech\Controller;

use SamTech\App\Helper;
use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationMobilException;
use SamTech\Model\Request\MobilAddRequest;
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
        $mobil = $this->mobil->showData();

        View::ViewAdmin("Admin/mobil", [
            "title" => "Data Mobil | Rental Mobil | SamTech",
            "data" => $mobil,

        ]);
    }


    public function tambah()
    {
        $request = new MobilAddRequest();
        $request->id = $_POST['id'];
        $request->nama = $_POST['nama'];
        $request->merek = $_POST['merek'];
        $request->bbm = $_POST['bbm'];
        $request->tahun = $_POST['tahun'];
        $request->kapasitas = $_POST['kapasitas'];
        $request->keterangan = $_POST['keterangan'];
        $request->biaya = $_POST['biaya'];
        $request->image = Helper::UploadGambar();

        if (isset($_POST['add'])) {
            var_dump($request);
            try {
                $this->mobil->add($request);
                View::Redirect("/admin/mobil");
            } catch (ValidationMobilException $exception) {
                View::ViewAdmin("admin/mobil", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()
                ]);
            }
        }
    }
}
