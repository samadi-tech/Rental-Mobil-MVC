<?php

namespace SamTech\Controller;

use SamTech\App\Helper;
use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationMember;
use SamTech\Model\Request\MemberLoginRequest;
use SamTech\Model\Request\MemberRegisterRequest;
use SamTech\Repository\MemberRepository;
use SamTech\Service\MemberService;

class MemberController
{
    private MemberService $service;
    public function __construct()
    {
        $con = Database::getConection();
        $memberRepo = new MemberRepository($con);
        $this->service = new MemberService($memberRepo);
    }

    function member()
    {
        $member = $this->service->showData();
        View::ViewAdmin("Admin/member", [
            "title" => "Data Member | Rental Mobil | SamTech",
            "member" => $member
        ]);
    }


    public function register()
    {

        $request = new MemberRegisterRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->nama = $_POST['nama'];
        $request->ttl = $_POST['ttl'];
        $request->alamat = $_POST['alamat'];
        $request->telepon = $_POST['telepon'];
        $request->image = Helper::UploadGambar();


        if (isset($_POST['register'])) {

            try {
                $this->service->register($request);
                View::Redirect("/transaksi/login");
            } catch (ValidationMember $exception) {
                View::ViewAdmin("transaksi/register", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()
                ]);
            }
        }

        if (isset($_POST['tambah'])) {

            try {
                $this->service->register($request);
                View::Redirect("/admin/members");
            } catch (ValidationMember $exception) {
                View::ViewAdmin("admin/members", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()
                ]);
            }
        }
    }

    function login()
    {
        $request = new MemberLoginRequest();
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];


        if (isset($_POST['login'])) {

            try {
                $this->service->login($request);
                View::Redirect("/transaksi/booking");
            } catch (ValidationMember $exception) {
                View::ViewAdmin("transaksi/login", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()
                ]);
            }
        }
    }
}
