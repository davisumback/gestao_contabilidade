<?php

namespace App\Entidade;

class Contrato{
    private $id;
    private $diaVencimento;
    private $primeiraMensalidade;
    private $empresasId;


    /**
     * Get the value of Dia Vencimento
     *
     * @return mixed
     */
    public function getDiaVencimento()
    {
        return $this->diaVencimento;
    }

    /**
     * Set the value of Dia Vencimento
     *
     * @param mixed diaVencimento
     *
     * @return self
     */
    public function setDiaVencimento($diaVencimento)
    {
        $this->diaVencimento = $diaVencimento;
    }

    /**
     * Get the value of Primeira Mensalidade
     *
     * @return mixed
     */
    public function getPrimeiraMensalidade()
    {
        return $this->primeiraMensalidade;
    }

    /**
     * Set the value of Primeira Mensalidade
     *
     * @param mixed primeiraMensalidade
     *
     * @return self
     */
    public function setPrimeiraMensalidade($primeiraMensalidade)
    {
        $this->primeiraMensalidade = $primeiraMensalidade;
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
     * Set the value of Clientes Id
     *
     * @param mixed clientesId
     *
     * @return self
     */
    public function setEmpresasId($empresasId)
    {
        $this->empresasId = $empresasId;
    }
}
