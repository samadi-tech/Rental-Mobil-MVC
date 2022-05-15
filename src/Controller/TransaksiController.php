<?php

namespace SamTech\Controller;

use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationTransaksi;
use SamTech\Model\Request\TransaksiAddReq;
use SamTech\Repository\TransaksiRepository;
use SamTech\Service\TransaksiService;

class TransaksiController
{
    private TransaksiService $service;

    public function __construct()
    {
        $con = Database::getConection();
        $repo = new TransaksiRepository($con);
        $this->service = new TransaksiService($repo);
    }

    function transaksi()
    {
        $transaksi = $this->service->showData();

        View::ViewAdmin("Admin/transaksi", [
            "title" => "Data Transaksi | Rental Mobil | SamTech",
            "data" => $transaksi

        ]);
    }


    public function tambah()
    {
        $request = new TransaksiAddReq();
        $request->id = $_POST['id'];
        $request->idmember = $_POST['idmember'];
        $request->idmobil = $_POST['idmobil'];
        $request->tglpinjam = $_POST['tglpinjam'];
        $request->tglkembali = $_POST['tglkembali'];
        $request->tarif = $_POST['tarif'];


        if (isset($_POST['tambah'])) {
            try {
                $this->service->add($request);
                View::Redirect("transaksi/transaksi");
            } catch (ValidationTransaksi $exception) {
                View::ViewAdmin("transaksi/error", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()

                ]);
            }
        }
        if (isset($_POST['pesan'])) {
            try {
                $this->service->add($request);
                View::Redirect("transaksi/transaksi");
            } catch (ValidationTransaksi $exception) {
                View::ViewAdmin("transaksi/error", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()

                ]);
            }
        }
    }
}
