<?php
namespace App\Model\Empresa;

class ContaBancaria
{
    private $id;
    private $banco;
    private $empresasId;
    private $clientesId;
    private $numero;
    private $digito;
    private $agencia;
    private $tipo;
    private $pessoa;
    private $contaPadrao;

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
     * Get the value of empresasId
     */ 
    public function getEmpresasId()
    {
        return $this->empresasId;
    }

    /**
     * Set the value of empresasId
     *
     * @return  self
     */ 
    public function setEmpresasId($empresasId)
    {
        $this->empresasId = $empresasId;

        return $this;
    }

    /**
     * Get the value of clientesId
     */ 
    public function getClientesId()
    {
        return $this->clientesId;
    }

    /**
     * Set the value of clientesId
     *
     * @return  self
     */ 
    public function setClientesId($clientesId)
    {
        $this->clientesId = $clientesId;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of digito
     */ 
    public function getDigito()
    {
        return $this->digito;
    }

    /**
     * Set the value of digito
     *
     * @return  self
     */ 
    public function setDigito($digito)
    {
        $this->digito = $digito;

        return $this;
    }

    /**
     * Get the value of agencia
     */ 
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * Set the value of agencia
     *
     * @return  self
     */ 
    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of pessoa
     */ 
    public function getPessoa()
    {
        return $this->pessoa;
    }

    /**
     * Set the value of pessoa
     *
     * @return  self
     */ 
    public function setPessoa($pessoa)
    {
        switch ($pessoa) {
            case 'PF':
                $this->pessoa = 'Pessoa Física';
                break;
            case 'PJ':
                $this->pessoa = 'Pessoa Jurídica';
                break;
        }
    }

    /**
     * Get the value of contaPadrao
     */ 
    public function getContaPadrao()
    {
        return $this->contaPadrao;
    }

    /**
     * Set the value of contaPadrao
     *
     * @return  self
     */ 
    public function setContaPadrao($contaPadrao)
    {
        $this->contaPadrao = $contaPadrao;

        return $this;
    }

    /**
     * Get the value of banco
     */ 
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * Set the value of banco
     *
     * @return  self
     */ 
    public function setBanco(\App\Model\Empresa\Banco $banco)
    {
        $this->banco = $banco;

        return $this;
    }
}