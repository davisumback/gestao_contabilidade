<?php

namespace App\Entidade;

class Documento
{
    private $id;
    private $clienteId;
    private $nomeDocumento;
    private $numero;
    private $dataEmissao;
    private $orgaoExpedidor;
    private $naturalidade;
    private $validade;
    private $sociosId;
    private $tipoDocumento;
    private $uf;
    private $caminho;
    
    /**
     * Get the value of Cliente Id
     *
     * @return mixed
     */
    public function getClienteId()
    {
        return $this->clienteId;
    }

    /**
     * Set the value of Cliente Id
     *
     * @param mixed clienteId
     *
     * @return self
     */
    public function setClienteId($clienteId)
    {
        $this->clienteId = $clienteId;

        return $this;
    }

    /**
     * Get the value of Nome Documento
     *
     * @return mixed
     */
    public function getNomeDocumento()
    {
        return $this->nomeDocumento;
    }

    /**
     * Set the value of Nome Documento
     *
     * @param mixed nomeDocumento
     *
     * @return self
     */
    public function setNomeDocumento($nomeDocumento)
    {
        $this->nomeDocumento = $nomeDocumento;

        return $this;
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
     * Set the value of Numero
     *
     * @param mixed numero
     *
     * @return self
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of Data Emissao
     *
     * @return mixed
     */
    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }

    /**
     * Set the value of Data Emissao
     *
     * @param mixed dataEmissao
     *
     * @return self
     */
    public function setDataEmissao($dataEmissao)
    {
        $this->dataEmissao = $dataEmissao;

        return $this;
    }

    /**
     * Get the value of Orgao Expedidor
     *
     * @return mixed
     */
    public function getOrgaoExpedidor()
    {
        return $this->orgaoExpedidor;
    }

    /**
     * Set the value of Orgao Expedidor
     *
     * @param mixed orgaoExpedidor
     *
     * @return self
     */
    public function setOrgaoExpedidor($orgaoExpedidor)
    {
        $this->orgaoExpedidor = $orgaoExpedidor;

        return $this;
    }

    /**
     * Get the value of Naturalidade
     *
     * @return mixed
     */
    public function getNaturalidade()
    {
        return $this->naturalidade;
    }

    /**
     * Set the value of Naturalidade
     *
     * @param mixed naturalidade
     *
     * @return self
     */
    public function setNaturalidade($naturalidade)
    {
        $this->naturalidade = $naturalidade;

        return $this;
    }

    /**
     * Get the value of Validade
     *
     * @return mixed
     */
    public function getValidade()
    {
        return $this->validade;
    }

    /**
     * Set the value of Validade
     *
     * @param mixed validade
     *
     * @return self
     */
    public function setValidade($validade)
    {
        $this->validade = $validade;

        return $this;
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
     * Set the value of Socios Id
     *
     * @param mixed sociosId
     *
     * @return self
     */
    public function setSociosId($sociosId)
    {
        $this->sociosId = $sociosId;

        return $this;
    }

    /**
     * Get the value of Tipo Documento
     *
     * @return mixed
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set the value of Tipo Documento
     *
     * @param mixed tipoDocumento
     *
     * @return self
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
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
     * Set the value of Uf
     *
     * @param mixed uf
     *
     * @return self
     */
    public function setUf($uf)
    {
        $this->uf = $uf;

        return $this;
    }


    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Get the value of Caminho
     *
     * @return mixed
     */
    public function getCaminho()
    {
        return $this->caminho;
    }

    /**
     * Set the value of Caminho
     *
     * @param mixed caminho
     *
     * @return self
     */
    public function setCaminho($caminho)
    {
        $this->caminho = $caminho;

        return $this;
    }

}
