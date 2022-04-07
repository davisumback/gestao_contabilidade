<?php
namespace App\Model\Nfse;

class Inss
{
    public $aliquota;
    public $valor;

    public function __construct($aliquota, $valor)
    {
        $this->aliquota = $aliquota;
        $this->valor = $valor;
    }
}