<?php

namespace App\Helper;

class EstadoCivil{

    public static function formataEstadoCivil($estadoEntrada){
        switch ($estadoEntrada) {
            case 'SO':
                return 'Solteiro';
                break;
            case 'CA':
                return 'Casado';
                break;
            case 'DI':
                return 'Divorciado';
                break;
            case 'VI':
                return 'Viúvo';
                break;
            case 'SE':
                return 'Separado';
                break;
            default:
                return 'Solteiro';
                break;
        }
    }

    public static function formataRegimeCasamento($regime){
        switch ($regime) {
            case 'CP':
                return 'Comunhão Parcial';
                break;
            case 'CU':
                return 'Comunhão Universal';
                break;
            case 'PFA':
                return 'Participação Final nos Aquestos';
                break;
            case 'SB':
                return 'Separação de Bens';
                break;
            case 'SO':
                return 'Seperação Obrigatória';
                break;
            default:
                return '';
                break;
        }
    }
}
