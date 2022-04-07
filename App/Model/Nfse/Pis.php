<?php
namespace App\Model\Nfse;

class Pis
{
    public $aliquota;
    public $valor;

    public function __construct($aliquota, $valor)
    {
        $this->aliquota = intval($aliquota);
        $this->valor = intval($valor);
    }
}