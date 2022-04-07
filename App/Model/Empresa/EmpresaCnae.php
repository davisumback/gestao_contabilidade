<?php
namespace App\Model\Empresa;

class EmpresaCnae
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function getCnaeCadastrados($empresasId)
    {
        $query = "SELECT
                    id, empresas_id, cnae, descricao, principal
                FROM
                    empresas_cnaes 
                WHERE
                    empresas_id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getEmpresasSemCnae()
    {
        $query = "SELECT
                    id, nome_empresa
                FROM
                    empresas
                WHERE
                    id NOT IN (SELECT empresas_id FROM empresas_cnaes WHERE empresas_Id IS NOT NULL);";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function save($attributes)
    {
        $attributes['cnae'] = \App\Helper\Helpers::formataCnaeBd($attributes['cnae']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_cnaes (
                    empresas_id, cnae, descricao, principal, created_at
                ) VALUES (
                    :empresasId, :cnae, :descricao, :principal, :createdAt
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
        $sth->bindValue(':cnae',  $attributes['cnae'], \PDO::PARAM_STR);
        $sth->bindValue(':descricao',  $attributes['descricao'], \PDO::PARAM_STR);
        $sth->bindValue(':principal',  $attributes['principal'], \PDO::PARAM_STR);
        $sth->bindValue(':createdAt', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function update($attributes)
    {
        $attributes['cnae'] = \App\Helper\Helpers::formataCnaeBd($attributes['cnae']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE
                    empresas_cnaes
                SET                    
                    cnae = :cnae,
                    descricao = :descricao,
                    updated_at = :updatedAt
                WHERE
                    empresas_id = :empresasId
                AND
                    id = :id;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id', $attributes['id'], \PDO::PARAM_INT);
        $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
        $sth->bindValue(':cnae',  $attributes['cnae'], \PDO::PARAM_STR);
        $sth->bindValue(':descricao',  $attributes['descricao'], \PDO::PARAM_STR);
        $sth->bindValue(':updatedAt', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function delete($attributes)
    {
        $query = "DELETE FROM
                    empresas_cnaes
                WHERE
                    id = :id
                AND
                    principal = 'NAO';";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id', $attributes['id'], \PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount() == 0) {
            throw new \Exception ("CNAE padrão não pode ser apagada!", 1);
        }
    }
}