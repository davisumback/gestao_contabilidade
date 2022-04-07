<?php
namespace App\Model\Empresa;

class ConsultaCodigoServico
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function all()
    {
        $query = "SELECT
                    *
                FROM
                    codigos_servicos;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        $codigos = [];

        while ($db = $sth->fetch(\PDO::FETCH_OBJ)) {
            $codigo = new \App\Model\Empresa\CodigoServico();
            $codigo->setId($db->id);
            $codigo->setCodigoServico($db->codigo_servico);
            $codigo->setNome($db->nome);
            $codigos[] = $codigo;
        }

        return $codigos;        
    }
}