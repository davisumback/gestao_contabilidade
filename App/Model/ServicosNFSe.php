<?php
namespace App\Model;

class ServicosNFSe
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function getAll()
    {
        $query = "SELECT * FROM codigos_servicos;";

        $sth = $this->conexao->prepare($query);

        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function save($attributes)
    {   
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');
        
        $query = "INSERT INTO codigos_servicos (
                    codigo_servico, nome, created_at
                ) VALUES (
                    :codigo_servico, :nome, :created_at 
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':codigo_servico',  $attributes['cod-servico'], \PDO::PARAM_STR);
        $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function edit($attributes)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE codigos_servicos 
                SET 
                    codigo_servico = :cod_servico,
                    nome = :nome,
                    updated_at = :updated_at
                WHERE
                    id = :id;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id',  $attributes['servicoId'], \PDO::PARAM_INT);
        $sth->bindValue(':cod_servico',  $attributes['cod-servico'], \PDO::PARAM_STR);
        $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
        $sth->bindValue(':updated_at', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function delete($attributes)
    {       
        $query = "DELETE FROM 
                    codigos_servicos
                WHERE
                    id = :id;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id',  $attributes['servicoId'], \PDO::PARAM_INT);
        $sth->execute();
    }   
}
