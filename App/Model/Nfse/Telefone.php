<?php
namespace App\Model\Nfse;

class Telefone
{
    private $ddd;
    private $numero;

    public function __construct($ddd, $numero)
    {
        $this->ddd = $ddd;
        $this->numero = $numero;
    }

    /**
     * Get the value of ddd
     */ 
    public function getDdd()
    {
        return $this->ddd;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }
}
