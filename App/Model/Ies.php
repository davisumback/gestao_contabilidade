<?php
namespace App\Model;

class Ies
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function edit($attributes)
    {
        $query = "UPDATE ies 
                SET 
                    nome = :nome,
                    cidade = :cidade
                WHERE
                    id = :id";

            $sth = $this->conexao->prepare($query);
            $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
            $sth->bindValue(':cidade',  $attributes['cidade'], \PDO::PARAM_STR);
            $sth->bindValue(':id',  $attributes['id'], \PDO::PARAM_INT);

            $sth->execute();
    }

    public function delete($attributes)
    {        
        $query = "DELETE FROM 
                    ies
                WHERE
                    id = :id";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id',  $attributes['id'], \PDO::PARAM_INT);

        $sth->execute();
    }

    public function save($attributes)
    {        
        
        $query = "INSERT INTO ies   (
                    nome, cidade
                ) VALUES (
                    :nome, :cidade
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
        $sth->bindValue(':cidade',  $attributes['cidade'], \PDO::PARAM_STR);

        $sth->execute();
    }

    public function getAll()
    {
        $query = "SELECT * FROM ies;";

        $sth = $this->conexao->prepare($query);

        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
