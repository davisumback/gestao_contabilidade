<?php
namespace App\Model\Nfse;

use App\Model\Nfse\Prestador;
use App\Model\Nfse\Tomador;
use App\Model\Nfse\Servico;

class NotaFiscal 
{
    public $prestador;
    public $tomador;
    public $servico;
    public $enviarEmail;

    public function __construct(Prestador $prestador, Tomador $tomador, Servico $servico)
    {
        $this->prestador = $prestador;
        $this->tomador = $tomador;
        $this->servico = $servico;
        $this->enviarEmail = true;
    }
}