<?php
namespace App\DAO;

use App\Config\BancoConfig;
use App\Helper\Helpers;

class ProspectDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function deletaProspect($prospectsId)
    {
        $propostasId = $this->getPropostaId($prospectsId);

        if ($propostasId != null) {
            $query = "DELETE FROM propostas_medcontabil WHERE id = $propostasId;";
            if (\mysqli_query($this->conexao, $query) == false) {
                throw new \Exception("Erro ao deletar a proposta enviado ao prospect.", 1);
            }
        }        

        $query = "DELETE FROM prospects WHERE id = $prospectsId;";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao deletar o prospect", 1);
        }

        $query = "DELETE FROM prospects_emails WHERE prospects_id = $prospectsId;";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao deletar o email enviado ao prospect", 1);
        }
    }

    public function getPropostaId($prospectsId)
    {
        $query = "SELECT propostas_medcontabil_id FROM prospects_emails WHERE prospects_id = $prospectsId;";

        $retorno = \mysqli_query($this->conexao, $query);

        $linha = \mysqli_fetch_assoc($retorno);

        return $linha['propostas_medcontabil_id'];
    }

    public function prospectQuantidadePorUsuario($usuariosId)
    {
        $query = "SELECT count(id) as quantidade FROM prospects WHERE usuarios_id = $usuariosId;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function prospectQuantidadeAll()
    {
        $query = "SELECT count(id) as quantidade FROM prospects;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getProspectPorPeriodoFranqueado($dataInicio = '2019-02-19', $dataFim = '2019-02-20')
    {
        $query = "SELECT 
                    p.nome_doutor, p.nome_contato, p.nome_empresa, p.email, p.telefone, p.celular, p.cnpj, p.cidade, p.estado, p.profissao, 
                    p.especialidade, p.efetivado,  date(p.created_at), u.usuario 
                FROM 
                    prospects as p
                LEFT JOIN
                    usuarios as u
                ON
                    p.usuarios_id = u.id
                WHERE
                    date(p.created_at) >= '$dataInicio'
                AND
                    date(p.created_at) <= '$dataFim'
                AND 
                    p.empresa_vinculo = 'MEDCONTABIL'
                AND
                    (u.id = 1
                OR
                    u.id = 22);";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function updateProspect($attributes)
    {

        $celular = Helpers::formataTelefoneBd($attributes['celular']);
        $telefone = Helpers::formataTelefoneBd($attributes['telefone']);
        $cnpj = Helpers::formataCnpjBd($attributes['cnpj']);

        $query =
            "UPDATE
                prospects
            SET
                nome_doutor = '{$attributes['nome_doutor']}',
                nome_contato = '{$attributes['nome_contato']}',
                email = '{$attributes['email']}',
                telefone = '$telefone',
                celular = '$celular',
                nome_empresa = '{$attributes['nome_empresa']}',
                cnpj = '$cnpj',
                profissao = '{$attributes['profissao']}',
                especialidade = '{$attributes['especialidade']}'
            WHERE
                id = {$attributes['prospectId']};";

        return \mysqli_query($this->conexao, $query);
    }

    public function getPropostaMedcontabil($proposal)
    {
        $query = "SELECT
                    pe.usuarios_id, p.aos_cuidados, p.empresa_nome, p.mensalidade_faixa, p.socios, p.funcionarios, p.valor_total,
                    p.economia_total, p.total_atual, p.caminho_imagem, p.email_usuario, p.telefone_usuario, p.nome_usuario,
                    fe.logradouro, fe.numero, fe.bairro, fe.cidade, fe.uf, fe.complemento
                FROM
                    propostas_medcontabil as p
                LEFT JOIN
                    prospects_emails as pe
                ON
                    p.id = pe.propostas_medcontabil_id
                LEFT JOIN
                    franquias_usuarios as fu
                ON
                    fu.usuarios_id = pe.usuarios_id
                LEFT JOIN
                    franquias_enderecos as fe
                ON
                    fe.franquias_id = fu.franquias_id
                WHERE
                    p.proposal = '$proposal';";

        $retorno = \mysqli_query($this->conexao, $query);

        return \mysqli_fetch_assoc($retorno);
    }

    public function getProspectEmails($prospectId)
    {
        $query = "SELECT
                    p.created_at as enviadoAs, pm.proposal, pm.id, pm.aos_cuidados, pm.empresa_nome, pm.aceitou
                FROM
                    prospects_emails as p
                LEFT JOIN
                    propostas_medcontabil as pm
                ON
                    p.propostas_medcontabil_id = pm.id
                WHERE
                    p.prospects_id = $prospectId
                ORDER BY
                    enviadoAs DESC
                ;";

        $retorno = \mysqli_query($this->conexao, $query);
        $prospects = [];

        while ($prospect = \mysqli_fetch_assoc($retorno)) {
            $prospects [] = $prospect;
        }

        return $prospects;
    }

    public function isDadoExistente($cnpj)
    {
        $query = "SELECT $cnpj from prospects WHERE cnpj = '$cnpj';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getProspectProposta($id)
    {
        $query = "SELECT * FROM prospects WHERE id = $id;";
        $retorno = \mysqli_query($this->conexao, $query);

        return \mysqli_fetch_assoc($retorno);
    }

    public function all()
    {
        $query = "SELECT
                    p.id, p.nome_doutor, p.nome_contato, p.email, p.celular, u.usuario, p.cnpj, p.nome_empresa, p.profissao, p.sexo
                FROM
                    prospects as p
                LEFT JOIN
                    usuarios as u
                ON
                    p.usuarios_id = u.id
                WHERE
                    p.efetivado = 'NAO';";

        $retorno = \mysqli_query($this->conexao, $query);
        $prospects = [];

        while ($prospect = \mysqli_fetch_assoc($retorno)) {
            $prospects [] = $prospect;
        }

        return $prospects;
    }

    public function allPorUsuario($usuariosId)
    {
        $query = "SELECT
                    id, nome_doutor, nome_contato, email, celular, telefone, nome_empresa, cnpj, profissao, especialidade
                FROM
                    prospects
                WHERE
                    efetivado = 'NAO'
                AND
                    usuarios_id = $usuariosId;";

        $retorno = \mysqli_query($this->conexao, $query);
        $prospects = [];

        while ($prospect = \mysqli_fetch_assoc($retorno)) {
            $prospects [] = $prospect;
        }

        return $prospects;
    }

    public function insereDadosProspect($attributes)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $usuariosId = $attributes['usuariosId'];
        $nomeDoutor = ($attributes['nome_doutor'] == null) ? 'null' : "'" .$attributes['nome_doutor']. "'";
        $nomeContato = ($attributes['nome_contato'] == null) ? 'null' : "'" .$attributes['nome_contato']. "'";
        $email = ($attributes['email'] == null) ? 'null' : "'" .$attributes['email']. "'";
        $telefone = ($attributes['telefone'] == null) ? 'null' : "'" .$attributes['telefone']. "'";
        $celular = ($attributes['celular'] == null) ? 'null' : "'" .$attributes['celular']. "'";
        $whatsapp = ($attributes['whatsapp'] == null) ? 'null' : "'" .$attributes['whatsapp']. "'";
        $nomeEmpresa = ($attributes['nome_empresa'] == null) ? 'null' : "'" .$attributes['nome_empresa']. "'";
        $empresaVinculo = ($attributes['empresa_vinculo'] == null) ? 'null' : "'" .$attributes['empresa_vinculo']. "'";
        $cnpj = ($attributes['cnpj'] == null) ? 'null' : "'" .$attributes['cnpj']. "'";
        $profissao = ($attributes['profissao'] == null) ? 'null' : "'" .$attributes['profissao']. "'";
        $cidade = ($attributes['cidade'] == null) ? 'null' : "'" .$attributes['cidade']. "'";
        $estado = ($attributes['estado'] == null) ? 'null' : "'" .$attributes['estado']. "'";
        $especialidade = ($attributes['especialidade'] == null) ? 'null' : "'" .$attributes['especialidade']. "'";

        $query = "INSERT INTO prospects (
                    nome_doutor, nome_contato, email,
                    telefone, celular, whatsapp, nome_empresa, cnpj, cidade, estado, empresa_vinculo,
                    profissao, especialidade, usuarios_id, created_at
                ) VALUES (
                    $nomeDoutor,
                    $nomeContato,
                    $email,
                    $telefone,
                    $celular,
                    $whatsapp,
                    $nomeEmpresa,
                    $cnpj,
                    $cidade,
                    $estado,
                    $empresaVinculo,
                    $profissao,
                    $especialidade,
                    $usuariosId,
                    '$now'
                );";

        return mysqli_query($this->conexao, $query);
    }

    public function getQuantidadeProspects($usuariosId)
    {
        $query = "SELECT count(id) as quantidade FROM prospects WHERE usuarios_id = $usuariosId;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }
}
