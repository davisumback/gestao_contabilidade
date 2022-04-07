<?php
namespace App\Model\Empresa;

use App\Config\BancoConfigPDO;

class Faturamento
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfigPDO::conecta();
    }

    public function empresasSemFaturamento()
    {
        $query = "SELECT
                    id, nome_empresa, cnpj
                FROM
                    empresas
                WHERE id NOT IN (SELECT empresas_id FROM empresas_faturamentos);";

        $sth = $this->conexao->prepare($query);        
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getFaturamento()
    {
        $query = "SELECT
                    empresas_id, faturamento, mes
                FROM
                    empresas_faturamentos;";

        $sth = $this->conexao->prepare($query);        
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
     
    }

    public function save($attributes)
    {
        $attributes["mes"] = '01/' . $attributes["mes"];
        $attributes["mes"] = \App\Helper\Helpers::formataDataBd($attributes["mes"]);
        $attributes['faturamento'] = \App\Helper\Helpers::formataStringMoeda($attributes['faturamento']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_faturamentos (
                    empresas_id, faturamento, mes, created_at
                ) VALUES (
                    :empresas_id, :faturamento, :mes, :created_at
                );";    

        $sth = $this->conexao->prepare($query);        
        $sth->bindValue(':empresas_id', $attributes['empresasId'], \PDO::PARAM_STR);
        $sth->bindValue(':faturamento', $attributes['faturamento'], \PDO::PARAM_STR);
        $sth->bindValue(':mes', $attributes["mes"], \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function isFaturamento($mes, $empresasId)
    {
        $query = "SELECT
                    *
                FROM
                    empresas_faturamentos
                WHERE
                    empresas_id = :empresasId
                AND
                    mes = :mes;";

        $sth = $this->conexao->prepare($query);        
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':mes', $mes, \PDO::PARAM_STR);

        $sth->execute();

        if (! empty($sth->fetchAll())) {
            throw new \Exception("Já existe um faturamento cadastrado no mês " . 
            \App\Helper\Helpers::formataDataCompetenciaView($mes), 1);
        }
    }
}