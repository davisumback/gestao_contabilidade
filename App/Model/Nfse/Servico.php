<?php
namespace App\Model\Nfse;

use App\Model\Nfse\Iss;
use App\Model\Nfse\Valor;

class Servico
{
    public $codigo;
    public $discriminacao;
    public $cnae;
    public $valor;
    public $retencao;

    public function __construct($codigo, $discriminacao, $cnae, Iss $iss, Valor $valor)
    {
        $this->codigo = $codigo;
        $this->discriminacao = $discriminacao;
        $this->cnae = $cnae;
        $this->iss = $iss;
        $this->valor = $valor;
    }

    public function setRetencao(\App\Model\Nfse\Retencao $retencao)
    {
        $this->retencao = $retencao;
    }
}