<?php

namespace SamtechSkripsi\Controller;

use SamtechSkripsi\App\View;

class LoginController
{

    function Login()
    {
        $data = [
            "tittle" => "Login Page"
        ];
        View::ViewLogin("Login/index", $data);
    }
    function Register()
    {
        $data = [
            "tittle" => "Register Page"
        ];
        View::ViewLogin("Register/index", $data);
    }
}
