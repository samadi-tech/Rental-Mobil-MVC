<?php

namespace SamtechSkripsi\Controller;


use SamtechSkripsi\App\View;

class HomeController
{

    function index()
    {
        // $model = [
        //     "tittle" => "Samtech Skripsi",
        //     "content" => "Halaman index HOME"

        // ];

        // Render::view("Home/index",$model);



        View::view("Home/index", [
            "tittle" => "Stock Barang | Kelompok 4",
            "content" => "Halaman index HOME",
            "URL"   => "http://localhost/Tugas-PBO/public/resource/css/app.css"
        ]);
    }
    function css()
    {
    }
}
