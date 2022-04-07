<?php
namespace App\Model\Empresa;

class Funcionario
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function edit($attributes)
    {
        $attributes['salario'] = \App\Helper\Helpers::formataMoedaBd($attributes['salario']);

        $query = "UPDATE funcionarios 
                SET 
                    salario = :salario
                WHERE
                    id = :id";

            $sth = $this->conexao->prepare($query);
            $sth->bindValue(':salario',  $attributes['salario'], \PDO::PARAM_STR);
            $sth->bindValue(':id',  $attributes['funcionariosId'], \PDO::PARAM_INT);

            $sth->execute();
    }

    public function delete($attributes)
    {        
        $query = "DELETE FROM 
                    funcionarios
                WHERE
                    id = :id";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id',  $attributes['funcioarioId'], \PDO::PARAM_INT);

        $sth->execute();
    }

    public function save($attributes)
    {        
        new \App\Model\ValueObject\Cpf($attributes['cpf']);

        $attributes['cpf'] = \App\Helper\Helpers::formataCpfBd($attributes['cpf']);
        $this->isFuncionario($attributes['cpf']);

        $attributes['salario'] = \App\Helper\Helpers::formataMoedaBd($attributes['salario']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');
        
        $query = "INSERT INTO funcionarios (
                    empresas_id, nome, cpf, salario, created_at
                ) VALUES (
                    :idEmpresa, :nome, :cpf, :salario, :agora
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':idEmpresa',  $attributes['idEmpresa'], \PDO::PARAM_INT);
        $sth->bindValue(':nome',  $attributes['nome'], \PDO::PARAM_STR);
        $sth->bindValue(':cpf',  $attributes['cpf'], \PDO::PARAM_STR);
        $sth->bindValue(':salario',  $attributes['salario'], \PDO::PARAM_STR);
        $sth->bindValue(':agora',  $now, \PDO::PARAM_STR);

        $sth->execute();
    }

    public function isFuncionario($cpf)
    {
        $query = "SELECT cpf from funcionarios WHERE cpf = :cpf;";
        $sth = $this->conexao->prepare($query);        
        $sth->bindValue(':cpf',  $cpf, \PDO::PARAM_STR);

        $sth->execute();

        if (! empty($sth->fetchAll(\PDO::FETCH_ASSOC))) {
            throw new \Exception("Funcionário já cadastrado!", 1);            
        }
    }

    public function getFuncionariosEmpresa($empresasId)
    {
        $query = "SELECT 
                    id, nome, cpf, salario
                FROM 
                    funcionarios                    
                WHERE
                    empresas_id = :empresasId";

        $sth = $this->conexao->prepare($query);        
        $sth->bindValue(':empresasId',  $empresasId, \PDO::PARAM_INT);

        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
