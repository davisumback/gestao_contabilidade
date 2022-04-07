<?php

namespace App\Helper;

class NaturezaJuridica{

    public static function formataNaturezaJuridica($natureza){
        switch ($natureza) {
            case '2062':
                return 'LTDA';
                break;
            case '2305':
                return 'Eireli';
                break;
            case '2135':
                return 'Individual';
                break;
        }
    }
}
