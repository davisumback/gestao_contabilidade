<?php
namespace App\DAO;

use App\Entidade\Empresa;
use App\Config\BancoConfig;
use App\Helper\Helpers;

class EmpresaDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function desativaEmpresa($empresasId)
    {
        $query = "UPDATE
                        empresas
                    SET
                        saiu = 1
                    WHERE
                        id = $empresasId;";

        $resultado = mysqli_query($this->conexao, $query);

        if ($resultado == false) {
            throw new \Exception("Erro ao desativar a empresa", 1);
        }
    }

    public function getEmpresasCadastroTecnospeed()
    {
        $query = "SELECT cnpj FROM empresas;";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = [];

        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function getEmpresaAliquota($empresasId, $dataCompetencia)
    {
        $query = "SELECT * FROM empresas_aliquotas WHERE empresas_id = $empresasId AND data_competencia = '$dataCompetencia';";
        $retorno = \mysqli_query($this->conexao, $query);

        return \mysqli_fetch_assoc($retorno);
    }

    public function insereEmpresaAliquota(\App\Model\Empresa\EmpresaAliquota $empresaAliquota)
    {
        if ($this->isAliquota($empresaAliquota) != null) {
            return;
        }

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_aliquotas (
            empresas_id, aliquota, fator_r, data_competencia, created_at
        ) VALUES (
            {$empresaAliquota->getEmpresaId()}, {$empresaAliquota->getAliquota()}, {$empresaAliquota->getFatorR()}, '{$empresaAliquota->getDataCompetencia()}', '$now'
        );";

        return \mysqli_query($this->conexao, $query);
    }

    public function isAliquota(\App\Model\Empresa\EmpresaAliquota $empresaAliquota)
    {
        $query = "SELECT * FROM empresas_aliquotas WHERE empresas_id = {$empresaAliquota->getEmpresaId()} AND data_competencia = '{$empresaAliquota->getDataCompetencia()}';";
        $retorno = \mysqli_query($this->conexao, $query);

        return \mysqli_fetch_assoc($retorno);
    }

    public function insereDeclaracaoEmpresa($empresasId, $declaracaoTipo, $nomeArquivo)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO empresas_declaracoes (
            empresas_id, declaracoes_tipos, created_at, nome_arquivo
        ) VALUES (
            $empresasId, $declaracaoTipo, '$now', '$nomeArquivo'
        );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar os dados da Declaração de Rendimentos.", 1);
        }
    }

    public function getSocios($empresasId)
    {
        $query = "SELECT
                    c.id, c.nome_completo, ce.socio_administrador
                FROM
                    clientes_empresas as ce
                LEFT JOIN
                    clientes as c
                ON
                    ce.clientes_id = c.id
                WHERE
                    ce.empresas_id = $empresasId;";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = [];

        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function getEmpresasId()
    {
        $query = "SELECT
                    id
                FROM
                    empresas;";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = [];

        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function isEmpresa($id)
    {
        $query = "SELECT id from empresas WHERE id = $id;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getProlabore($empresasId, $dataCompetencia)
    {
        $query = "SELECT prolabore, updated_at FROM empresas_prolabores WHERE empresas_id = $empresasId AND data_competencia = '$dataCompetencia';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function insereEmpresaLiberacao($empresasId, $dataCompetencia)
    {
        $query = "INSERT INTO empresas_liberacoes (empresas_id, data_competencia, created_at, liberada) VALUES ($empresasId, '$dataCompetencia', NOW(), 'SIM');";

        return mysqli_query($this->conexao, $query);
    }

    public function updateEmpresaProlabore($empresasId, $prolabore, $dataCompetencia)
    {
        $prolabore = Helpers::formataMoedaBd($prolabore);

        $query = "UPDATE
                        empresas_prolabores
                    SET
                        prolabore = $prolabore,
                        updated_at = NOW()
                    WHERE
                        data_competencia = '$dataCompetencia'
                    AND
                        empresas_id = $empresasId;";

        return mysqli_query($this->conexao, $query);
    }

    public function insereEmpresaProlabores($empresasId, $prolabore, $dataCompetencia)
    {
        $prolabore = Helpers::formataMoedaBd($prolabore);

        $query = "INSERT INTO
                        empresas_prolabores (
                            empresas_id, prolabore, data_competencia, created_at
                        ) VALUES (
                            $empresasId, $prolabore, '$dataCompetencia', NOW()
                        );";

        return mysqli_query($this->conexao, $query);
    }

    public function isEmpresaCadastrada($cnpj)
    {
        $query = "SELECT * FROM empresas WHERE cnpj = '$cnpj';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getEmpresasLiberacoesPendentes($dataCompetencia, $usuariosId)
    {
        $query = "SELECT
                    	e.id, e.nome_empresa
                    FROM
                    	empresas as e
                    LEFT JOIN
                        contadores_empresas as ce
                    ON
                        e.id = ce.empresas_id
                    WHERE
                    	e.regime_tributario = 'SN'
                    AND
                    	e.congelada = 0
                    AND
                        e.saiu = 0
                    AND
                        ce.usuarios_id = $usuariosId
                    AND
                    	e.id NOT IN (
                    		SELECT
                    			empresas_id
                    		FROM
                    			empresas_liberacoes
                    		WHERE
                    			data_competencia = '$dataCompetencia');";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getEmpresasLiberacoesPendentesComAliquotaEFatorRESocios($dataCompetencia)
    {
        $query = "SELECT
                    e.id, e.nome_empresa, ea.fator_r, c.nome_completo
                FROM
                    empresas as e
                LEFT JOIN
                    contadores_empresas as ce
                ON
                    e.id = ce.empresas_id
                LEFT JOIN
                    empresas_aliquotas as ea
                ON 
                    ea.empresas_id = e.id
                LEFT JOIN 
                    clientes_empresas as cle
                ON 
                    cle.empresas_id = e.id
                LEFT JOIN
                    clientes as c
                ON
                    c.id = cle.clientes_id                    
                WHERE
                    e.regime_tributario = 'SN'
                AND
                    e.congelada = 0
                AND
                    e.saiu = 0
                AND
                    ce.usuarios_id = 16
                AND
                    e.id NOT IN (
                        SELECT
                            empresas_id
                        FROM
                            empresas_liberacoes
                        WHERE
                            data_competencia = '2019-05-01');";

            $retorno = mysqli_query($this->conexao, $query);
            $empresaArray = array();
            
            while ($empresa = mysqli_fetch_assoc($retorno)) {
                $empresaArray[] = $empresa;
            }

        return $empresaArray;
    }

    public function getEmpresasLiberacoesPendentesAll($dataCompetencia)
    {
        $query = "SELECT
                    	e.id, e.nome_empresa, u.usuario
                    FROM
                    	empresas as e
                    LEFT JOIN
                        contadores_empresas as ce
                    ON
                        e.id = ce.empresas_id
                    LEFT JOIN
                        usuarios as u
                    ON
                        u.id = ce.usuarios_id
                    WHERE
                    	e.regime_tributario = 'SN'
                    AND
                    	e.congelada = 0
                    AND
                        e.saiu = 0
                    AND
                    	e.id NOT IN (
                    		SELECT
                    			empresas_id
                    		FROM
                    			empresas_liberacoes
                    		WHERE
                    			data_competencia = '$dataCompetencia');";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getQuantidadeLiberacoesPendentes($dataCompetencia, $usuariosId = null)
    {
        $tipoUsuarioCondicao = ($usuariosId == null) ? '' : " AND ce.usuarios_id = $usuariosId ";

        $query = "SELECT
                    	COUNT(*) as quantidade
                    FROM
                    	empresas as e
                    LEFT JOIN
                        contadores_empresas as ce
                    ON
                        e.id = ce.empresas_id
                    WHERE
                    	e.regime_tributario = 'SN'
                    AND
                    	e.congelada = 0
                    AND
                        e.saiu = 0
                    $tipoUsuarioCondicao
                    AND
                    	e.id NOT IN (
                    		SELECT
                    			empresas_id
                    		FROM
                    			empresas_liberacoes
                    		WHERE
                    			data_competencia = '$dataCompetencia');";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getEmpresasLiberadasAll()
    {
        $query = "SELECT 
                    e.id, e.nome_empresa, ep.data_competencia, ep.prolabore
                FROM
                    empresas as e
                LEFT JOIN
                    empresas_prolabores as ep
                ON
                    ep.empresas_id = e.id
                WHERE 
                    ep.data_competencia IS NOT NULL;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getEmpresasSocioAdministrador()
    {
        $query = "SELECT
                    	emp.id, emp.nome_empresa, cli.nome_completo, cli.socio_administrador, cli.email
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	clientes_empresas as cliemp
                    ON
                    	cliemp.empresas_id = emp.id
                    LEFT JOIN
                    	clientes as cli
                    ON
                    	cli.id = cliemp.clientes_id
                    WHERE
                    	cli.socio_administrador = 1;";
        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getNomeEmpresasPorContador($usuariosId, $regimeTributario = 'SN')
    {
        $query = "SELECT
                    	nome_empresa, id
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	contadores_empresas ce
                    ON
                    	emp.id = ce.empresas_id
                    WHERE
                    	ce.usuarios_id = $usuariosId
                    AND
                        emp.saiu = 0
                    AND
                        emp.congelada = 0
                    AND
                        emp.regime_tributario = '$regimeTributario'
                    ;";
        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getNomeTodasEmpresas($regimeTributario = null, $congelada = 0)
    {
        $condicional = ($regimeTributario == null) ? '' : "WHERE regime_tributario = '$regimeTributario'";

        $query = "SELECT nome_empresa, id FROM empresas $condicional;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getNomeTodasEmpresasNaoCongeladas($regimeTributario = null)
    {
        $condicional = ($regimeTributario == null) ? 'WHERE congelada = 0' : "WHERE regime_tributario = '$regimeTributario' AND congelada = 0";

        $query = "SELECT nome_empresa, id FROM empresas $condicional AND saiu = 0";
        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getNomeTodasEmpresasNaoCongeladasPorContador($regimeTributario = null)
    {
        $condicional = ($regimeTributario == null) ? 'WHERE congelada = 0' : "WHERE regime_tributario = '$regimeTributario' AND congelada = 0";

        $query = "SELECT nome_empresa, id FROM empresas $condicional";
        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getQuantidadeDeEmpresasPorContadorPorRegime($usuariosId, $regimeTributario)
    {
        $query = "SELECT
                    	COUNT(id) as quantidade
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	contadores_empresas as ce
                    ON
                    	emp.id = ce.empresas_id
                    WHERE
                    	ce.usuarios_id = $usuariosId
                    AND
                        emp.regime_tributario = '$regimeTributario';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeDeEmpresasPorContadorPorRegimeNaoCongelada($usuariosId, $regimeTributario)
    {
        $query = "SELECT
                    	COUNT(id) as quantidade
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	contadores_empresas as ce
                    ON
                    	emp.id = ce.empresas_id
                    WHERE
                    	ce.usuarios_id = $usuariosId
                    AND
                        emp.congelada = 0
                    AND
                        emp.saiu = 0
                    AND
                        emp.regime_tributario = '$regimeTributario';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeTotalDeEmpresas()
    {
        $query = "SELECT COUNT(id) as quantidade FROM empresas;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeTotalDeEmpresasPorRegime($regime, $complementoCondicao = '')
    {
        $query = "SELECT COUNT(id) as quantidade FROM empresas WHERE regime_tributario = '$regime' $complementoCondicao;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getEmpresasLiberadasNew($dataCompetenciaAnterior, $dataCompetencia)
    {
        // AND
        //             	(ep.data_competencia = '$dataCompetenciaAnterior' OR ep.data_competencia = '$dataCompetencia')

        $query = "SELECT
                    	e.id, e.nome_empresa, e.regime_tributario, ep.prolabore as prolabore_atual, 
                        ep.updated_at, ep.data_competencia as competencia_anterior
                    FROM
                    	empresas as e
                    LEFT JOIN
                    	empresas_prolabores as ep
                    ON
                    	e.id = ep.empresas_id
                    WHERE
                    	e.congelada = 0
                    AND
                        e.saiu = 0
                    AND
                       	(ep.data_competencia = '$dataCompetenciaAnterior' OR ep.data_competencia = '$dataCompetencia')
                    AND
                    	e.id IN (
                    		SELECT
                    			empresas_id
                    		FROM
                    			empresas_liberacoes
                    		WHERE
                    			data_competencia = '$dataCompetencia')
                    OR
                    	(
                    		e.regime_tributario = 'Presumido'
                    	AND
                    		e.congelada = 0
                    	)
                    ORDER BY e.id ASC, ep.data_competencia ASC;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresas = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function getEmpresasLiberadas($dataCompetencia)
    {
        $query = "SELECT
                    	e.id, e.nome_empresa, e.regime_tributario
                    FROM
                    	empresas as e
                    WHERE
                    	e.congelada = 0
                    AND
                        e.saiu = 0
                    AND
                    	e.id IN (
                    		SELECT
                    			empresas_id
                    		FROM
                    			empresas_liberacoes
                    		WHERE
                    			data_competencia = '$dataCompetencia')
                    OR
                    	(
                    		e.regime_tributario = 'Presumido'
                    	AND
                    		e.congelada = 0
                    	);";

        $retorno = mysqli_query($this->conexao, $query);
        $empresas = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function getQuantidadeEmpresasLiberadas($dataCompetencia)
    {
        $query = "SELECT
                    	COUNT(e.id) as quantidade
                    FROM
                    	empresas as e
                    WHERE
                    	e.congelada = 0
                    AND
                    	e.id IN (
                    		SELECT
                    			empresas_id
                    		FROM
                    			empresas_liberacoes
                    		WHERE
                    			data_competencia = '$dataCompetencia')
                    OR
                    	(
                    		e.regime_tributario = 'Presumido'
                    	AND
                    		e.congelada = 0
                    	)";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeTotalDeEmpresasNaoCongeladas()
    {
        $query = "SELECT COUNT(id) as quantidade FROM empresas WHERE congelada = 0 AND saiu = 0;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeDeEmpresas($regimeTributario)
    {
        $query = "SELECT COUNT(id) as quantidade FROM empresas WHERE regime_tributario = '$regimeTributario';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeEmpresaNaoCongeladas($regimeTributario)
    {
        $query = "SELECT COUNT(id) as quantidade FROM empresas WHERE regime_tributario = '$regimeTributario' AND congelada = 0;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function pesquisaEmpresaLimit($nomeCondicao, $condicao, $limiteInicial)
    {
        $query = "SELECT id, nome_empresa FROM empresas";
        if ($nomeCondicao == 'nome') {
            $query .= " WHERE saiu = 0 AND nome_empresa LIKE '%$condicao%'";
        } else {
            $query .= " WHERE saiu = 0 AND id = $condicao";
        }

        $query .= " LIMIT $limiteInicial, 10;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function pesquisaEmpresa($nomeCondicao, $condicao)
    {
        $query = "SELECT * FROM empresas";
        if ($nomeCondicao == 'nome') {
            $query .= " WHERE saiu = 0 AND nome_empresa LIKE '%$condicao%';";
        } else {
            $query .= " WHERE saiu = 0 AND id = $condicao;";
        }

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function pesquisaEmpresaCompleta($id)
    {
        $query = "  SELECT
                    	emp.tipo_societario, emp.nome_empresa, emp.cnpj, emp.id, emp.regime_tributario, emp.saiu, eu.data_cadastro, us.usuario,
                        cli.nome_completo, cli.socio_administrador, cli.cpf, cli.email, cli.data_nascimento, cli.crm, cli.telefone_celular,
                        cli.telefone_comercial, cli.estado_civil, cli.regime_casamento, cli.profissao, en.iptu, en.cep, en.logradouro,
                        en.numero, en.bairro, en.cidade, en.uf as endereco_uf, en.complemento, con.dia_vencimento, con.primeira_mensalidade, usr.usuario AS gestor,
                        doc.numero as doc_numero, doc.data_emissao, doc.orgao_expedidor, doc.naturalidade, doc.validade, doc.tipo_documento, doc.uf as doc_uf,
                        ies.nome as ies_nome, ies.cidade as ies_cidade, usr2.usuario as contador, cliemp.porcentagem_societaria
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
                    	gestores_empresas AS ges
                    ON
                    	ges.empresas_id = emp.id
                    LEFT JOIN
                    	usuarios as usr
                    ON
                    	usr.id = ges.usuarios_id
                    LEFT JOIN
                    	documentos AS doc
                    ON
                    	doc.cliente_id = cli.id
                    LEFT JOIN
                    	ies
                    ON
                    	ies.id = cli.ies_id
                    LEFT JOIN
                        contadores_empresas as conemp
                    ON
                        conemp.empresas_id = emp.id
                    LEFT JOIN
                    	usuarios as usr2
                    ON
                    	usr2.id = conemp.usuarios_id
                    WHERE
                    	emp.id = $id
                    ORDER BY cli.socio_administrador DESC;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function insereEmpresa(Empresa $empresa)
    {
        $query = "  INSERT INTO empresas (id, tipo_societario, nome_empresa, regime_tributario, cnpj, data_viabilidade, objeto, capital_social)
                    VALUES(
                        {$empresa->getId()},
                        '{$empresa->getTipoSocietario()}',
                        '{$empresa->getNomeEmpresa()}',
                        '{$empresa->getRegimeTributario()}',
                        '{$empresa->getCnpj()}',
                        '{$empresa->getDataViabilidade()}',
                        '{$empresa->getObjeto()}',
                        '{$empresa->getCapitalSocial()}'
                    );";

        return mysqli_query($this->conexao, $query);
    }

    public function insereEmpresaMigrada(Empresa $empresa)
    {
        $pagamentoIrpjCsll = ($empresa->getPagamentoIrpjCsll() == '') ? 'null' : "'" . $empresa->getPagamentoIrpjCsll() . "'";
        $dataSn = ($empresa->getDataSn() == null) ? 'null' : "'" . $empresa->getDataSn() . "'";
        $inicioAtividades = ($empresa->getInicioAtividades() == null) ? 'null' : "'" . $empresa->getInicioAtividades() . "'";
        $porte = ($empresa->getPorte() == null) ? 'null' : "'" . $empresa->getPorte() . "'";

        $query = "  INSERT INTO empresas (
                        id, tipo_societario, nome_empresa, regime_tributario, cnpj, objeto, capital_social,
                        pagamento_irpj_csll, atividade_principal, inicio_atividades, data_sn, porte, vinculo
                    )
                    VALUES(
                        {$empresa->getId()},
                        '{$empresa->getTipoSocietario()}',
                        '{$empresa->getNomeEmpresa()}',
                        '{$empresa->getRegimeTributario()}',
                        '{$empresa->getCnpj()}',
                        '{$empresa->getObjeto()}',
                        {$empresa->getCapitalSocial()},
                        $pagamentoIrpjCsll,
                        '{$empresa->getAtividadePrincipal()}',
                        $inicioAtividades,
                        $dataSn,
                        $porte,
                        '{$empresa->getVinculo()}'
                    );";

        return mysqli_query($this->conexao, $query);
    }

    public function updateEmpresaMigrada(Empresa $empresa)
    {
        $pagamentoIrpjCsll = ($empresa->getPagamentoIrpjCsll() == '') ? 'null' : "'" . $empresa->getPagamentoIrpjCsll() . "'";

        $query = "  UPDATE empresas
                    SET
                        tipo_societario = '{$empresa->getTipoSocietario()}',
                        nome_empresa = '{$empresa->getNomeEmpresa()}',
                        regime_tributario = '{$empresa->getRegimeTributario()}',
                        cnpj = '{$empresa->getCnpj()}',
                        objeto = '{$empresa->getObjeto()}',
                        capital_social = '{$empresa->getCapitalSocial()}',
                        pagamento_irpj_csll = $pagamentoIrpjCsll
                    WHERE
                        id = {$empresa->getId()}
                    ;";

        return mysqli_query($this->conexao, $query);
    }

    public function insereNumeroEmpresa($numero)
    {
        $query = "INSERT INTO empresas (id) VALUES ($numero);";

        return mysqli_query($this->conexao, $query);
    }

    public function getEmpresa($numero)
    {
        $query = "SELECT * FROM empresas WHERE id = $numero;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function setEmpresaCongelada($congelada, $id)
    {
        $congelada = ($congelada) ? 0 : 1;
        $query = "UPDATE empresas SET congelada = $congelada WHERE id = $id ;";

        return mysqli_query($this->conexao, $query);
    }

    public function getEmpresaFaturamento($empresasId, $mes)
    {
        $query = "SELECT * FROM 
                    empresas_faturamentos 
                WHERE
                    empresas_id = $empresasId
                AND
                    mes = '$mes';";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function insereEmpresaFaturamento($empresasId, $faturamento, $mes)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO 
                    empresas_faturamentos(empresas_id, faturamento, mes, created_at) 
                VALUES 
                    ($empresasId, $faturamento, '$mes', '$now');";

        return mysqli_query($this->conexao, $query);
    }
}
