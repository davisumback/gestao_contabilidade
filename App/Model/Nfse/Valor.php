<?php
namespace App\Model\Nfse;

class Valor
{
    public $servico;

    public function __construct($valorDoServico)
    {
        $this->servico = intval($valorDoServico);
    }
}