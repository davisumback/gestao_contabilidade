<?php
namespace App\Model\Empresa;

class CodigoServico
{
    private $id;
    private $codigoServico;
    private $nome;
        

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of codigoServico
     */ 
    public function getCodigoServico()
    {
        return $this->codigoServico;
    }

    /**
     * Set the value of codigoServico
     *
     * @return  self
     */ 
    public function setCodigoServico($codigoServico)
    {
        $this->codigoServico = $codigoServico;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }
}