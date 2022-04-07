<?php
namespace App\Model\Os;

class Certidao
{    
    private $titulo;
    private $status;
    private $descricao;
    private $tiposOsId;

    public function __construct($titulo, $status, $descricao)
    {
        $this->titulo = 'Certidão';
        $this->status = $status;
        $this->descricao = $descricao;
        $this->tiposOsId = 3;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of descricao
     */ 
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Get the value of tiposOsId
     */ 
    public function getTiposOsId()
    {
        return $this->tiposOsId;
    }
}