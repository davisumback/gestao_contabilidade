<?php
namespace App\DAO;

use App\Config\BancoConfigPDO;

class EmpresaFaturamentoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfigPDO::conecta();
    }

    // Este método tem substituto dentro da classe App\DAO\FaturamentoDAO;
    public function getFaturamentos($empresasId, $limit)
    {
        $query = 'SELECT
                    ef.*
                FROM 
                    empresas_faturamentos as ef
                LEFT JOIN 
                    empresas as e
                ON 
                    ef.empresas_id = e.id
                WHERE
                    e.id = :empresasId
                AND
                    DATE_FORMAT (ef.mes, \'%y-%m\') >= DATE_FORMAT(e.inicio_atividades, \'%y-%m\')
                ORDER BY mes DESC 
                LIMIT :limite;';

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':limite', $limit, \PDO::PARAM_INT);
        $sth->execute();
        $objetos = $sth->fetchAll(\PDO::FETCH_OBJ);
        $faturamentos = [];

        foreach ($objetos as $faturamentoBd) {
            $faturamento = new \App\Model\Empresa\FaturamentoModel();
            $faturamento->setEmpresasId($faturamentoBd->empresas_id);
            $faturamento->setFaturamento($faturamentoBd->faturamento);
            $faturamento->setMes($faturamentoBd->mes);
            $faturamento->setCreatedAt($faturamentoBd->created_at);
            $faturamentos[] = $faturamento;
        }

        return $faturamentos;
    }

    public function getFaturamentoEnvioGuia($empresasId, $data)
    {
        $query = 'SELECT * FROM empresas_faturamentos WHERE empresas_id = :empresasId AND mes = :data_competencia;';

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':data_competencia', $data, \PDO::PARAM_STR);
        $sth->execute();

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
} 