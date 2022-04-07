<?php
namespace App\Model\ValueObject;

class Telefone
{
    private $numeroTelefone;

    public function __construct($numeroTelefone)
    {
        $this->numeroTelefone = $numeroTelefone;
        $this->validaTelefone();
    }

    // Valida telefone vindo do formulário
    private function validaTelefone()
    {
        $this->numeroTelefone = str_replace('(', '', $this->numeroTelefone);
        $this->numeroTelefone = str_replace(')', '', $this->numeroTelefone);
        $this->numeroTelefone = str_replace('-', '', $this->numeroTelefone);
        $this->numeroTelefone = str_replace(' ', '', $this->numeroTelefone);
    }

    public function getTelefone()
    {
        return $this->numeroTelefone;
    }
}
