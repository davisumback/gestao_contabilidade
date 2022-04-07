<?php

namespace App\Api;

class CurlRobo{

    public static function executaCurl($url, $post = "", $header = ""){
        $_h = curl_init();
        curl_setopt($_h, CURLOPT_HEADER, 1);
        curl_setopt($_h, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($_h, CURLOPT_HTTPGET, 1);
        curl_setopt($_h, CURLOPT_URL, $url);
        curl_setopt($_h, CURLOPT_DNS_USE_GLOBAL_CACHE, false );
        curl_setopt($_h, CURLOPT_DNS_CACHE_TIMEOUT, 2 );
        curl_setopt($_h, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        $data['dados'] = curl_exec($_h);
        $data['resposta_http'] = curl_getinfo($_h, CURLINFO_HTTP_CODE);
        $data['erro'] = curl_error($_h);

        return $data;
    }
}
