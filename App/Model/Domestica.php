<?php
namespace App\Model;

class Domestica
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = \App\Config\BancoConfigPDO::conecta();
    }

    public function save($attributes)
    {
        $attributes['cpfResponsavel'] = \App\Helper\Helpers::formataCpfBd($attributes['cpfResponsavel']);
        $attributes['cpf'] = \App\Helper\Helpers::formataCpfBd($attributes['cpf']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO domesticas (
                    responsaveis_domesticas_cpf, nome, cpf, cep, logradouro, numero, bairro, cidade, uf, complemento, created_at
                ) VALUES (
                    :nome, :cpf, :cep, :logradouro, :numeroEndereco, :bairro,
                    :cidade, :ufEndereco, NULLIF(:complemento, ''), :createdAt
                );";

        $sth = $this->conexao->prepare($query);
        // $sth->bindValue(':cpfCliente', $attributes['cpfCliente'], \PDO::PARAM_STR);
        $sth->bindValue(':responsaveis_domesticas_cpf', $attributes['cpfResponsavel'], \PDO::PARAM_STR);
        $sth->bindValue(':nome', $attributes['nome'], \PDO::PARAM_STR);
        $sth->bindValue(':cpf', $attributes['cpf'], \PDO::PARAM_STR);
        $sth->bindValue(':cep', $attributes['cep'], \PDO::PARAM_STR);
        $sth->bindValue(':logradouro', $attributes['logradouro'], \PDO::PARAM_STR);
        $sth->bindValue(':numeroEndereco', $attributes['numeroEndereco'], \PDO::PARAM_STR);
        $sth->bindValue(':bairro', $attributes['bairro'], \PDO::PARAM_STR);
        $sth->bindValue(':cidade', $attributes['cidade'], \PDO::PARAM_STR);
        $sth->bindValue(':ufEndereco', $attributes['ufEndereco'], \PDO::PARAM_STR);
        $sth->bindValue(':complemento', $attributes['complemento'], \PDO::PARAM_STR);
        $sth->bindValue(':createdAt', $now, \PDO::PARAM_STR);
        $sth->execute();


        $queryAlt = "INSERT INTO responsaveis_domesticas (
            nome_completo, cpf, cep, logradouro, numero, bairro, cidade, uf, complemento, created_at
        ) VALUES (
            :nome, :cpf, :cep, :logradouro, :numeroEndereco, :bairro,
            :cidade, :ufEndereco, NULLIF(:complemento, ''), :createdAt
        );";

        $sthAlt = $this->conexao->prepare($queryAlt);
        $sthAlt->bindValue(':nome', $attributes['nomeResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':cpf', $attributes['cpfResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':cep', $attributes['cepResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':logradouro', $attributes['logradouroResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':numeroEndereco', $attributes['numeroEnderecoResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':bairro', $attributes['bairroResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':cidade', $attributes['cidadeResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':ufEndereco', $attributes['ufEnderecoResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':complemento', $attributes['complementoResponsavel'], \PDO::PARAM_STR);
        $sthAlt->bindValue(':createdAt', $now, \PDO::PARAM_STR);
        $sthAlt->execute();
    }

    // public function update($attributes)
    // {
    //     $this->setContaBancariaNaoPadrao($attributes);

    //     $query = "UPDATE
    //                 contas_bancarias
    //             SET
    //                 conta_padrao = 'SIM'
    //             WHERE
    //                 empresas_id = :empresasId
    //             AND
    //                 id = :id;";

    //     $sth = $this->conexao->prepare($query);
    //     $sth->bindValue(':empresasId', $attributes['empresasId'], \PDO::PARAM_INT);
    //     $sth->bindValue(':id', $attributes['contaBancariaId'], \PDO::PARAM_INT);
    //     $sth->execute();
    // }

    // public function delete($attributes)
    // {
    //     $query = "DELETE FROM
    //                 contas_bancarias
    //             WHERE
    //                 id = :id
    //             AND
    //                 conta_padrao = 'NAO';";

    //     $sth = $this->conexao->prepare($query);
    //     $sth->bindValue(':id', $attributes['contaEmpresaId'], \PDO::PARAM_INT);
    //     $sth->execute();

    //     if ($sth->rowCount() == 0) {
    //         throw new \Exception ("Conta padrão não pode ser apagada!", 1);
    //     }
    // }
}
