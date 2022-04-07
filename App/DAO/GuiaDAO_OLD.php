<?php

namespace App\DAO;
use App\Config\BancoConfig;

class GuiaDAO_OLD{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    // Com a nova alteraçã de em_conjunto = 0
    public function getNomeGuiasAnexo($dataCompetencia, $empresasId)
    {
        $query =    "SELECT
                    	tipo, nome_guia, data_vencimento
                    FROM
                    	guias
                    WHERE
                    	data_competencia = '$dataCompetencia'
                    AND
                    	sem_guia = 0
                    AND
                    	em_conjunto = 0
                    AND
                    	empresas_id = $empresasId
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }

    public function __getNomeGuiasAnexo($dataCompetencia, $empresasId)
    {
        $query =    "SELECT
                    	tipo, nome_guia, data_vencimento
                    FROM
                    	guias
                    WHERE
                    	data_competencia = '$dataCompetencia'
                    AND
                    	sem_guia = 0
                    AND
                    	empresas_id = $empresasId
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasGestorMesCompetencia_OLD($idGestor)
    {
        $sqlIdGestor = ($idGestor == 'todos') ? "" : "AND u.id = $idGestor";
        $query =    "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, emp.nome_empresa
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    LEFT JOIN
                    	gestores_empresas as ges
                    ON
                    	ges.empresas_id = emp.id
                    LEFT JOIN
                    	usuarios as u
                    ON
                    	u.id = ges.usuarios_id
                    WHERE
                    	(g.tipo = 'INSS'
                    OR
                    	g.tipo = 'IRRF'
                    OR
                    	g.tipo = 'HONORARIOS'
                    OR
                    	g.tipo ='DAS')
                    AND
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    $sqlIdGestor
                    GROUP BY emp.id;";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasGestorMesCompetencia() {
        $query =    "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, emp.nome_empresa
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	(g.tipo = 'INSS'
                    OR
                    	g.tipo = 'IRRF'
                    OR
                    	g.tipo = 'HONORARIOS'
                    OR
                    	g.tipo = 'FGTS'
                    OR
                    	g.tipo ='DAS')
                    AND
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    GROUP BY emp.id;";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasPresumidoContadorMesCompetencia(){
        $query =    "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, emp.nome_empresa
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	(g.tipo = 'PIS'
                    OR
                        g.tipo = 'COFINS'
                    OR
                    	g.tipo = 'IRPJ'
                    OR
                    	g.tipo = 'CSLL'
                    OR
                        g.tipo = 'ISS')
                    AND
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    GROUP BY emp.id;";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasRhMesCompetenciaPendentes($paginacaoInicio, $itensPorPagina)
    {
        $query =    "SELECT id, nome_empresa from empresas WHERE id NOT IN (
                    	SELECT
                    		 emp.id
                    	FROM
                    		empresas as emp
                    	LEFT JOIN
                    		guias as g
                    	ON
                    		g.empresas_id = emp.id
                    	WHERE
                    		g.tipo
                    	IN
                    		('INSS', 'IRRF', 'FGTS')
                    	AND
                    		YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    	AND
                    		MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    )
                    LIMIT $paginacaoInicio, $itensPorPagina
                    ";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getQuantidadeGuiasRhMesCompetenciaPendentes()
    {
        $query =    "SELECT id from empresas WHERE id NOT IN (
                    	SELECT
                    		 emp.id
                    	FROM
                    		empresas as emp
                    	LEFT JOIN
                    		guias as g
                    	ON
                    		g.empresas_id = emp.id
                    	WHERE
                    		g.tipo
                    	IN
                    		('INSS', 'IRRF', 'FGTS')
                    	AND
                    		YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    	AND
                    		MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    ) GROUP BY id;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_num_rows($retorno);
    }

    // USAR essa função para fazer as guias que já foram feito os uploads
    public function __getGuiasRhMesCompetencia(){
        $query =    "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, emp.nome_empresa
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	(g.tipo = 'INSS'
                    OR
                    	g.tipo = 'IRRF'
                    OR
                        g.tipo = 'FGTS')
                    AND
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    GROUP BY emp.id;";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }

    public function _getGuiasSnRhMesCompetencia(){
        $query =    "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, emp.nome_empresa
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	(g.tipo = 'INSS'
                    OR
                    	g.tipo = 'IRRF'
                    OR
                        g.tipo = 'FGTS')
                    AND
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    GROUP BY emp.id;";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getTodasGuiasMesCompetencia($regimeTributario){
        $query =    "SELECT
                    	emp.id, emp.nome_empresa, g.tipo, g.data_competencia, g.sem_guia, g.em_conjunto, cli.email
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    LEFT JOIN
                    	clientes_empresas as cliemp
                    ON
                    	cliemp.empresas_id = emp.id
                    LEFT JOIN
                    	clientes as cli
                    ON
                    	cliemp.clientes_id = cli.id
                    WHERE
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	cli.socio_administrador = 1
                    AND
                    	cli.ativo = 1
                    AND
                    	emp.congelada = 0
                    AND
                    	emp.saiu = 0
                    AND
	                   emp.regime_tributario = '$regimeTributario'
                    ORDER BY
                    	emp.id;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }


    public function getGuiasMesCompetencia($tipo){
        $query =    "SELECT
                    	emp.id, emp.nome_empresa
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	g.tipo = '$tipo'
                    AND
                        YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                        MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while($guia = mysqli_fetch_assoc($retorno)){
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getQuantidadeGuiaPendenteMesContador($usuariosId, $tipoGuia, $regimeTributario){
        $query =    "SELECT
                        COUNT(1) as quantidade
                    FROM
                       empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    LEFT JOIN
                    	contadores_empresas as ce
                    ON
                    	ce.empresas_id = emp.id
                    WHERE
                    	g.tipo = '$tipoGuia'
                    AND
                        emp.regime_tributario = '$regimeTributario'
                    AND
                        emp.saiu = 0
                    AND
                        emp.congelada = 0
                    AND
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	g.usuarios_id = $usuariosId
                    ;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeGuiaPendenteMesPorEmpresa($tipo, $emrpesaId){
        $query =    "SELECT
                    	COUNT(1) as quantidade
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	(g.tipo = '$tipo'
                    AND
                    	g.empresas_id = $emrpesaId
                        )
                    AND
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    ;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeGuiaPendenteMes($tipo){
        $query =    "SELECT
                    	count(1) as quantidade
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	g.tipo = '$tipo'
                    AND
                        YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                        MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    ;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function insereSemGuia($empresasId, $usuariosId, $tipo, $dataCompetencia, $semGuia){
        date_default_timezone_set('America/Sao_Paulo');
        $dataUpload = date('Y-m-d');

        $dataCompetencia = str_replace('/', '-', $dataCompetencia);
        $dataCompetencia = '01-'.$dataCompetencia;
        $dataCompetencia = date('Y-m-d', strtotime($dataCompetencia));

        $query =    "INSERT INTO guias (
                        empresas_id, usuarios_id, tipo, data_competencia, data_upload, sem_guia
                    )
                    VALUES(
                        $empresasId,
                        $usuariosId,
                        '{$tipo}',
                        '{$dataCompetencia}',
                        '{$dataUpload}',
                        $semGuia
                    );";

        return mysqli_query($this->conexao, $query);
    }

    public function insereGuia($empresasId, $tipo, $dataVencimento, $dataCompetencia, $usuariosId, $nomeGuia, $conjunto){
        $emConjunto = ($conjunto == '') ? 'false' : 'true';

        date_default_timezone_set('America/Sao_Paulo');
        $dataUpload = date('Y-m-d');

        $dataCompetencia = str_replace('/', '-', $dataCompetencia);
        $dataCompetencia = '01-'.$dataCompetencia;
        $dataCompetencia = date('Y-m-d', strtotime($dataCompetencia));

        $query =    "INSERT INTO guias (
                        empresas_id, tipo, data_vencimento, data_competencia, data_upload, usuarios_id, nome_guia, em_conjunto
                    )
                    VALUES(
                        $empresasId,
                        '{$tipo}',
                        '{$dataVencimento}',
                        '{$dataCompetencia}',
                        '{$dataUpload}',
                        $usuariosId,
                        '{$nomeGuia}',
                        $emConjunto
                    );";

        $dados['retorno'] = mysqli_query($this->conexao, $query);
        $dados['id_guia'] = mysqli_insert_id($this->conexao);

        return $dados;
    }
}
