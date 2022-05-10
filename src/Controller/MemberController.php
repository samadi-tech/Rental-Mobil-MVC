<?php

namespace SamTech\Controller;

use SamTech\App\Helper;
use SamTech\App\View;
use SamTech\Config\Database;
use SamTech\Exceptions\ValidationMember;
use SamTech\Model\Request\MemberRegisterReq;
use SamTech\Repository\MemberRepository;
use SamTech\Service\MemberService;

class MemberController
{
    private MemberService $member;
    public function __construct()
    {
        $con = Database::getConection();
        $memberRepo = new MemberRepository($con);
        $this->member = new MemberService($memberRepo);
    }

    function members()
    {
        View::ViewAdmin("Admin/members", [
            "title" => "Data Member | Rental Mobil | SamTech",
        ]);
    }


    public function register()
    {

        $request = new MemberRegisterReq();
        $request->id = $_POST['id'];
        $request->username = $_POST['username'];
        $request->password = $_POST['password'];
        $request->nama = $_POST['nama'];
        $request->ttl = $_POST['ttl'];
        $request->alamat = $_POST['alamat'];
        $request->telepon = $_POST['telepon'];
        $request->image = Helper::UploadGambar();


        if (isset($_POST['register'])) {

            try {
                $this->member->register($request);
                View::Redirect("transaksi/login");
            } catch (ValidationMember $exception) {
                View::ViewAdmin("transaksi/register", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()
                ]);
            }
        }

        if (isset($_POST['tambah'])) {

            try {
                $this->member->register($request);
                View::Redirect("admin/succes");
            } catch (ValidationMember $exception) {
                View::ViewAdmin("admin/members", [
                    "title" => "Input Data Gagal | Rental Mobil | SamTech",
                    "error" => $exception->getMessage()
                ]);
            }
        }
    }
}
