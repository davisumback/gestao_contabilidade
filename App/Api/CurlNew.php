<?php

namespace App\Api;

class CurlNew
{
    public static function executaCurl($url, $post = array(), $header = array(), $method = null)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (! empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        if ($method != null && $method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
        }


        if (! empty($post)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $data['dados'] = curl_exec($ch);
        $data['respostaHttp'] = curl_getinfo($ch,CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $data;
    }
}