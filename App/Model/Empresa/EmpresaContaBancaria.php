<?php
namespace App\Model\Empresa;

class EmpresaContaBancaria
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function decideCategoriaConta($tipo)
    {
        switch ($tipo) {
            case 'PF':
                return 'P. Física';
                break;
            case 'PJ':
                return 'P. Jurídica';
                break;
        }
    }

    public function decideTipoConta($tipo)
    {
        switch ($tipo) {
            case 'C':
                return 'Conta Corrente';
                break;
            case 'P':
                return 'Poupança';
                break;
        }
    }

    public function save($attributes)
    {
        $banco = explode('-', $attributes['banco']);

        $this->isBancoCadastrado(trim($banco[1]));

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO contas_bancarias (
                    bancos_cod, empresas_id, numero, digito, agencia, tipo, pessoa, conta_padrao, created_at
                ) VALUES (
                    :bancoCod, :empresasId, :numero, :digito, :agencia, :tipo, :categoria, :contaPadrao, :createdAt
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':bancoCod', trim($banco[1]), \PDO::PARAM_INT);
        $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
        $sth->bindValue(':numero',  $attributes['conta'], \PDO::PARAM_INT);
        $sth->bindValue(':digito',  $attributes['digito'], \PDO::PARAM_INT);
        $sth->bindValue(':agencia',  $attributes['agencia'], \PDO::PARAM_INT);
        $sth->bindValue(':tipo',  $attributes['tipo'], \PDO::PARAM_STR);
        $sth->bindValue(':categoria',  $attributes['categoria'], \PDO::PARAM_STR);
        $sth->bindValue(':contaPadrao',  'SIM', \PDO::PARAM_STR);
        $sth->bindValue(':createdAt', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function saveNovaConta($attributes)
    {
        $banco = explode('-', $attributes['banco']);

        $this->isBancoCadastrado(trim($banco[1]));

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO contas_bancarias (
                    bancos_cod, empresas_id, numero, digito, agencia, tipo, pessoa, conta_padrao, created_at
                ) VALUES (
                    :bancoCod, :empresasId, :numero, :digito, :agencia, :tipo, :categoria, :contaPadrao, :createdAt
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':bancoCod', trim($banco[1]), \PDO::PARAM_INT);
        $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
        $sth->bindValue(':numero',  $attributes['conta'], \PDO::PARAM_INT);
        $sth->bindValue(':digito',  $attributes['digito'], \PDO::PARAM_INT);
        $sth->bindValue(':agencia',  $attributes['agencia'], \PDO::PARAM_INT);
        $sth->bindValue(':tipo',  $attributes['tipo'], \PDO::PARAM_STR);
        $sth->bindValue(':categoria',  $attributes['categoria'], \PDO::PARAM_STR);
        $sth->bindValue(':contaPadrao',  'NAO', \PDO::PARAM_STR);
        $sth->bindValue(':createdAt', $now, \PDO::PARAM_STR);
        $sth->execute();
    }

    public function setContaBancariaNaoPadrao($attributes)
    {
        $query = "UPDATE
                    contas_bancarias
                SET
                    conta_padrao = 'NAO'
                WHERE
                    empresas_id = :empresasId;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
        $sth->execute();
    }

    public function updateContaBancaria($attributes)
    {
        $this->setContaBancariaNaoPadrao($attributes);

        $query = "UPDATE
                    contas_bancarias
                SET
                    conta_padrao = 'SIM'
                WHERE
                    empresas_id = :empresasId
                AND
                    id = :id;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
        $sth->bindValue(':id', $attributes['contaBancariaId'], \PDO::PARAM_INT);
        $sth->execute();
    }

    public function delete($attributes)
    {
        $query = "DELETE FROM
                    contas_bancarias
                WHERE
                    id = :id
                AND
                    conta_padrao = 'NAO';";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id', $attributes['contaEmpresaId'], \PDO::PARAM_INT);
        $sth->execute();

        if ($sth->rowCount() == 0) {
            throw new \Exception ("Conta padrão não pode ser apagada!", 1);
        }
    }


    public function isBancoCadastrado($codigo)
    {
        $query = "SELECT
                    *
                FROM
                    bancos
                WHERE
                    cod = :codigo";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':codigo', $codigo, \PDO::PARAM_INT);
        $sth->execute();

        if (empty($sth->fetchAll(\PDO::FETCH_ASSOC))) {
            throw new \Exception("Não encontramos o seu banco em nossa base de dados!", 1);
        }
    }

    public function getBancos()
    {
        $query = "SELECT
                    nome, cod
                FROM
                    bancos;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getEmpresasSemConta()
    {
        $query = "SELECT
                    id, nome_empresa
                FROM
                    empresas
                WHERE
                    id NOT IN (SELECT empresas_id FROM contas_bancarias WHERE empresas_Id IS NOT NULL);";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getContasBancarias($empresasId)
    {
        $query = "SELECT
                    cb.id, b.nome, b.cod, cb.numero, cb.digito, cb.agencia, cb.tipo, cb.pessoa, c.nome_completo, cb.conta_padrao
                FROM
                    contas_bancarias as cb
                LEFT JOIN
                    bancos as b
                ON
                    cb.bancos_cod = b.cod
                LEFT JOIN
                    clientes as c
                ON
                    cb.clientes_id = c.id
                WHERE
                    cb.empresas_id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}
