<?php
namespace App\Model\Grupob;

class Setor
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
                    grupob_setores;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();
        
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}