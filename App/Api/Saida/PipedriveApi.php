<?php

namespace App\Api\Saida;
use App\Api\Curl;

class PipedriveApi
{
    const COMPANY_DOMAIN = 'medb2';
    const API_TOKEN = 'e927963865370260459d7ef9b90ee443cf5491dc';

    public static function execute($uri = null)
    {
        $url = $url = 'https://' . self::COMPANY_DOMAIN . '.pipedrive.com/v1/deals?api_token=' . self::API_TOKEN;

        return Curl::executaCurl($url);
    }
}
