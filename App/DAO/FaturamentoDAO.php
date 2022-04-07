<?php
namespace App\DAO;

use App\Config\BancoConfigPDO;

class FaturamentoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfigPDO::conecta();
    }

    public function getFaturamentosPdf($empresasId, $limit)
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
					year(ef.mes) >= IF(e.inicio_atividades,year(e.inicio_atividades),\'00\')
				OR
                    (							
                            month(ef.mes) >= IF(e.inicio_atividades,month(e.inicio_atividades),\'01\')
                        AND
							year(ef.mes) >= IF(e.inicio_atividades,year(e.inicio_atividades),\'00\')
						AND
							e.id = :empresasId
                    )
                ORDER BY mes DESC
                LIMIT :limite;';

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':limite', $limit, \PDO::PARAM_INT);
        $sth->execute();
        $objetos = $sth->fetchAll(\PDO::FETCH_OBJ);

        $faturamento = new \App\Model\Faturamento\Faturamento();

        foreach ($objetos as $faturamentoBd) {
            $mes = new \App\Model\Faturamento\Mes();
            $mes->setEmpresasId($faturamentoBd->empresas_id);
            $mes->setFaturamento($faturamentoBd->faturamento);
            $mes->setMes($faturamentoBd->mes);
            $mes->setCreatedAt($faturamentoBd->created_at);
            $faturamento->setFaturamentoMes($mes);
        }

        return $faturamento;
    }

    public function getInfosDeclaracao($empresasId)
    {
        $query = 'SELECT
                    *
                FROM
                    empresas as emp
                LEFT JOIN
                    endereco_empresa as en
                ON
                    emp.id = en.empresas_id
                WHERE
                    emp.id = :empresasId';

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_OBJ);

        return $retorno[0];
    }

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
					year(ef.mes) >= IF(e.inicio_atividades,year(e.inicio_atividades),\'00\')
				OR
                    (							
                            month(ef.mes) >= IF(e.inicio_atividades,month(e.inicio_atividades),\'01\')
                        AND
							year(ef.mes) >= IF(e.inicio_atividades,year(e.inicio_atividades),\'00\')
						AND
							e.id = :empresasId
                    )
                ORDER BY mes DESC 
                LIMIT :limite;';

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':limite', $limit, \PDO::PARAM_INT);
        $sth->execute();
        $objetos = $sth->fetchAll(\PDO::FETCH_OBJ);

        $faturamento = new \App\Model\Faturamento\Faturamento();

        foreach ($objetos as $faturamentoBd) {
            $mes = new \App\Model\Faturamento\Mes();
            $mes->setEmpresasId($faturamentoBd->empresas_id);
            $mes->setFaturamento($faturamentoBd->faturamento);
            $mes->setMes($faturamentoBd->mes);
            $mes->setCreatedAt($faturamentoBd->created_at);
            $faturamento->setFaturamentoMes($mes);
        }

        return $faturamento;
    }
} 