<?php

namespace SamtechSkripsi\App;

class View
{

    public static function view(String $view, $model)
    {
        require __DIR__ . "/../App/Constant.php";
        require __DIR__ . "/../View/Template/header.php";
        require __DIR__ . "/../View/" . $view . ".php";
        require __DIR__ . "/../View/Template/footer.php";
    }
}
