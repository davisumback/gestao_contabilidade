<?php
namespace App\DAO;



class EmpresasLiberacoesDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function getEmpresasLiberadasEProlabores($data)
    {
        $query = 'SELECT
                    el.empresas_id, el.data_competencia, e.nome_empresa
                FROM
                    empresas_liberacoes as el
                LEFT JOIN
                    empresas as e
                ON
                    el.empresas_id = e.id
                WHERE
                    DATE(el.created_at) = :dataPesquisa
                ORDER BY
                    el.empresas_id ASC';

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':dataPesquisa', $data, \PDO::PARAM_STR);
        $sth->execute();

        $objetos = $sth->fetchAll(\PDO::FETCH_OBJ);

        foreach ($objetos as $empresasLiberadas) {
            $prolaboreAtual = $this->getProlaboreEmpresa($empresasLiberadas->empresas_id, $empresasLiberadas->data_competencia);
            $dataCompetencia = \DateTime::createFromFormat('Y-m-d', $empresasLiberadas->data_competencia);
            $empresasLiberadas->competencia = $dataCompetencia->format('m/Y');
            $empresasLiberadas->prolaboreCompetencia = $prolaboreAtual;

            $date = \DateTime::createFromFormat('Y-m-d', $empresasLiberadas->data_competencia);
            $date->sub(new \DateInterval('P1M'));

            $empresasLiberadas->competenciaAnterior = $date->format('m/Y');

            $prolaboreAnterior = $this->getProlaboreEmpresa($empresasLiberadas->empresas_id, $date->format('Y-m-d'));

            $empresasLiberadas->prolaboreAnterior = $prolaboreAnterior;
        }

        return $objetos;
    }

    public function getProlaboreEmpresa($empresasId, $dataCompetencia)
    {
        $query = 'SELECT prolabore FROM empresas_prolabores WHERE data_competencia = :competencia AND empresas_id = :empresasId';

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':competencia', $dataCompetencia, \PDO::PARAM_STR);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_STR);
        $sth->execute();

        $retorno = $sth->fetchAll(\PDO::FETCH_OBJ);

        return $retorno[0]->prolabore;
    }
}