<?php
namespace App\Model\Empresa;

use App\Config\BancoConfigPDO;

class Empresa
{
    private $id;
    private $conexao;
    private $inscricaoMunicipal;

    public function __construct()
    {
        $this->conexao = BancoConfigPDO::conecta();
    }

    public function isEmailGuiaEnviado($empresasId, $competencia)
    {
        $query = "SELECT 
                    COUNT(id) as quantidade
                FROM
                    empresas_emails_guias
                WHERE
                    empresas_id = :empresasId
                AND
                    data_competencia = :dataCompetencia
                AND 
                    email_enviado = 1";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->bindValue(':dataCompetencia', $competencia, \PDO::PARAM_STR);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if ($retorno[0]['quantidade'] == 0) {
            throw new \Exception("Ainda não foi enviado as guias dessa Empresa", 1);
        }

        return $retorno;
    }

    public function getAcesso($empresasId)
    {
        $query = "SELECT
                    login, senha
                FROM
                    empresas_acessos
                WHERE
                    empresas_id = :empresasId;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($retorno)) {
            throw new \Exception("Empresa sem acesso cadastrado!", 1);
        }

        return $retorno[0];
    }

    public function getCnaePrincipal($empresasId)
    {
        $query = "SELECT
                    cnae
                FROM
                    empresas_cnaes
                WHERE
                    empresas_id = :empresasId
                AND
                    principal = 'SIM';";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($retorno)) {
            throw new \Exception("Empresa sem CNAE principal cadastrado!", 1);
        }

        return $retorno[0]['cnae'];
    }

    public function getRegimeTributario($empresasId)
    {
        $query = "SELECT
                    regime_tributario
                FROM
                    empresas
                WHERE
                    id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if ($retorno[0]['regime_tributario'] == null) {
            throw new \Exception("Empresa sem Regime Tributário cadastrado!", 1);
        }

        return $retorno[0]['regime_tributario'];
    }

    public function getInscricaoMunicipal($empresasId)
    {
        $query = "SELECT
                    inscricao_municipal
                FROM
                    empresas
                WHERE
                    id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if ($retorno[0]['inscricao_municipal'] == null) {
            throw new \Exception("Empresa sem Inscrição Municipal cadastrada!", 1);
        }

        return $retorno[0]['inscricao_municipal'];
    }

    public function getCertificadoId($empresasId)
    {
        $query = "SELECT
                    *
                FROM
                    empresas_certificados
                WHERE
                    empresas_id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($retorno)) {
            throw new \Exception("Empresa sem certificado cadastrado!", 1);
        }

        return $retorno[0]['id_integracao'];
    }

    public function getEndereco($empresasId)
    {
        $query = "SELECT
                    *
                FROM
                    endereco_empresa
                WHERE
                    empresas_id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($retorno)) {
            throw new \Exception("Empresa sem endereço cadastrado!", 1);
        }

        return $retorno[0];
    }

    public function getCnpjRazaoSocial($empresasId)
    {
        $query = "SELECT
                    cnpj, nome_empresa as razaoSocial
                FROM
                    empresas
                WHERE
                    id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $retorno[0];
    }

    public function empresaPlanos($empresasId)
    {
        $query = "SELECT
                    SUM(p.valor) as valor
                FROM
                    empresas_planos as empp
                LEFT JOIN
                    empresas as emp
                ON
                    empp.empresas_id = emp.id
                LEFT JOIN
                    planos as p
                ON
                    empp.planos_id = p.id
                WHERE
                    emp.id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $retorno[0]['valor'];
    }

    public function getDadosEmpresaMedcontabil($empresasId)
    {
        $query = "SELECT
                    emp.tipo_societario, emp.nome_empresa, emp.cnpj, emp.id, emp.regime_tributario, eu.data_cadastro, us.usuario,
                    cli.nome_completo, cli.socio_administrador, cli.cpf, cli.email, cli.data_nascimento, cli.crm, cli.telefone_celular,
                    cli.telefone_comercial, cli.estado_civil, cli.regime_casamento, cli.profissao, en.iptu, en.cep, en.logradouro,
                    en.numero, en.bairro, en.cidade, en.uf as endereco_uf, en.complemento, con.dia_vencimento, con.primeira_mensalidade,
                    doc.numero as doc_numero, doc.data_emissao, doc.orgao_expedidor, doc.naturalidade, doc.validade, doc.tipo_documento, doc.uf as doc_uf,
                    ies.nome as ies_nome, ies.cidade as ies_cidade, cliemp.porcentagem_societaria
                FROM
                    empresas AS emp
                LEFT JOIN
                    empresas_usuarios AS eu
                ON
                    eu.empresas_id = emp.id
                LEFT JOIN
                    usuarios AS us
                ON
                    eu.usuarios_id = us.id
                LEFT JOIN
                    clientes_empresas AS cliemp
                ON
                    cliemp.empresas_id = emp.id
                LEFT JOIN
                    clientes AS cli
                ON
                    cli.id = cliemp.clientes_id
                LEFT JOIN
                    endereco_empresa AS en
                ON
                    en.empresas_id = emp.id
                LEFT JOIN
                    contratos AS con
                ON
                    con.empresas_id = emp.id
                LEFT JOIN
                    documentos AS doc
                ON
                    doc.cliente_id = cli.id
                LEFT JOIN
                    ies
                ON
                    ies.id = cli.ies_id
                WHERE
                    emp.id = :empresasId
                ORDER BY cli.socio_administrador DESC;";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function save()
    {
        $query = "UPDATE empresas SET inscricao_municipal = :inscricaoMunicipal WHERE id = :id;";
        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':inscricaoMunicipal', $this->inscricaoMunicipal, \PDO::PARAM_STR);
        $sth->bindValue(':id', $this->id, \PDO::PARAM_INT);
        $sth->execute();
    }

    public function getEmpresasSemCadastroMunicipal()
    {
        $query = "SELECT id, nome_empresa FROM empresas WHERE inscricao_municipal IS NULL;";
        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function isEmpresa($empresasId)
    {
        $query = "SELECT
                    *
                FROM
                    empresas
                WHERE
                    id = :empresasId";

        $sth = $this->conexao->prepare($query);
        $sth->bindValue(':empresasId', $empresasId, \PDO::PARAM_INT);
        $sth->execute();
        $retorno = $sth->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($retorno)) {
            throw new \Exception("Empresa não encontrada!", 1);
        }

        return $retorno;
    }

    public function setInscricaoMunicipal($inscricaoMunicipal)
    {
        $this->inscricaoMunicipal = $inscricaoMunicipal;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmpresasSemAlvara()
    {
        $query = "SELECT 
                    emp.id, emp.nome_empresa 
                FROM
                    empresas as emp
                LEFT JOIN 
                    alvara as a
                ON
                    a.empresas_id = emp.id
                WHERE 
                    a.nome_arquivo IS NULL;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getQtdEmpresasSemAlvara()
    {
        $query = "SELECT
                    emp.id, emp.nome_empresa 
                FROM
                    empresas as emp
                LEFT JOIN 
                    alvara as a
                ON
                    a.empresas_id = emp.id
                WHERE 
                    a.nome_arquivo IS NULL;";

        $sth = $this->conexao->prepare($query);
        $sth->execute();

        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
}