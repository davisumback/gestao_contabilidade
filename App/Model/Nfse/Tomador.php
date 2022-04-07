<?php
use App\Model\Nfse\Endereco;

namespace App\Model\Nfse;

class Tomador
{
    public $cpfCnpj;
    public $razaoSocial;
    public $email;

    public function __construct($cpfCnpj, $razaoSocial, $email, Endereco $endereco)
    {
        $cnpj = new \App\Model\ValueObject\Cnpj($cpfCnpj);        
        $this->cpfCnpj = $cnpj->getCnpj();
        $this->razaoSocial = $razaoSocial;
        $this->email = $email;
        $this->endereco = $endereco;
    }
}