<?php

namespace App\Model\Usuario;

class Cliente
{
    private $conexao;
    private $id;
    private $email;
    private $cpf;
    private $senha;
    private $vinculo;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function isLogin()
    {
        $query = "SELECT 
                    c.id, c.cpf, c.nome_completo, c.email, tu.pasta, e.id as empresasId, e.regime_tributario
                FROM                
                    clientes as c
                LEFT JOIN
                    tipo_usuario as tu
                ON
                    c.tipo_usuario_id = tu.id
                LEFT JOIN
                    clientes_empresas as ce
                ON
                    c.id = ce.clientes_id
                LEFT JOIN
                    empresas as e
                ON
                    ce.empresas_id = e.id
                WHERE
                    c.cpf = :cpf
                AND
                    c.senha = :senha
                AND
                    e.vinculo = :vinculo
                AND
                    c.ativo = 1;";
                    
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':cpf', $this->cpf, \PDO::PARAM_STR);
        $stmt->bindParam(':senha', $this->senha, \PDO::PARAM_STR);
        $stmt->bindParam(':vinculo', $this->vinculo, \PDO::PARAM_STR);

        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $resultado = $stmt->fetch();

        if (! $resultado) {
            throw new \Exception("Erro! Usuário ou senha incorreto.", 1);
        }

        return $resultado;
    }

    public function getClientesSemEmail()
    {
        $query = "SELECT 
                    c.id as clientesId, c.nome_completo, c.sexo, e.nome_empresa
                FROM 
                    clientes as c
                LEFT JOIN
                    clientes_empresas as ce
                ON
                    ce.clientes_id = c.id
                LEFT JOIN
                    empresas as e
                ON
                    ce.empresas_id = e.id
                WHERE 
                    c.email = ''
                OR
                    c.email IS NULL;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function saveEmail()
    {
        $query = "UPDATE clientes SET email = :email WHERE id = :clientesId;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':email', $this->email, \PDO::PARAM_STR);
        $sth->bindValue(':clientesId', $this->id, \PDO::PARAM_INT);
        $sth->execute();
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = trim($email);
    }

    public function setCpf($cpf)
    {
        new \App\Model\ValueObject\Cpf($cpf);
        $this->cpf = \App\Helper\Helpers::formataCpfBd($cpf);
    }

    public function setSenha($senha)
    {
        if ($senha == null) {
            throw new \Exception("Error! Senha em branco", 1);            
        }
        $this->senha = md5($senha);
    }

    public function setVinculo($vinculo)
    {
        $this->vinculo = $vinculo;
    }
}