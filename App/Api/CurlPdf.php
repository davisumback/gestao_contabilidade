<?php

namespace App\Api;

class CurlPdf
{
    public static function executa($url, $header = array(), $fp)
    {
        $ch = \curl_init($url);
        
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        \curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        \curl_setopt($ch, CURLOPT_FILE, $fp);
        \curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        \curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        \curl_setopt($ch, CURLOPT_VERBOSE, true);

        $dados['dados'] = curl_exec($ch);
        $dados['respostaHttp'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        \curl_close($ch);

        return $dados;
    }
}