<?php
namespace App\Model\Empresa;

use App\Config\BancoConfigPDO;

class EmpresaAliquota
{
    private $id;
    private $empresaId;
    private $aliquota;
    private $fatorR;
    private $dataCompetencia;
    private $createdAt;
    private $updatedAt;

    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

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
     * Get the value of empresaId
     */ 
    public function getEmpresaId()
    {
        return $this->empresaId;
    }

    /**
     * Set the value of empresaId
     *
     * @return  self
     */ 
    public function setEmpresaId($empresaId)
    {
        $this->empresaId = $empresaId;

        return $this;
    }

    /**
     * Get the value of aliquota
     */ 
    public function getAliquota()
    {
        return $this->aliquota;
    }

    /**
     * Set the value of aliquota
     *
     * @return  self
     */ 
    public function setAliquota($aliquota)
    {
        $this->aliquota = $aliquota;

        return $this;
    }

    /**
     * Get the value of fatorR
     */ 
    public function getFatorR()
    {
        return $this->fatorR;
    }

    /**
     * Set the value of fatorR
     *
     * @return  self
     */ 
    public function setFatorR($fatorR)
    {
        $this->fatorR = $fatorR;

        return $this;
    }

    /**
     * Get the value of dataCompetencia
     */ 
    public function getDataCompetencia()
    {
        return $this->dataCompetencia;
    }

    /**
     * Set the value of dataCompetencia
     *
     * @return  self
     */ 
    public function setDataCompetencia($dataCompetencia)
    {
        $this->dataCompetencia = $dataCompetencia;

        return $this;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */ 
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get the value of updatedAt
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set the value of updatedAt
     *
     * @return  self
     */ 
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getIss($empresasId)
    {
        $query = "SELECT 
                    *
                FROM 
                    empresas_aliquotas
                WHERE 
                    empresas_id = :empresasId;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
}