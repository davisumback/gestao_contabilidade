<?php
namespace App\Model\Empresa;

class ConsultaContaBancaria
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function getContaBancariaPadrao($empresasId)
    {
        $query = "SELECT
                    *
                FROM
                    contas_bancarias as c
                LEFT JOIN
                    bancos as b
                ON
                    c.bancos_cod = b.cod
                WHERE
                    empresas_id = :empresasId
                AND
                    c.conta_padrao = 'SIM'";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();

        while ($db = $sth->fetch(\PDO::FETCH_OBJ)) {
            $banco = new \App\Model\Empresa\Banco();
            $banco->setCod($db->bancos_cod);
            $banco->setNome($db->nome);

            $conta = new \App\Model\Empresa\ContaBancaria();
            $conta->setBanco($banco);
            $conta->setNumero($db->numero);
            $conta->setDigito($db->digito);
            $conta->setAgencia($db->agencia);
            $conta->setPessoa($db->pessoa);

            return $conta;
        }
    }
}