<?php

namespace SamTech\App;

class View
{

    public static function ViewHome(String $view, $model)
    {
        require __DIR__ . "/Constant.php";
        require __DIR__ . "/../View/Template/header.php";
        require __DIR__ . "/../View/Template/nav-home.php";
        require __DIR__ . "/../View/" . $view . ".php";
        require __DIR__ . "/../View/Template/footer.php";
    }

    public static function ViewLogin(String $view, $model)
    {
        require __DIR__ . "/Constant.php";
        require __DIR__ . "/../View/Template/header.php";
        require __DIR__ . "/../View/" . $view . ".php";
        require __DIR__ . "/../View/Template/footer.php";
    }

    public static function ViewAdmin(String $view, $model)
    {
        require __DIR__ . "/Constant.php";
        require __DIR__ . "/../View/Template/header.php";
        require __DIR__ . "/../View/Template/nav-admin.php";
        require __DIR__ . "/../View/" . $view . ".php";
        require __DIR__ . "/../View/Template/footer.php";
    }

    public static function redirect(string $url)
    {
        $baseURL = BASEURL;
        header("Location:  $baseURL/$url");
        exit();
    }
}
