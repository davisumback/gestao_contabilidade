<?php
namespace App\Api\Saida;

use App\Api\Curl;
use App\Helper\Helpers;

class Cnpj
{
    const PACKAGE = 6;
    const TYPE = 'json';

    public static function consultaCnpj($cnpj, $url, $token)
    {
        $cnpj = Helpers::formataCnpjBd($cnpj);
        $url = $url . '/' . $token . '/' . self::PACKAGE . '/' . self::TYPE . '/' . $cnpj;

        return Curl::executaCurl($url);
    }
}
