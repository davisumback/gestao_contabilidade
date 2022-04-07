<?php
namespace App\Model\Empresa;

class ConsultaCertificado
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function getCertificados($empresasId)
    {
        $query = "SELECT
                    *
                FROM
                    empresas_certificados
                WHERE
                    empresas_id = :empresasId;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);      
    }
}