<?php
namespace App\Model\Nfse;

class Config
{
    public $producao;
    public $rps;
    public $prefeitura;
    public $email;

    public function setPrefeitura($prefeitura)
    {
        $this->prefeitura = $prefeitura;
        $this->producao = true;
    }
}