<?php

namespace App\DAO;
use App\Config\BancoConfig;

class EmpresasPlanosDAO{
    private $conexao;
    private $planosId;
    private $empresasId;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getPlanosPreEmpresas($id)
    {
        $query = "  SELECT
                    	p.nome, p.valor
                    FROM
                    	empresas_planos as empp
                    LEFT JOIN
                    	pre_empresas as preemp
                    ON
                    	empp.empresas_id = preemp.id
                    LEFT JOIN
                    	planos as p
                    ON
                    	empp.planos_id = p.id
                    WHERE
                    preemp.id = $id;";

        $retorno = mysqli_query($this->conexao, $query);
        $planos = array();
        
        while($plano = mysqli_fetch_assoc($retorno)){
            $planos[] = $plano;
        }

        return $planos;
    }

    public function getPlanos($id)
    {
        $query = "  SELECT
                    	p.nome, p.valor
                    FROM
                    	empresas_planos as empp
                    LEFT JOIN
                    	empresas as emp
                    ON
                    	empp.empresas_id = emp.id
                    LEFT JOIN
                    	planos as p
                    ON
                    	empp.planos_id = p.id
                    WHERE
                    emp.id = $id;";
        $retorno = mysqli_query($this->conexao, $query);
        $planos = array();
        while($plano = mysqli_fetch_assoc($retorno)){
            $planos[] = $plano;
        }

        return $planos;
    }

    public function setPlano($planosId, $empresasId)
    {
        $query = "INSERT INTO empresas_planos(planos_id, empresas_id) VALUES ({$planosId}, {$empresasId});";

        $retorno['resultado'] = mysqli_query($this->conexao, $query);
        $retorno['empresas_planos_id'] = mysqli_insert_id($this->conexao);

        return $retorno;
    }
}
