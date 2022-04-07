<?php
namespace App\Model\ValueObject;

class Cpf
{
    public function __construct($cpf)
    {
        $this->validaCpf($cpf);
    }

    public function validaCpf($cpf)
    {
        if(empty($cpf)) {
            throw new \Exception("CPF em branco.", 1);
        }

        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        // $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
	
        if (strlen($cpf) != 11) {
            throw new \Exception("CPF com menos de 11 dígitos.", 1);
        }

        $invalidos = [
            '00000000000',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999'
        ];

        if (\in_array($cpf, $invalidos)) {
            throw new \Exception("CPF com 11 dígitos iguais.", 1);
        }

		
		for ($t = 9; $t < 11; $t++) {			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf{$c} * (($t + 1) - $c);
            }
            
            $d = ((10 * $d) % 11) % 10;
            
			if ($cpf{$c} != $d) {
				throw new \Exception("CPF inválido.", 1);
			}
		}
    }
}