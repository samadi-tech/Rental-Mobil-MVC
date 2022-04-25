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

        View::ViewHome("Home/index", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function login()
    {
        View::ViewHome("Home/login", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function register()
    {
        View::ViewHome("Home/register", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function booking()
    {
        View::ViewHome("Home/booking", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function bantuan()
    {
        View::ViewHome("Home/bantuan", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function tentang()
    {
        View::ViewHome("Home/tentang", [
            "title" => "Rental Mobil | SamTech",
            "content" => "Halaman index HOME"

        ]);
    }

    function error()
    {
        View::ViewLogin("Home/error", [
            "title" => "Page Not Found | 404"
        ]);
    }
}
