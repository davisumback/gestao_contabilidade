<?php

namespace App\Entidade;

class EnderecoEmpresa{
    private $empresasId;
    private $iptu;
    private $cep;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cidade;
    private $uf;
    private $complemento;


    function __construct($empresasId = "", $iptu, $cep, $logradouro, $numero, $bairro, $cidade, $uf, $complemento){
        $this->empresasId = $empresasId;
        $this->iptu = $iptu;
        $this->logradouro = $logradouro;
        $this->cep = $cep;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->complemento = $complemento;
    }

    /**
     * Get the value of Clientes Id
     *
     * @return mixed
     */
    public function getEmpresasId()
    {
        return $this->empresasId;
    }

    /**
     * Get the value of Socios Id
     *
     * @return mixed
     */
    public function getSociosId()
    {
        return $this->sociosId;
    }

    /**
     * Get the value of Iptu
     *
     * @return mixed
     */
    public function getIptu()
    {
        return $this->iptu;
    }

    /**
     * Get the value of Cep
     *
     * @return mixed
     */
    public function getCep()
    {
        return $this->cep;
    }

    /**
     * Get the value of Logradouro
     *
     * @return mixed
     */
    public function getLogradouro()
    {
        return $this->logradouro;
    }

    /**
     * Get the value of Numero
     *
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Get the value of Bairro
     *
     * @return mixed
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Get the value of Cidade
     *
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }

    /**
     * Get the value of Uf
     *
     * @return mixed
     */
    public function getUf()
    {
        return $this->uf;
    }

    /**
     * Get the value of Complemento
     *
     * @return mixed
     */
    public function getComplemento()
    {
        return $this->complemento;
    }

}
