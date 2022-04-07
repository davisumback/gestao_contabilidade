<?php
namespace App\Model\Nfse;

class Prefeitura
{
    public $login;
    public $senha;

    public function __construct($login, $senha)
    {
        $this->login = $login;
        $this->senha = $senha;
    }
}