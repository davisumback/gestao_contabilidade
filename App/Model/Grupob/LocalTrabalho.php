<?php
namespace App\Model;

class LocalTrabalho
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }
    public function save($attributes)
    {      
        $query = "INSERT INTO locais_trabalho(
                    estado, cidade, nome_local, contato, telefone, edital, validade
                ) VALUES (
                    :ufEndereco, :cidade, :nome_local, :contato, :fone, :edital, :validade
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':ufEndereco',  $attributes['ufEndereco'], \PDO::PARAM_STR);
        $sth->bindValue(':cidade',  $attributes['cidade'], \PDO::PARAM_STR);
        $sth->bindValue(':nome_local',  $attributes['nome_local'], \PDO::PARAM_STR);
        $sth->bindValue(':contato',  $attributes['contato'], \PDO::PARAM_STR);
        $sth->bindValue(':fone',  $attributes['fone'], \PDO::PARAM_STR);
        $sth->bindValue(':edital',  $attributes['edital'], \PDO::PARAM_STR);
        $sth->bindValue(':validade',  $attributes['validade'], \PDO::PARAM_STR);
        $sth->execute();
    }
    // public function edit($attributes)
    // {
    //     $query = "UPDATE ies 
    //             SET 
    //                 nome = :nome,
    //                 cidade = :cidade
    //             WHERE
    //                 id = :id";

    //         $sth = $this->conexao->prepare($query);
    //         $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
    //         $sth->bindValue(':cidade',  $attributes['cidade'], \PDO::PARAM_STR);
    //         $sth->bindValue(':id',  $attributes['id'], \PDO::PARAM_INT);
    //         $sth->execute();
    // }
    // public function delete($attributes)
    // {        
    //     $query = "DELETE FROM 
    //                 ies
    //             WHERE
    //                 id = :id";

    //     $sth = $this->conexao->prepare($query);
    //     $sth->bindValue(':id',  $attributes['id'], \PDO::PARAM_INT);
    //     $sth->execute();
    // }
    // public function getAll()
    // {
    //     $query = "SELECT * FROM ies;";

    //     $sth = $this->conexao->prepare($query);
    //     $sth->execute();

    //     return $sth->fetchAll(\PDO::FETCH_ASSOC);
    // }
}
