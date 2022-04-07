<?php

namespace App\Api;

class Curl{

    public static function executaCurl($url, $post = "", $header = ""){
        //Inicia o cURL
        $ch = curl_init($url);

        //Pede o que retorne o resultado como string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //Envia cabeçalhos (Caso tenha)
        if($header != "") {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        //Envia post (Caso tenha)
        if($post != "") {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }

        //Ignora certificado SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //Manda executar a requisição
        $data['dados'] = curl_exec($ch);
        $data['resposta_http'] = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        //Fecha a conexão para economizar recursos do servidor
        curl_close($ch);

        //Retorna o resultado da requisição

        return $data;
    }
}
