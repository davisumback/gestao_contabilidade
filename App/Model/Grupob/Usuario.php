<?php
namespace App\Model\Grupob;

class Usuario
{
    private $conexao;
    private $id;
    private $usuario;
    private $nomeCompleto;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function getNomeUsuario($id)
    {
        $query = "SELECT
                    nome_completo
                FROM
                    usuarios
                WHERE
                    id = :id;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $retorno[0]['nome_completo'];
    }
}