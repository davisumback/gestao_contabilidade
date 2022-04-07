<?php
namespace App\Model\Empresa;

class Certidoes
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function getCertidoes($empresasId)
    {
        $query = "SELECT 
                    ec.empresas_id, ec.certidoes_tipos, tc.nome, ec.data_validade
                FROM 
                    empresas_certidoes as ec
                LEFT JOIN 
                    tipos_certidoes as tc
                ON
                    tc.id = ec.certidoes_tipos
                WHERE 
                    empresas_id = :empresasId;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getCertidoesAtuais($empresasId, $tipo)
    {
        $query = "SELECT 
                    *
                FROM 
                    (SELECT 
                        * 
                    FROM 
                        empresas_certidoes
                    WHERE 
                        certidoes_tipos = :tipo 
                    AND 
                        empresas_id = :empresasId 
                    ORDER BY 
                        created_at 
                    DESC LIMIT 1) as ec
                LEFT JOIN
                    tipos_certidoes as tc
                ON
                    tc.id = ec.certidoes_tipos;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':tipo', $tipo, \PDO::PARAM_INT);
        $sth->execute();

        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);
        
        if (! empty($retorno)) {
            return $retorno[0];
        }
        return null;
    }
}
