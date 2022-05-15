<?php

namespace SamTech\Controller;

use Exception;
use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationPesan;
use SamTech\Model\Request\BantuanKirimRequest;
use SamTech\Repository\BantuanRepository;
use SamTech\Service\BantuanService;

class BantuanController
{

    private BantuanService $service;

    public function __construct()
    {
        $con = Database::getConection();
        $repo = new BantuanRepository($con);
        $this->service = new BantuanService($repo);
    }

    function bantuan()
    {
        View::ViewHome("Home/bantuan", [
            "title" => "Rental Mobil | SamTech",

        ]);
    }

    function pesan()
    {
        if (isset($_POST['kirim'])) {
            $bantuan = new BantuanKirimRequest;
            $bantuan->nama = $_POST['nama'];
            $bantuan->subject = $_POST['subject'];
            $bantuan->pesan = $_POST['pesan'];

            try {
                $this->service->kirim($bantuan);
            } catch (ValidationPesan $m) {
                throw new ValidationPesan($m->getMessage());
            }
        }
    }

    function admin()
    {
        $pesan = $this->service->showData();
        View::ViewAdmin("Admin/pesan", [
            "title" => "Data Pesan | Rental Mobil | SamTech",
            "pesan" => $pesan
        ]);
    }
}
