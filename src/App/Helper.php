<?php

namespace SamTech\App;

class Helper
{

    public static function UploadGambar()
    {
        $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');
        $nama = $_FILES['image']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $ukuran    = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            if ($ukuran < 2044070) {
                $lokasi = __DIR__ . "/../Assets/img/"  . $nama;
                $aksi = move_uploaded_file($file_tmp, $lokasi);
                if ($aksi) {
                    return $nama;
                } else {
                    exit;
                }
            } else {
                echo 'UKURAN FILE TERLALU BESAR';
            }
        } else {
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }
}
