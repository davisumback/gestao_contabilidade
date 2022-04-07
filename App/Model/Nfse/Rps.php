<?php
namespace App\Model\Nfse;

class Rps
{
    private $serie;
    private $numero;
    private $lote;

    public function __construct($serie, $numero, $lote)
    {
        $this->serie = $serie;
        $this->numero = $numero;
        $this->lote = $lote;
    }

    /**
     * Get the value of serie
     */ 
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Get the value of lote
     */ 
    public function getLote()
    {
        return $this->lote;
    }
}