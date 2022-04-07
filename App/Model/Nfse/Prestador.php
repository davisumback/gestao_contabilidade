<?php
namespace App\Model\Nfse;

use App\Model\Nfse\Endereco;

class Prestador
{
    public $cpfCnpj;
    public $inscricaoMunicipal;
    public $inscricaoEstadual;
    public $razaoSocial;
    public $nomeFansatia;
    public $simplesNacional;
    public $incentivadorCultural;
    public $incentivoFiscal;
    public $regimeTributario;
    public $regimeTributarioEspecial;
    public $endereco;
    public $telefone;
    public $email;
    public $certificado;
    public $config;

    public function __construct($cpfCnpjEntrada, $inscricaoMunicipal, $razaoSocial, $simplesNacional = true, Endereco $endereco, $certificadoId, $config)
    {        
        $this->cpfCnpj = $cpfCnpjEntrada;
        $this->inscricaoMunicipal = $inscricaoMunicipal;
        $this->razaoSocial = $razaoSocial;
        $this->simplesNacional = $simplesNacional;
        $this->endereco = $endereco;
        $this->incentivoFiscal = false;
        $this->incentivadorCultural = false;
        $this->certificado = $certificadoId;
        $this->config = $config;
    }
}