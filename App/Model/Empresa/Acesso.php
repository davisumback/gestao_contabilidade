<?php
namespace App\Model\Empresa;

use App\Config\BancoConfigPDO;

class Acesso
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfigPDO::conecta();
    }

    public function empresasSemAcesso()
    {
        $query = "SELECT
                    id, nome_empresa, cnpj
                FROM
                    empresas
                WHERE id NOT IN (SELECT empresas_id FROM empresas_acessos);";

        $sth = $this->conexao->prepare($query);        
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function save($attributes)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_acessos (
                    login, senha, site, empresas_id, created_at
                ) VALUES (
                    :login, :senha, :site, :empresas_id, :created_at
                );";    

        $sth = $this->conexao->prepare($query);        
        $sth->bindValue(':login', $attributes['login'], \PDO::PARAM_STR);
        $sth->bindValue(':senha', $attributes['senha'], \PDO::PARAM_STR);
        $sth->bindValue(':site', $attributes['site'], \PDO::PARAM_STR);
        $sth->bindValue(':empresas_id', $attributes['empresasId'], \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);
        $sth->execute();
    }
}