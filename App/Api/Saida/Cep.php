<?php

namespace App\Api\Saida;
use App\Api\Curl;

class Cep{

    public static function consultaCep($cepEntrada){
        $cep = str_replace('-', '', $cepEntrada);
        $url = 'https://viacep.com.br/ws/'.$cep.'/json/';

        $retorno = Curl::executaCurl($url);

        return $retorno;
    }
}
