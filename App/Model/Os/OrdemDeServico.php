<?php
namespace App\Model\Os;

use App\Config\BancoConfig;
use App\DAO\GestorEmpresaDAO;

// MEDCONTÁBIL QUANDO CRIAR OS, A OS TEM QUE CAIR PARA QUEM TIVER MENOS PENDÊNCIAS
// $retorno = $this->getUsuarioSemPendencia('Gestor');
// if ($retorno == null) {
//     $retorno = $this->getUsuarioMenorPendencia('Gestor');
// }

class OrdemDeServico
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getQuantidadeAll($usuariosId, $status, $dataCompetencia)
    {
        $fomataDataCompetencia = \App\Helper\Helpers::formataDataPeriodo('add', $dataCompetencia, 'P1M', 'Y-m');
        $arrayExplodeData = explode('-', $fomataDataCompetencia);
        $mes = $arrayExplodeData[1];
        $ano = $arrayExplodeData[0];
        
        $query = "SELECT
                    count(os.id) as quantidade
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    os_usuarios_recebimentos as osr
                ON
                    os.id = osr.ordens_de_servicos_id
                WHERE
                    osr.usuarios_id = $usuariosId
                AND
                    os.status = '$status'
                AND 
                    MONTH (os.created_at) = '$mes'
                AND 
                    YEAR (os.created_at) = '$ano';";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getQuantidadeAllSemData($usuariosId, $status)
    {       
        $query = "SELECT
                    count(os.id) as quantidade
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    os_usuarios_recebimentos as osr
                ON
                    os.id = osr.ordens_de_servicos_id
                WHERE
                    osr.usuarios_id = $usuariosId
                AND
                    os.status = '$status';";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getQuantidadeAllSemDataSemUsuario($osId, $status)
    {       
        $query = "SELECT
                    count(os.id) as quantidade
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    os_usuarios_recebimentos as osr
                ON
                    os.id = osr.ordens_de_servicos_id
                WHERE
                    os.status = '$status'
                AND
                    os.tipos_os_id = $osId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getAll($request)
    {
        $periodo = (! array_key_exists('periodo', $request)) ? 30 : $request['periodo'];
        $tipo = (! array_key_exists('tipoOs', $request) || ((array_key_exists('tipoOs', $request) && $request['tipoOs'] == 'all'))) ? '' : 'AND o.tipos_os_id = '.$request['tipoOs']  . ' ';
        $status = (! array_key_exists('status', $request) || ((array_key_exists('status', $request) && $request['status'] == 'all'))) ? '' : 'AND o.status = \'' . $request['status'] . '\'';

        $query =    "SELECT 
                        o.id, tos.tipo as nomeArquivo, tos.titulo as titulo_geral, tos.dias_minimo, tos.dias_maximo, tos.id as tipoOs, 
                        o.titulo, o.created_at, o.descricao, o.status, oue.empresas_id, tos.metodo_get
                    FROM 
                        ordens_de_servicos as o
                    LEFT JOIN
                        tipos_os as tos
                    ON
                        o.tipos_os_id = tos.id
                    LEFT JOIN
                        os_usuarios_emissoes as oue
                    ON
                        o.id = oue.ordens_de_servicos_id                    
                    WHERE
                        DATE(o.created_at) BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -$periodo DAY) AND CURRENT_DATE()
                    $status
                    $tipo
                    ORDER BY
                        o.status ASC
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas [] = $linha;
        }
        
        return $linhas;

    }

    public function getOsUsuarioTipoAll($usuariosId, $osId, $status, $dataCompetencia)
    {
        $fomataDataCompetencia = \App\Helper\Helpers::formataDataPeriodo('add', $dataCompetencia, 'P1M', 'Y-m');
        $arrayExplodeData = explode('-', $fomataDataCompetencia);
        $mes = $arrayExplodeData[1];
        $ano = $arrayExplodeData[0];

        $query = "SELECT
                    count(os.id) as quantidade
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    os_usuarios_recebimentos as osr
                ON
                    os.id = osr.ordens_de_servicos_id
                WHERE
                    os.status = '$status'
                AND
                    os.tipos_os_id = $osId
                AND
                    osr.usuarios_id = $usuariosId
                AND 
                    MONTH (os.created_at) = '$mes'
                AND 
                    YEAR (os.created_at) = '$ano';";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getOsUsuarioTipoAllSemData($usuariosId, $osId, $status)
    {
        $query = "SELECT
                    count(os.id) as quantidade
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    os_usuarios_recebimentos as osr
                ON
                    os.id = osr.ordens_de_servicos_id
                WHERE
                    os.status = '$status'
                AND
                    os.tipos_os_id = $osId
                AND
                    osr.usuarios_id = $usuariosId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getOsPorTipoAll($osId, $status, $dataCompetencia)
    {
        $fomataDataCompetencia = \App\Helper\Helpers::formataDataPeriodo('add', $dataCompetencia, 'P1M', 'Y-m');
        $arrayExplodeData = explode('-', $fomataDataCompetencia);
        $mes = $arrayExplodeData[1];
        $ano = $arrayExplodeData[0];

        $query = "SELECT
                    count(os.id) as quantidade
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    os_usuarios_recebimentos as osr
                ON
                    os.id = osr.ordens_de_servicos_id
                WHERE
                    os.status = '$status'
                AND
                    os.tipos_os_id = $osId
                AND 
                    MONTH (os.created_at) = '$mes'
                AND 
                    YEAR (os.created_at) = '$ano';";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getOsPorTipo($usuariosId, $osId, $status) // APAGAR SE PRECISO
    {
        $query = "SELECT
                    count(os.id) as quantidade
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    os_usuarios_recebimentos as osr
                ON
                    os.id = osr.ordens_de_servicos_id
                WHERE
                    osr.usuarios_id = $usuariosId
                AND
                    os.status = '$status'
                AND
	                os.tipos_os_id = $osId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getOsPorStatusAll($status, $dataCompetencia) // APAGAR
    {    
        $fomataDataCompetencia = \App\Helper\Helpers::formataDataPeriodo('add', $dataCompetencia, 'P1M', 'Y-m');
        $arrayExplodeData = explode('-', $fomataDataCompetencia);
        $mes = $arrayExplodeData[1];
        $ano = $arrayExplodeData[0];

        $query = "SELECT
                    count(id) as quantidade
                FROM
                    ordens_de_servicos
                WHERE
                    status = '$status'
                AND
                    MONTH(created_at) = '$mes'
                AND
                    YEAR(created_at) = '$ano';";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getOsPorStatusAllSemData($status) // APAGAR
    {
        $query = "SELECT
                    count(id) as quantidade
                FROM
                    ordens_de_servicos
                WHERE
                    status = '$status';";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function getOsPorStatus($usuariosId, $status)
    {
        $query = "SELECT
                    count(os.id) as quantidade
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    os_usuarios_recebimentos as osr
                ON
                    os.id = osr.ordens_de_servicos_id
                WHERE
                    os.status = '$status'
                AND
                    osr.usuarios_id = $usuariosId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = mysqli_fetch_assoc($retorno);

        return $linhas['quantidade'];
    }

    public function updateOs($status, $osId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE ordens_de_servicos SET status = '$status', updated_at = '$now' WHERE id = $osId;";

        return \mysqli_query($this->conexao, $query);
    }

    public function getOsOutros($osId)
    {
        $query = "SELECT
                    os.titulo, tos.id as tipoOs, tos.tipo as nomeArquivo, DATE(os.created_at) as created_at, os.status, gs.nome as setorNome,
                    osi.descricao
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    tipos_os as tos
                ON
                    os.tipos_os_id = tos.id
                LEFT JOIN
                    os_usuarios_recebimentos as our
                ON
                    os.id = our.ordens_de_servicos_id
                LEFT JOIN
                    ordens_de_servicos_itens as osi
                ON
                    os.id = osi.ordens_de_servicos_id
                LEFT JOIN
                    grupob_setores as gs
                ON
                    os.grupob_setores_id = gs.id
                WHERE
                    os.id = $osId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas [] = $linha;
        }

        return $linhas;
    }

    public function getOsCredenciamento($osId)
    {
        $query = "SELECT
                    os.titulo, tos.id as tipoOs, tos.tipo as nomeArquivo, DATE(os.created_at) as created_at, os.status, osi.descricao, osi.item_id, 
                    tc.nome as nomeItemOs, tc.descricao_emissao, tc.descricao_recebimento, our.empresas_id, e.nome_empresa
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    tipos_os as tos
                ON
                    os.tipos_os_id = tos.id
                LEFT JOIN
                    os_usuarios_recebimentos as our
                ON
                    os.id = our.ordens_de_servicos_id
                LEFT JOIN
                    ordens_de_servicos_itens as osi
                ON
                    os.id = osi.ordens_de_servicos_id
                LEFT JOIN
                    tipos_credenciamentos as tc
                ON
                    osi.item_id = tc.id
                LEFT JOIN
                    empresas as e
                ON
                    our.empresas_id = e.id
                WHERE
                    os.id = $osId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas [] = $linha;
        }

        return $linhas;
    }

    public function getOsDeclaracaoRendimento($osId)
    {
        $query = "SELECT
                    os.titulo, tos.id as tipoOs, tos.tipo as nomeArquivo, DATE(os.created_at) as created_at, os.status, osi.descricao, osi.item_id, 
                    tdr.nome as nomeItemOs, tdr.descricao_emissao, tdr.descricao_recebimento, our.empresas_id, e.nome_empresa,
                    c.nome_completo, c.cpf
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    tipos_os as tos
                ON
                    os.tipos_os_id = tos.id
                LEFT JOIN
                    os_usuarios_recebimentos as our
                ON
                    os.id = our.ordens_de_servicos_id
                LEFT JOIN
                    ordens_de_servicos_itens as osi
                ON
                    os.id = osi.ordens_de_servicos_id
                LEFT JOIN
                    tipos_dec_rendimentos as tdr
                ON
                    osi.item_id = tdr.id
                LEFT JOIN
                    empresas as e
                ON
                    our.empresas_id = e.id
                LEFT JOIN
                    clientes as c
                ON
                    osi.clientes_id = c.id
                WHERE
                    os.id = $osId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas [] = $linha;
        }

        return $linhas;
    }

    public function getOsRecalculoGuia($osId)
    {
        $query = "SELECT
                    os.titulo, tos.id as tipoOs, tos.tipo as nomeArquivo, DATE(os.created_at) as created_at, os.status, osi.descricao, osi.item_id, 
                    tg.nome as nomeItemOs, tg.descricao_emissao, tg.descricao_recebimento, our.empresas_id, e.nome_empresa, osi.data_vencimento, osi.data_competencia
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    tipos_os as tos
                ON
                    os.tipos_os_id = tos.id
                LEFT JOIN
                    os_usuarios_recebimentos as our
                ON
                    os.id = our.ordens_de_servicos_id
                LEFT JOIN
                    ordens_de_servicos_itens as osi
                ON
                    os.id = osi.ordens_de_servicos_id
                LEFT JOIN
                    tipos_guias as tg
                ON
                    osi.item_id = tg.id
                LEFT JOIN
                    empresas as e
                ON
                    our.empresas_id = e.id
                WHERE
                    os.id = $osId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas [] = $linha;
        }

        return $linhas;
    }

    public function getOsCertidao($osId)
    {
        $query = "SELECT
                    os.titulo, tos.id as tipoOs, tos.tipo as nomeArquivo, DATE(os.created_at) as created_at, os.status, osi.descricao, osi.item_id, 
                    tc.nome as nomeItemOs, tc.descricao_emissao, tc.descricao_recebimento, our.empresas_id, e.nome_empresa
                FROM 
                    ordens_de_servicos as os
                LEFT JOIN
                    tipos_os as tos
                ON
                    os.tipos_os_id = tos.id
                LEFT JOIN
                    os_usuarios_recebimentos as our
                ON
                    os.id = our.ordens_de_servicos_id
                LEFT JOIN
                    ordens_de_servicos_itens as osi
                ON
                    os.id = osi.ordens_de_servicos_id
                LEFT JOIN
                    tipos_certidoes as tc
                ON
                    osi.item_id = tc.id
                LEFT JOIN
                    empresas as e
                ON
                    our.empresas_id = e.id
                WHERE
                    os.id = $osId;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas [] = $linha;
        }

        return $linhas;
    }

    public function saveOsRecalculoGuia($empresasId, $usuariosId, $usuariosIdRecebe, $guias, $vencimento, $competencia)
    {   
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query =    "INSERT INTO ordens_de_servicos (
                        titulo, created_at, status, tipos_os_id
                    ) VALUES (
                        'Recálculo de Guia(s)', '$now', 'PENDENTE', 4
                    );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar Ordem de Serviço no banco!", 1);
        }

        $ordensDeServicoId = \mysqli_insert_id($this->conexao);

        foreach ($guias as $guia => $valor) {
            $this->insertItensOs($ordensDeServicoId, $valor, $vencimento, $competencia);
        }

        $this->insereUsuarioOsEmissaoMedcontabil($ordensDeServicoId, $usuariosId, $empresasId);
        $this->insereUsuarioOsRecebe($ordensDeServicoId, $empresasId, $usuariosIdRecebe);

        return true;
    }

    public function saveOsRecalculoGuiaMedcontabil($empresasId, $usuariosId, $usuariosIdRecebe, $guias, $vencimento, $competencia)
    {   
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query =    "INSERT INTO ordens_de_servicos (
                        titulo, created_at, status, tipos_os_id
                    ) VALUES (
                        'Recálculo de Guia(s)', '$now', 'PENDENTE', 4
                    );";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar Ordem de Serviço no banco!", 1);
        }

        $ordensDeServicoId = \mysqli_insert_id($this->conexao);

        foreach ($guias as $guia => $valor) {
            $this->insertItensOs($ordensDeServicoId, $valor, $vencimento, $competencia);
        }

        $this->insereUsuarioOsEmissao($ordensDeServicoId, $usuariosId, $empresasId);
        $this->insereUsuarioOsRecebe($ordensDeServicoId, $empresasId, $usuariosIdRecebe);

        return true;
    }

    public function saveOsCertidao($attributes)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query =    "INSERT INTO ordens_de_servicos (
                        titulo, created_at, status, tipos_os_id
                    ) VALUES (
                        'Certidão', '$now', 'PENDENTE', 3
                    );";

        if (\mysqli_query($this->conexao, $query) == false) {
            return false;
        }

        $ordensDeServicoId = \mysqli_insert_id($this->conexao);

        foreach ($attributes['certidoes'] as $certidao => $valor) {
            $this->insertItensOs($ordensDeServicoId, $certidao);
        }

        $this->insereUsuarioOsEmissao($ordensDeServicoId, $attributes['usuariosId'], $attributes['empresasId']);

        $dao = new GestorEmpresaDAO();
        $retorno = $dao->getGestorIdEmpresa($attributes['empresasId']);
        $gestorId = $retorno['usuarios_id'];

        $this->insereUsuarioOsRecebe($ordensDeServicoId, $attributes['empresasId'], $gestorId);

        return true;
    }

    public function saveOsCertidaoMedcontabil($attributes)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query =    "INSERT INTO ordens_de_servicos (
                        titulo, created_at, status, tipos_os_id
                    ) VALUES (
                        'Certidão', '$now', 'PENDENTE', 3
                    );";

        if (\mysqli_query($this->conexao, $query) == false) {
            return false;
        }

        $ordensDeServicoId = \mysqli_insert_id($this->conexao);

        foreach ($attributes['certidoes'] as $certidao => $valor) {
            $this->insertItensOs($ordensDeServicoId, $certidao);
        }

        $this->insereUsuarioOsEmissaoMedcontabil($ordensDeServicoId, $attributes['usuariosId'], $attributes['empresasId']);

        $dao = new GestorEmpresaDAO();
        $retorno = $dao->getGestorIdEmpresa($attributes['empresasId']);
        $gestorId = $retorno['usuarios_id'];

        $this->insereUsuarioOsRecebe($ordensDeServicoId, $attributes['empresasId'], $gestorId);

        return true;
    }

    public function insereUsuarioOsRecebe($ordensDeServicoId, $empresasId, $usuariosId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_usuarios_recebimentos (
            ordens_de_servicos_id, empresas_id, usuarios_id, created_at
        ) VALUES (
            $ordensDeServicoId, $empresasId, $usuariosId, '$now'
        );";

        return \mysqli_query($this->conexao, $query);
    }

    public function insereUsuarioOsEmissao($ordensDeServicoId, $usuariosId, $empresasId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_usuarios_emissoes (
            ordens_de_servicos_id, usuarios_id, empresas_id, created_at
        ) VALUES (
            $ordensDeServicoId, $usuariosId, $empresasId, '$now'
        );";

        return \mysqli_query($this->conexao, $query);
    }

    public function insereUsuarioOsEmissaoMedcontabil($ordensDeServicoId, $usuariosId, $empresasId)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO os_empresas_emissoes (
            clientes_id, ordens_de_servicos_id, created_at
        ) VALUES (
            $usuariosId, $ordensDeServicoId,'$now'
        );";

        return \mysqli_query($this->conexao, $query);
    }

    public function getUsuarioMenorPendencia($nomeTipoUsuario)
    {
        $query =    "SELECT
                        COUNT(our.usuarios_id) as quantidade, our.usuarios_id, os.status
                    FROM 
                        os_usuarios_recebimentos as our
                    LEFT JOIN
                        ordens_de_servicos as os
                    ON
                        os.id = our.ordens_de_servicos_id
                    LEFT JOIN
                        usuarios as u
                    ON
                        u.id = our.usuarios_id
                    LEFT JOIN
                        tipo_usuario as tu
                    ON
                        u.tipo = tu.id
                    WHERE
                        tu.nome_tipo = '$nomeTipoUsuario'
                    GROUP BY 
                        our.usuarios_id
                    ORDER BY quantidade ASC
                    LIMIT 1;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getUsuarioSemPendencia()
    {
        $query = "SELECT 
                    u.id as usuarios_id
                FROM 
                    usuarios as u
                LEFT JOIN
                    tipo_usuario as tu
                ON
                    u.tipo = tu.id
                WHERE
                    tu.nome_tipo = 'Gestor'
                AND
                    u.id
                NOT IN (SELECT
                            our.usuarios_id
                        FROM 
                            os_usuarios_recebimentos as our
                        )
                LIMIT 1;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getPrimeiroUsuarioDoPerfil($nomeTipoUsuario)
    {
       $query = "SELECT
                    u.id as usuarios_id
                FROM 
                    usuarios as u
                LEFT JOIN
                    tipo_usuario as tu
                ON
                    u.tipo = tu.id
                WHERE
                    tu.nome_tipo = '$nomeTipoUsuario'
                LIMIT 1;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function insertItensOs($ordemDeServicoId, $itemId, $vencimento = null, $competencia = null)
    {
        if ($vencimento == null || $competencia == null) {
            $query = "INSERT INTO ordens_de_servicos_itens (ordens_de_servicos_id, item_id) VALUES ($ordemDeServicoId, $itemId);";
        } else {
            $query = "INSERT INTO ordens_de_servicos_itens (ordens_de_servicos_id, item_id, data_vencimento, data_competencia) VALUES ($ordemDeServicoId, $itemId, '$vencimento', '$competencia');";
        }

        return \mysqli_query($this->conexao, $query);
    }

    public function getAllRecebidas($request, $usuariosId)
    {
        $periodo = (! array_key_exists('periodo', $request)) ? 30 : $request['periodo'];
        $tipo = (! array_key_exists('tipoOs', $request) || ((array_key_exists('tipoOs', $request) && $request['tipoOs'] == 'all'))) ? '' : 'AND o.tipos_os_id = '.$request['tipoOs']  . ' ';
        $status = (! array_key_exists('status', $request) || ((array_key_exists('status', $request) && $request['status'] == 'all'))) ? '' : 'AND o.status = \'' . $request['status'] . '\'';

        $query =    "SELECT
                        o.id, tos.tipo as nomeArquivo, tos.titulo as titulo_geral, tos.dias_minimo, tos.dias_maximo, tos.id as tipoOs,
                        o.titulo, o.created_at, o.descricao, o.status, our.empresas_id, tos.metodo_get, gs.nome as nomeSetor, e.cnpj
                    FROM
                        ordens_de_servicos as o
                    LEFT JOIN
                        tipos_os as tos
                    ON
                        o.tipos_os_id = tos.id
                    LEFT JOIN
                        os_usuarios_recebimentos as our
                    ON
                        o.id = our.ordens_de_servicos_id
                    LEFT JOIN
                        grupob_setores as gs
                    ON
                        o.grupob_setores_id = gs.id
                    LEFT JOIN
                        empresas as e
                    ON
                        our.empresas_id = e.id
                    WHERE
                        our.usuarios_id = $usuariosId
                    AND
                        DATE(o.created_at) BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -$periodo DAY) AND CURRENT_DATE()
                    $status
                    $tipo
                    ORDER BY
                        o.status ASC,
                        o.id ASC,
                        DATE(o.created_at) ASC
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas [] = $linha;
        }
        
        return $linhas;
    }

    public function getAllEmitidas($request, $usuariosId)
    {
        $periodo = (! array_key_exists('periodo', $request)) ? 30 : $request['periodo'];
        $tipo = (! array_key_exists('tipoOs', $request) || ((array_key_exists('tipoOs', $request) && $request['tipoOs'] == 'all'))) ? '' : 'AND o.tipos_os_id = '.$request['tipoOs']  . ' ';
        $status = (! array_key_exists('status', $request) || ((array_key_exists('status', $request) && $request['status'] == 'all'))) ? '' : 'AND o.status = \'' . $request['status'] . '\'';

        $query =    "SELECT 
                        o.id, tos.tipo as nomeArquivo, tos.titulo as titulo_geral, tos.dias_minimo, tos.dias_maximo, tos.id as tipoOs, 
                        o.titulo, o.created_at, o.descricao, o.status, oue.empresas_id, tos.metodo_get, gs.nome as nomeSetor, e.cnpj
                    FROM 
                        ordens_de_servicos as o
                    LEFT JOIN
                        tipos_os as tos
                    ON
                        o.tipos_os_id = tos.id
                    LEFT JOIN
                        os_usuarios_emissoes as oue
                    ON
                        o.id = oue.ordens_de_servicos_id
                    LEFT JOIN
                        empresas as e
                    ON
                        oue.empresas_id = e.id
                    LEFT JOIN
                        grupob_setores as gs
                    ON
                        o.grupob_setores_id = gs.id
                    WHERE
                        oue.usuarios_id = $usuariosId
                    AND
                        DATE(o.created_at) BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -$periodo DAY) AND CURRENT_DATE()
                    $status
                    $tipo
                    ORDER BY
                        o.status ASC,
                        o.id ASC,
                        DATE(o.created_at) ASC
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }
        
        return $linhas;
    }

    public function getAllEmitidasMedcontabil($request, $usuariosId)
    {
        $periodo = (! array_key_exists('periodo', $request)) ? 30 : $request['periodo'];
        $tipo = (! array_key_exists('tipoOs', $request) || ((array_key_exists('tipoOs', $request) && $request['tipoOs'] == 'all'))) ? '' : 'AND o.tipos_os_id = '.$request['tipoOs']  . ' ';
        $status = (! array_key_exists('status', $request) || ((array_key_exists('status', $request) && $request['status'] == 'all'))) ? '' : 'AND o.status = \'' . $request['status'] . '\'';

        $query =    "SELECT 
                        o.id, tos.tipo as nomeArquivo, tos.titulo as titulo_geral, tos.dias_minimo, tos.dias_maximo, tos.id as tipoOs, 
                        o.titulo, o.created_at, o.descricao, o.status, oee.clientes_id, tos.metodo_get, gs.nome as nomeSetor, e.cnpj
                    FROM 
                        ordens_de_servicos as o
                    LEFT JOIN
                        tipos_os as tos
                    ON
                        o.tipos_os_id = tos.id
                    LEFT JOIN
                        os_empresas_emissoes as oee
                    ON
                        o.id = oee.ordens_de_servicos_id
                    LEFT JOIN
                        empresas as e
                    ON
                        oee.clientes_id = e.id
                    LEFT JOIN
                        grupob_setores as gs
                    ON
                        o.grupob_setores_id = gs.id
                    WHERE
                        oee.clientes_id = $usuariosId
                    AND
                        DATE(o.created_at) BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -$periodo DAY) AND CURRENT_DATE()
                    $status
                    $tipo
                    ORDER BY
                        o.status ASC,
                        o.id ASC,
                        DATE(o.created_at) ASC
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }
        
        return $linhas;
    }

    public function decideCor($status)
    {
        $cor = '';

        switch ($status) {
            case 'PENDENTE': 
                $cor = 'warning';
            break;

            case 'FINALIZADA': 
                $cor = 'success';
            break;
        }

        return $cor;
    }
}