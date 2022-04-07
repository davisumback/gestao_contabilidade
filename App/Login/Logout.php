<?php

namespace App\Login;

class Logout
{

    public static function fazLogout(){
        setcookie('PHPSESSID', null, -1, '/');

        return null;
    }
}
