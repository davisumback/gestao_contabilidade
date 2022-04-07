<?php
namespace App\Model\Prospect;

use App\Config\BancoConfigPDO;

class Prospect
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfigPDO::conecta();
    }

    public function prospectsSemSexo()
    {
        $query = "SELECT
                    id, nome_doutor, nome_contato, email, celular, telefone, nome_empresa, cnpj, 
                    profissao, especialidade, sexo
                FROM
                    prospects
                WHERE
                    efetivado = 'NAO'
                AND
                    sexo IS NULL;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allProspects()
    {
        $query = "SELECT
                    id, nome_doutor, nome_contato, email, celular, telefone, nome_empresa, cnpj, profissao, 
                    ano_formacao, especialidade, sexo, usuarios_id
                FROM
                    prospects
                WHERE
                    efetivado = 'NAO'
                ;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function allPorUsuario($usuariosId)
    {
        $query = "SELECT
                    id, nome_doutor, nome_contato, email, celular, telefone, nome_empresa, cnpj, 
                    profissao, ano_formacao, especialidade, sexo
                FROM
                    prospects
                WHERE
                    efetivado = 'NAO'
                AND
                    usuarios_id = $usuariosId;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function save($attributes)
    {
        // $cnpj = new \App\Model\ValueObject\Cnpj($attributes['cnpj']);
        // $attributes['cnpj'] = $cnpj->getCnpj();

        if ($attributes['anoFormacao'] != null) {
            $attributes['anoFormacao'] = '01/' . $attributes['anoFormacao'];
            $attributes['anoFormacao'] = \App\Helper\Helpers::formataDataBd($attributes['anoFormacao']);
        }
        
        $attributes['cnpj'] = \App\Helper\Helpers::formataCnpjBd($attributes['cnpj']);
        $attributes['celular'] = \App\Helper\Helpers::formataTelefoneBd($attributes['celular']);
        $attributes['telefone'] = \App\Helper\Helpers::formataTelefoneBd($attributes['telefone']);

        $whatsapp = 'SIM';

        if (! array_key_exists('whatsapp', $attributes)) {
            $whatsapp = 'NAO';
        }

        $attributes['WhatsApp'] = $whatsapp;

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO prospects (
                    nome_doutor, nome_contato, email,
                    telefone, celular, whatsapp, nome_empresa, cnpj, cidade, estado, empresa_vinculo,
                    profissao, ano_formacao, ies, especialidade, sexo, usuarios_id, created_at
                ) VALUES (
                    NULLIF(:nome_doutor, ''), NULLIF(:nome_contato, ''), NULLIF(:email, ''),
                    NULLIF(:telefone, ''), NULLIF(:celular, ''), :whatsapp, NULLIF(:nome_empresa, ''),
                    NULLIF(:cnpj, ''), :cidade, :estado, :empresa_vinculo,
                    :profissao, NULLIF(:anoFormacao, ''), NULLIF(:ies, ''), NULLIF(:especialidade, ''), :sexo, :usuarios_id, :created_at
                );";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':nome_doutor', $attributes['nome_doutor'], \PDO::PARAM_STR);
        $sth->bindValue(':nome_contato', $attributes['nome_contato'], \PDO::PARAM_STR);
        $sth->bindValue(':email', $attributes['email'], \PDO::PARAM_STR);
        $sth->bindValue(':telefone', $attributes['telefone'], \PDO::PARAM_STR);
        $sth->bindValue(':celular', $attributes['celular'], \PDO::PARAM_STR);
        $sth->bindValue(':whatsapp', $attributes['WhatsApp'], \PDO::PARAM_BOOL);
        $sth->bindValue(':nome_empresa', $attributes['nome_empresa'], \PDO::PARAM_STR);
        $sth->bindValue(':cnpj', $attributes['cnpj'], \PDO::PARAM_STR);
        $sth->bindValue(':cidade', $attributes['cidade'], \PDO::PARAM_STR);
        $sth->bindValue(':estado', $attributes['estado'], \PDO::PARAM_STR);
        $sth->bindValue(':empresa_vinculo', $attributes['empresa_vinculo'], \PDO::PARAM_STR);
        $sth->bindValue(':profissao', $attributes['profissao'], \PDO::PARAM_STR);
        $sth->bindValue(':anoFormacao', $attributes['anoFormacao'], \PDO::PARAM_STR);
        $sth->bindValue(':ies', $attributes['ies'], \PDO::PARAM_STR);
        $sth->bindValue(':especialidade', $attributes['especialidade'], \PDO::PARAM_STR);
        $sth->bindValue(':sexo', $attributes['sexo'], \PDO::PARAM_STR);
        $sth->bindValue(':usuarios_id', $attributes['usuariosId'], \PDO::PARAM_STR);
        $sth->bindValue(':created_at', $now, \PDO::PARAM_STR);

        $sth->execute();
    }

    public function update($attributes)
    {
        // $cnpj = new \App\Model\ValueObject\Cnpj($attributes['cnpj']);
        // $attributes['cnpj'] = $cnpj->getCnpj();

        $attributes['cnpj'] = \App\Helper\Helpers::formataCnpjBd($attributes['cnpj']);
        $attributes['celular'] = \App\Helper\Helpers::formataTelefoneBd($attributes['celular']);
        $attributes['telefone'] = \App\Helper\Helpers::formataTelefoneBd($attributes['telefone']);

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE
                    prospects
                SET
                    nome_doutor = NULLIF(:nome_doutor, ''),
                    nome_contato = NULLIF(:nome_contato, ''),
                    email = NULLIF(:email, ''),
                    telefone = NULLIF(:telefone, ''),
                    celular = NULLIF(:celular, ''),
                    nome_empresa = NULLIF(:nome_empresa, ''),
                    cnpj = NULLIF(:cnpj, ''),
                    profissao = :profissao,
                    especialidade = NULLIF(:especialidade, ''),
                    updated_at = :updated_at
                WHERE
                    id = :prospectId
                ;";

        $sth = $this->conexao->prepare($query);

        $sth->bindValue(':nome_doutor', $attributes['nome_doutor'], \PDO::PARAM_STR);
        $sth->bindValue(':nome_contato', $attributes['nome_contato'], \PDO::PARAM_STR);
        $sth->bindValue(':email', $attributes['email'], \PDO::PARAM_STR);
        $sth->bindValue(':telefone', $attributes['telefone'], \PDO::PARAM_STR);
        $sth->bindValue(':celular', $attributes['celular'], \PDO::PARAM_STR);
        $sth->bindValue(':nome_empresa', $attributes['nome_empresa'], \PDO::PARAM_STR);
        $sth->bindValue(':cnpj', $attributes['cnpj'], \PDO::PARAM_STR);
        $sth->bindValue(':profissao', $attributes['profissao'], \PDO::PARAM_STR);
        $sth->bindValue(':especialidade', $attributes['especialidade'], \PDO::PARAM_STR);
        $sth->bindValue(':updated_at', $now, \PDO::PARAM_STR);
        $sth->bindValue(':prospectId', $attributes['prospectId'], \PDO::PARAM_INT);
        $sth->execute();

        
        $sth->debugDumpParams();
    }

    public function updateSexo($attributes)
    {
        // $cnpj = new \App\Model\ValueObject\Cnpj($attributes['cnpj']);
        // $attributes['cnpj'] = $cnpj->getCnpj();

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE
                    prospects
                SET
                    sexo = :sexo,
                    updated_at = :updated_at
                WHERE
                    id = :prospectId
                ;";

        $sth = $this->conexao->prepare($query);

        $sth->bindValue(':sexo', $attributes['sexo'], \PDO::PARAM_STR);
        $sth->bindValue(':updated_at', $now, \PDO::PARAM_STR);
        $sth->bindValue(':prospectId', $attributes['prospectId'], \PDO::PARAM_INT);

        $sth->execute();
    }

    public function delete($attributes)
    {
        $query = "DELETE FROM
                    prospects
                WHERE
                    id = :id
                ;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':id', $attributes['prospectId'], \PDO::PARAM_INT);
        $sth->execute();
    }
}
