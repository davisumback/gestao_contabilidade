<?php

namespace App\Api\Saida;
use App\Api\Curl;
use App\Helper\Helpers;

class Cpf
{
    const PACKAGE = 9;
    const TYPE = 'json';

    public static function consultaCpf($cpf, $url, $token)
    {
        $cpf = Helpers::formataCpfBd($cpf);
        $url = $url . '/' . $token . '/' . self::PACKAGE . '/' . self::TYPE . '/' . $cpf;

        return Curl::executaCurl($url);
    }
}
