<?php
namespace App\Model\Grupob;

class Desconto
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function edit($attributes)
    {
        $attributes['valor'] = \App\Helper\Helpers::formataMoedaBd($attributes['valor']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE descontos
                SET 
                    nome = :nome,
                    valor = :valor,
                    updated_at = :updated_at
                WHERE
                    id = :id";

            $sth = $this->conexao->prepare($query);
            $sth->bindValue(':nome', $attributes['nome'], \PDO::PARAM_STR);
            $sth->bindValue(':valor', $attributes['valor'], \PDO::PARAM_STR);
            $sth->bindValue(':id',  $attributes['id'], \PDO::PARAM_INT);
            $sth->bindValue(':updated_at', $now, \PDO::PARAM_STR);

            $sth->execute();
    }

    public function delete($attributes)
    {        
        $query = "DELETE FROM 
                    descontos
                WHERE
                    id = :id";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id',  $attributes['id'], \PDO::PARAM_INT);

        $sth->execute();
    }

    public function save($attributes)
    {        
        $attributes['valor'] = \App\Helper\Helpers::formataMoedaBd($attributes['valor']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');
        
        $query = "INSERT INTO descontos   (
                    nome, valor, created_at
                ) VALUES (
                    :nome, :valor, :created_at
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
        $sth->bindValue(':valor', $attributes['valor'], \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);

        $sth->execute();
    }

    public function getAll()
    {
        $query = "SELECT * FROM descontos;";

        $sth = $this->conexao->prepare($query);

        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
