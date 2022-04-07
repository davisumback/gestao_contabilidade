<?php
namespace App\Helper;

class HelperView
{
    public static function getValorFaixaPrecoMedcontabil($faixa)
    {
        switch ($faixa) {
            case 1:
                return 'R$ 40.000';
            case 2:
                return 'R$ 40.001 até R$ 80.000';
            case 3:
                return 'R$ 80.001 até R$120.000';
            case 4:
                return 'R$ 120.001 até R$ 160.000';
            case 5:
                return 'R$ 160.001 até R$ 200.000';
            case 6:
                return 'R$ 200.000 para cima';
        }
    }
}