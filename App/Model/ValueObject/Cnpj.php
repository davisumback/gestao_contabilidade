<?php
namespace App\Model\ValueObject;

use App\Helper\Helpers;

class Cnpj
{
    private $cnpj;

    public function __construct($cnpj)
    {
        $this->validaCnpj($cnpj);
        $this->cnpj = Helpers::formataCnpjBd($cnpj);
    }
    
    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function validaCnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        if (strlen($cnpj) != 14) {
            throw new \Exception("CNPJ faltando caracteres.", 1);
        }

        $invalidos = [
            '00000000000000',
            '11111111111111',
            '22222222222222',
            '33333333333333',
            '44444444444444',
            '55555555555555',
            '66666666666666',
            '77777777777777',
            '88888888888888',
            '99999999999999'
        ];
                
        if (in_array($cnpj, $invalidos)) {	
            throw new \Exception("CNPJ inválido.", 1);
        }
        
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)) {
            throw new \Exception("CNPJ inválido.", 1);
        }
        
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
    
        if ($cnpj{13} != ($resto < 2 ? 0 : 11 - $resto)) {
            throw new \Exception("CNPJ inválido.", 1);
        }
    }
}