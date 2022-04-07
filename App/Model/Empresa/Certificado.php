<?php
namespace App\Model\Empresa;

use App\Helper\Helpers;


class Certificado
{
    private $empresasId;
    private $senha;
    private $arquivo;
    private $validade;
    private $idIntegracao;

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
     * Get the value of senha
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  self
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get the value of arquivo
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set the value of arquivo
     *
     * @return  self
     */
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;

        return $this;
    }

    /**
     * Get the value of validade
     */
    public function getValidade()
    {
        return Helpers::formataDataView($this->validade);
    }

    /**
     * Set the value of validade
     *
     * @return  self
     */
    public function setValidade($validade)
    {
        $this->validade = $validade;

        return $this;
    }

    /**
     * Get the value of idIntegracao
     */
    public function getIdIntegracao()
    {
        return $this->idIntegracao;
    }

    /**
     * Set the value of idIntegracao
     *
     * @return  self
     */
    public function setIdIntegracao($idIntegracao)
    {
        $this->idIntegracao = $idIntegracao;

        return $this;
    }
}
