<?php
namespace App\Model\Faturamento;

use App\Helper\Helpers;

class Mes
{
    private $empresasId;
    private $faturamento;
    private $mes;
    private $createdAt;

    public function getEmpresasId()
    {
        return $this->empresasId;
    }

    public function setEmpresasId($empresasId)
    {
        $this->empresasId = $empresasId;
    }

    public function getFaturamento()
    {
        return Helpers::formataMoedaView($this->faturamento);
    }

    public function getFaturamentoSemFormatacao()
    {
        return $this->faturamento;
    }

    public function setFaturamento($faturamento)
    {
        $this->faturamento = $faturamento;
    }

    public function getMes()
    {
        return Helpers::formataDataCompetenciaView($this->mes);
    }

    public function getMesSemFormatacao()
    {
        return $this->mes;
    }

    public function setMes($mes)
    {
        $this->mes = $mes;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}