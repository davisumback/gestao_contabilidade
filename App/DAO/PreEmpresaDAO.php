<?php

namespace App\DAO;
use App\Config\BancoConfig;
use App\Model\User\PreCadastroClientePipedrive;
use App\Helper\Helpers;

class PreEmpresaDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function pesquisaPreEmpresaCompleta($id)
    {
        $query =    "SELECT
                    	preemp.empresa_outro_escritorio, preemp.cnpj, cliu.data_cadastro, cliemp.porcentagem_societaria, preemp.id, preemp.tipo_societario, preemp.nome_1, preemp.nome_2, preemp.nome_3, preemp.primeira_mensalidade, cli.nome_completo,
                        cli.cpf, cli.email, cli.data_nascimento, cli.crm, cli.telefone_comercial, cli.telefone_celular, cli.socio_administrador,
                        cli.sexo, cli.estado_civil, cli.regime_casamento, cli.profissao, cli.socio_administrador,
                        doc.numero as documento_numero, doc.data_emissao, doc.orgao_expedidor, doc.naturalidade, doc.validade, doc.tipo_documento,
                        doc.uf as documento_uf, ende.iptu, ende.cep, ende.logradouro, ende.numero as endereco_numero, ende.bairro, ende.cidade,
                        ende.uf as endereco_uf, ende.complemento, u.nome_completo as usuario_nome, ies.nome as ies_nome, ies.cidade as ies_cidade
                    FROM
                        pre_empresas as preemp
                    LEFT JOIN
                        clientes_pre_empresas as cliemp
                    ON
                        preemp.id = cliemp.pre_empresas_id
                    LEFT JOIN
                        clientes as cli
                    ON
                        cli.id = cliemp.clientes_id
                    LEFT JOIN
                        documentos as doc
                    ON
                        doc.cliente_id = cli.id
                    LEFT JOIN
                        endereco_cliente as ende
                    ON
                        ende.clientes_id = cli.id
                    LEFT JOIN
                        cliente_usuario as cliu
                    ON
                        cli.id = cliu.clientes_id
                    LEFT JOIN
                        usuarios as u
                    ON
                        u.id = cliu.usuarios_id
                    LEFT JOIN
                        ies as ies
                    ON
                        ies.id = cli.ies_id
                    WHERE
                        preemp.id = $id
                        ;";

                    // -- ORDER BY cli.socio_administrador DESC;

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while($empresa = mysqli_fetch_assoc($retorno)){
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getQuantidadePreEmpresas()
    {
        $query = "SELECT COUNT(*) as quantidade FROM pre_empresas WHERE inclusao_socios = 1";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeEmpresasOutroEscritorio()
    {
        $query =    "SELECT
                        COUNT(*) as quantidade
                    FROM
                        pre_empresas
                    WHERE
                        empresa_outro_escritorio = 1
                    AND
                        cadastro_finalizado = 0
                    AND
                        inclusao_socios = 0
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        return mysqli_fetch_assoc($retorno);
    }

    public function getEmpresasOutroEscritorio()
    {
        $query =    "SELECT
                        id, cnpj
                    FROM
                        pre_empresas
                    WHERE
                        empresa_outro_escritorio = 1
                    AND
                        cadastro_finalizado = 0
                    AND
                        inclusao_socios = 0;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while($empresa = mysqli_fetch_assoc($retorno)){
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getPreEmpresas()
    {
        $query = "SELECT id, nome_1, nome_2, nome_3 FROM pre_empresas WHERE inclusao_socios = 1";

        $retorno = mysqli_query($this->conexao, $query);
        $empresaArray = array();

        while($empresa = mysqli_fetch_assoc($retorno)){
            $empresaArray[] = $empresa;
        }

        return $empresaArray;
    }

    public function getQuantidadeSociosAIncluirPipedrive($regimeTributario)
    {
        $query = "SELECT
                        COUNT(*) as quantidade
                    FROM
                        pre_empresas as pre
                    LEFT JOIN
                        clientes_pre_empresas as clipre
                    ON
                        pre.id = clipre.pre_empresas_id
                    LEFT JOIN
                        clientes as cli
                    ON
                        clipre.clientes_id = cli.id
                    WHERE
                        pre.tipo_societario = '$regimeTributario'
                    AND
                        pre.inclusao_socios = 0
                    AND
                        cli.pipedrive_cadastro = 'VERIFICADO'
                    AND
                        pre.empresa_outro_escritorio != 1
                        ;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function finalizaCadastro($preEmpresaId)
    {
        $query =    "UPDATE
                        pre_empresas
                    SET
                        inclusao_socios = 1
                    WHERE
                        id = $preEmpresaId;";

        return mysqli_query($this->conexao, $query);
    }

    public function getPreSocios($empresasId)
    {
        $query =    "SELECT
                        cli.id, cli.nome_completo, cliemp.porcentagem_societaria
                    FROM
                        pre_empresas as emp
                    LEFT JOIN
                        clientes_pre_empresas as cliemp
                    ON
                        cliemp.pre_empresas_id = emp.id
                    LEFT JOIN
                        clientes as cli
                    ON
                        cli.id = cliemp.clientes_id
                    WHERE
                        cliemp.pre_empresas_id = $empresasId;";
        $retorno = mysqli_query($this->conexao, $query);

        $empresas = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function getPreEmpresasAConfirmar($regimeTributario)
    {
        $query =    "SELECT
                        pre.id, pre.tipo_societario, pre.nome_1, pre.nome_2, pre.nome_3, cli.pipedrive_cadastro, cli.id as cliente_id
                    FROM
                        pre_empresas as pre
                    LEFT JOIN
                        clientes_pre_empresas as clipre
                    ON
                        pre.id = clipre.pre_empresas_id
                    LEFT JOIN
                        clientes as cli
                    ON
                        clipre.clientes_id = cli.id
                    WHERE
                        pre.tipo_societario = '$regimeTributario'
                    AND
                        pre.inclusao_socios = 0
                    AND
                        cli.pipedrive_cadastro = 'VERIFICADO'
                    AND
                        pre.empresa_outro_escritorio != 1
                    ;";
        $retorno = mysqli_query($this->conexao, $query);

        $empresas = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function criaPreEmpresaPipedrive(PreCadastroClientePipedrive $cliente)
    {
        $planosId = $cliente->getPlanosId();
        $empresaOutroEscritorio = 0;

        if (Helpers::isEmpresaDeOutroEscritorio($cliente->getNome1(), $cliente->getNome2(), $cliente->getNome3())) {
            $empresaOutroEscritorio = 1;
        }

        $idEmpresas = $this->getUltimoIdTabela('empresas');
        $idPreEmpresas = $this->getUltimoIdTabela('pre_empresas');

        $id = ($idEmpresas > $idPreEmpresas) ? $idEmpresas : $idPreEmpresas;

        $query =    "INSERT INTO pre_empresas(
                        id, nome_1, nome_2, nome_3, planos_id, primeira_mensalidade, empresa_outro_escritorio
                    )VALUES(
                        $id,
                        '{$cliente->getNome1()}',
                        '{$cliente->getNome2()}',
                        '{$cliente->getNome3()}',
                        $planosId,
                        '{$cliente->getPrimeiraMensalidade()}',
                        $empresaOutroEscritorio
                    );";

        $retorno = mysqli_query($this->conexao, $query);

        if ($retorno == false) {
            return false;
        }

        $retornoFormatado['pre_empresas_id'] = $id;

        return $retornoFormatado;
    }

    public function confirmaPreEmpresaConstituidaPipedrive($sociedade, $cnpj, $primeira_mensalidade, $empresasId)
    {
        $query =    "UPDATE pre_empresas
                    SET
                        tipo_societario = '$sociedade',
                        cnpj = '$cnpj',
                        primeira_mensalidade = '$primeira_mensalidade'
                    WHERE
                        id = $empresasId
                    ;";

        return mysqli_query($this->conexao, $query);
    }

    public function confirmaPreEmpresaPipedrive($tipoSocietario, $nome_1, $nome_2, $nome_3, $primeira_mensalidade, $preEmpresaId)
    {
        $sociedade = ($tipoSocietario == '') ? 'null' : "'" .$tipoSocietario. "'";

        $query =    "UPDATE pre_empresas
                    SET
                        tipo_societario = $sociedade,
                        nome_1 = '$nome_1',
                        nome_2 = '$nome_2',
                        nome_3 = '$nome_3',
                        primeira_mensalidade = '$primeira_mensalidade'
                    WHERE
                        id = $preEmpresaId
                    ;";

        return mysqli_query($this->conexao, $query);
    }

    public function getUltimoIdTabela($tabela)
    {
        $query = "SELECT MAX(id) + 1 as ultimo_id FROM $tabela;";
        $retorno = mysqli_query($this->conexao, $query);

        if ($resultado = mysqli_fetch_assoc($retorno)) {
            return $resultado['ultimo_id'];
        }

        return false;
    }

    public function updateSocioPreEmpresa($clientesId, $preEmpresasId, $porcentagem)
    {
        $query =    "UPDATE
                        clientes_pre_empresas
                    SET
                        porcentagem_societaria = $porcentagem
                    WHERE
                        clientes_id = $clientesId
                    AND
                        pre_empresas_id = $preEmpresasId;";

        return mysqli_query($this->conexao, $query);
    }

    public function insereSocioPreEmpresa($clientesId, $preEmpresasId, $porcentagem)
    {
        $query = "INSERT INTO clientes_pre_empresas (clientes_id, pre_empresas_id, porcentagem_societaria) VALUES ($clientesId, $preEmpresasId, $porcentagem);";
        return mysqli_query($this->conexao, $query);
    }
}
