<?php
namespace App\Model;

class Contato
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function edit($attributes)
    {
        $attributes['telefone'] = \App\Helper\Helpers::formataTelefoneBd($attributes['telefone']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE contatos
                SET 
                    nome = :nome,
                    email = :email,
                    telefone = :telefone,
                    updated_at = :updated_at,
                    usuarios_id = :id_usuario
                WHERE
                    id = :id";

            $sth = $this->conexao->prepare($query);
            $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
            $sth->bindValue(':email',  $attributes['email'], \PDO::PARAM_STR);
            $sth->bindValue(':telefone',  $attributes['telefone'], \PDO::PARAM_STR);
            $sth->bindValue(':id',  $attributes['id'], \PDO::PARAM_INT);
            $sth->bindValue(':id_usuario',  $attributes['id-usuario'], \PDO::PARAM_STR);
            $sth->bindValue(':updated_at', $now, \PDO::PARAM_STR);
            $sth->execute();
    }

    public function delete($attributes)
    {        
        $query = "DELETE FROM 
                    contatos
                WHERE
                    id = :id";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id',  $attributes['id'], \PDO::PARAM_INT);

        $sth->execute();
    }

    public function save($attributes)
    {
        $attributes['telefone'] = \App\Helper\Helpers::formataTelefoneBd($attributes['telefone']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');
        
        $query = "INSERT INTO contatos   (
                    nome, email, telefone, created_at, usuarios_id
                ) VALUES (
                    :nome, :email, :telefone, :created_at, :id_usuario
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
        $sth->bindValue(':email',  $attributes['email'], \PDO::PARAM_STR);
        $sth->bindValue(':telefone',  $attributes['telefone'], \PDO::PARAM_STR);
        $sth->bindValue(':id_usuario',  $attributes['id-usuario'], \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);

        $sth->execute();
    }

    public function getContatosUsuario($user)
    {
        $query = "SELECT * FROM contatos WHERE usuarios_id = :id_usuario;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id_usuario',  $user, \PDO::PARAM_STR);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAll()
    {
        $query = "SELECT * FROM contatos;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
