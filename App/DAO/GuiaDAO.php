<?php

namespace App\DAO;

use App\Config\BancoConfig;

class GuiaDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function listaGuiasPendentesRh($competenciaAnterior, $competenciaAtual, $tipoGuia)
    {
        $query = "SELECT 
                    e.id, e.nome_empresa, f.empresas_id, e.regime_tributario,
                    (SELECT epro.prolabore FROM empresas_prolabores as epro WHERE epro.empresas_id = e.id AND epro.data_competencia = '$competenciaAnterior') as prolaboreAnterior,
                    (SELECT epro.prolabore FROM empresas_prolabores as epro WHERE epro.empresas_id = e.id AND epro.data_competencia = '$competenciaAtual') as prolabore,
                    (SELECT eprol.updated_at FROM empresas_prolabores as eprol WHERE eprol.empresas_id = e.id AND eprol.data_competencia = '$competenciaAnterior') as updatedAt
                FROM 
                    empresas as e
                LEFT JOIN
                    funcionarios as f
                ON
                    f.empresas_Id = e.id
                LEFT JOIN
                    empresas_prolabores as ep
                ON
                    e.id = ep.empresas_id
                WHERE 
                    e.congelada = 0 
                AND 
                    e.saiu = 0
                AND
                    e.id NOT IN (SELECT
                                        emp.id
                                    FROM
                                        empresas as emp
                                    LEFT JOIN
                                        guias as g
                                    ON
                                        g.empresas_id = emp.id
                                    WHERE
                                        g.tipo = '$tipoGuia'
                                    AND
                                        g.data_competencia = '$competenciaAtual')
                AND
                        e.id IN (SELECT 
                                    emp.id
                                FROM	
                                    empresas as emp
                                LEFT JOIN
                                    empresas_liberacoes as el
                                ON
                                    emp.id = el.empresas_id
                                WHERE
                                    el.data_competencia = '$competenciaAtual'
                                OR
                                    emp.regime_tributario = 'Presumido')
                GROUP BY
                    e.id, e.nome_empresa, f.empresas_id
                ORDER BY
                    f.empresas_id DESC, e.id ASC";

        $retorno = mysqli_query($this->conexao, $query);
        $saida = [];

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $saida[] = $linha;
        }

        return $saida;
    }

    public function sistemaInsereSemGuia($empresasId, $tipo, $dataCompetencia)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dataUpload = date('Y-m-d H:i:s');

        $query = "INSERT INTO guias (
                        empresas_id, usuarios_id, tipo, data_competencia, data_upload, sem_guia
                    )
                    VALUES(
                        $empresasId,
                        6,
                        '{$tipo}',
                        '{$dataCompetencia}',
                        '{$dataUpload}',
                        1
                    );";

        return mysqli_query($this->conexao, $query);
    }

    public function getEmpresasSemFuncionario($dataCompetencia)
    {
        $query = "SELECT
                    DISTINCT (g.empresas_id)
                FROM
                    guias as g
                WHERE
                    data_competencia = '$dataCompetencia'
                AND
                    g.empresas_id NOT IN
                    (
                        SELECT empresas_id FROM funcionarios
                    )
                AND
                    g.empresas_id NOT IN
                    (
                        SELECT empresas_id FROM guias WHERE tipo = 'FGTS' AND data_competencia = '$dataCompetencia'
                    )";

        $retorno = mysqli_query($this->conexao, $query);
        $saida = [];

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $saida[] = $linha;
        }

        return $saida;
    }

    public function getEmpresasPendentesFgts($competencia)
    {
        $query = "SELECT 
                    DISTINCT(f.empresas_id) as id, emp.nome_empresa
                FROM 
                    funcionarios as f
                LEFT JOIN
                    empresas as emp
                ON
                    emp.id = f.empresas_id
                WHERE
                    f.empresas_id NOT IN (
                        SELECT 
                            g.empresas_id
                        FROM 
                            guias as g
                        LEFT JOIN
                            empresas as emp
                        ON
                            g.empresas_id = emp.id
                        WHERE 
                            g.data_competencia = '$competencia' 
                        AND 
                            g.tipo = 'FGTS'                        
                    )
                AND
                    emp.congelada = 0
                AND
                    emp.saiu = 0";

        $retorno = mysqli_query($this->conexao, $query);
        $empresas = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function getQuantidadeFgtsPendente($competencia)
    {
        $query = "SELECT
                    count(g.empresas_id) as totalUploads, (SELECT COUNT( DISTINCT empresas_id) as quantidade FROM funcionarios as f LEFT JOIN empresas as emp ON emp.id = f.empresas_id WHERE emp.congelada = 0 AND emp.saiu = 0 ) as totalFuncionario
                FROM
                    empresas as emp
                LEFT JOIN
                    guias as g
                ON
                    g.empresas_id = emp.id
                WHERE
                    g.tipo = 'FGTS'
                AND
                    emp.congelada = 0
                AND
                    emp.saiu = 0
                AND
                    g.data_competencia = '$competencia'
                AND
                    g.empresas_id IN (SELECT empresas_id from funcionarios)";

        $retorno = mysqli_query($this->conexao, $query);
        $resultado = mysqli_fetch_assoc($retorno);

        return $resultado['totalFuncionario'] - $resultado['totalUploads'];
    }

    public function _getGuiasMesCompetenciaRh($tipo, $dataCompetencia)
    {
        $query = "SELECT
                    	e.id, e.nome_empresa, f.empresas_Id
                    FROM
                    	empresas as e
                    LEFT JOIN
                        funcionarios as f
                    ON
                        f.empresas_Id = e.id
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = e.id
                    WHERE
                    	g.tipo = '$tipo'
                    AND
                        g.data_competencia = '$dataCompetencia'
                    GROUP BY
                        e.id, e.nome_empresa, f.empresas_id
                    ORDER BY
                        f.empresas_id DESC, e.id ASC";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasPendentesContador($tipoGuia, $dataCompetencia, $regimeTributario, $usuariosId)
    {
        $query = "SELECT
                    	e.id, e.nome_empresa, f.empresas_Id
                    FROM
                    	empresas as e
                    LEFT JOIN
                        funcionarios as f
                    ON
                        f.empresas_Id = e.id
                    LEFT JOIN
                    	contadores_empresas ce
                    ON
                    	e.id = ce.empresas_id
                    WHERE
                    	ce.usuarios_id = $usuariosId
                    AND
                        e.saiu = 0
                    AND
                        e.congelada = 0
                    AND
                        e.regime_tributario = '$regimeTributario'
                    AND
                        e.id NOT IN (SELECT
                                        emp.id
                                    FROM
                                        empresas as emp
                                    LEFT JOIN
                                        guias as g
                                    ON
                                        g.empresas_id = emp.id
                                    WHERE
                                        g.tipo = '$tipoGuia'
                                    AND
                                        g.data_competencia = '$dataCompetencia')
                    GROUP BY
                        e.id, e.nome_empresa, f.empresas_id
                    ORDER BY
                        f.empresas_id DESC, e.id ASC";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $guias[] = $empresa;
        }

        return $guias;
    }

    public function getTotalGuiasPendentes($tipoGuia, $dataCompetencia)
    {
        $query = "SELECT 
                    COUNT(id) as quantidade
                FROM 
                    empresas
                WHERE 
                    congelada = 0 
                AND 
                    saiu = 0
                AND
                    id NOT IN (SELECT
                                        emp.id
                                    FROM
                                        empresas as emp
                                    LEFT JOIN
                                        guias as g
                                    ON
                                        g.empresas_id = emp.id
                                    WHERE
                                        g.tipo = '$tipoGuia'
                                    AND
                                        g.data_competencia = '$dataCompetencia')";
        $retorno = mysqli_query($this->conexao, $query);
        $linha = mysqli_fetch_assoc($retorno);

        return $linha['quantidade'];
    }

    public function listaGuiasPendentes($tipoGuia, $dataCompetencia)
    {
        $query = "SELECT 
                    e.id, e.nome_empresa, f.empresas_id
                FROM 
                    empresas as e
                LEFT JOIN
                    funcionarios as f
                ON
                    f.empresas_Id = e.id
                WHERE 
                    e.congelada = 0 
                AND 
                    e.saiu = 0
                AND
                    e.id NOT IN (SELECT
                                        emp.id
                                    FROM
                                        empresas as emp
                                    LEFT JOIN
                                        guias as g
                                    ON
                                        g.empresas_id = emp.id
                                    WHERE
                                        g.tipo = '$tipoGuia'
                                    AND
                                        g.data_competencia = '$dataCompetencia')
                GROUP BY
                    e.id, e.nome_empresa, f.empresas_id
                ORDER BY
                    f.empresas_id DESC, e.id ASC";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $guias[] = $linha;
        }

        return $guias;
    }

    public function isGuiaExistente($empresasId, $tipoGuia, $dataCompetencia)
    {
        $query = "SELECT
                        empresas_id
                    FROM
                        guias
                    WHERE
                        tipo = '$tipoGuia'
                    AND
                        empresas_id = $empresasId
                    AND
                        data_competencia = '$dataCompetencia';";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function isGuiasDuplicadas($tipoGuia, $dataCompetencia)
    {
        $query = "SELECT
                        empresas_id
                    FROM
                        guias
                    WHERE
                        tipo = '$tipoGuia'
                    AND
                        data_competencia = '$dataCompetencia'
                    group by
                        empresas_id
                    having
                        count(*) > 1;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeGuiasPendentes($tipo)
    {
        $query = "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, emp.nome_empresa
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
                    GROUP BY emp.id
                    ;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_num_rows($retorno);
    }

    public function getGuiasRh($empresasId, $dataCompetencia)
    {
        // $dataCompetencia = '01/' . $dataCompetencia;
        // $dataCompetencia = str_replace('/', '-', $dataCompetencia);
        // $dataCompetenciaFormatada = new \DateTime($dataCompetencia);
        // $dataCompetencia = $dataCompetenciaFormatada->format('Y-m-d');

        $query = "SELECT
                    	empresas_id, tipo, data_competencia
                    FROM
                    	guias
                    WHERE
                        empresas_id = $empresasId
                    AND
                		tipo
                	IN
                		('INSS', 'IRRF', 'FGTS')
                    AND
                        data_competencia = '$dataCompetencia'
                    ;";
                    // echo $query;
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasEnviadas($tipo, $dataCompetencia)
    {
        $query = "SELECT
                    	emp.id, emp.nome_empresa, g.data_vencimento, g.data_competencia, g.data_upload, g.nome_guia, g.sem_guia, g.em_conjunto
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	g.tipo = '$tipo'
                    AND
                        g.data_competencia = '$dataCompetencia'
                    ;";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasEnviadasDomesticas($tipo)
    {
        $query = "SELECT
                        d.nome, gd.data_vencimento, gd.data_upload, gd.nome_guia, gd.sem_guia, gd.em_conjunto
                    FROM
                    	domesticas as d
                    LEFT JOIN
                        guias_domesticas as gd
                    ON
                        gd.domesticas_id = d.id
                    WHERE
                        gd.tipo = '$tipo'
                    ;";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getDomestiasGuiaPendente($tipo)
    {
        $query = "SELECT
                    	d.id, d.nome, d.cpf, d.responsaveis_domesticas_cpf
                    FROM                    	
                        domesticas as d
                    LEFT JOIN
                        responsaveis_domesticas as rd
                    ON
                    	d.responsaveis_domesticas_cpf = rd.cpf
                    WHERE NOT EXISTS 
                        (SELECT * FROM guias_domesticas as gd 
                        WHERE 
                            gd.domesticas_id = d.id 
                        AND 
                            gd.tipo = '$tipo')
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasEnviadasPorContador($tipo, $dataCompetencia, $usuariosId)
    {
        $query = "SELECT
                    	emp.id, emp.nome_empresa, g.data_vencimento, g.data_competencia, g.data_upload, g.nome_guia, g.sem_guia, g.em_conjunto
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    LEFT JOIN
                        contadores_empresas as ce
                    ON
                        emp.id = ce.empresas_id
                    WHERE
                    	g.tipo = '$tipo'
                    AND
                        ce.usuarios_id = $usuariosId
                    AND
                        g.data_competencia = '$dataCompetencia'
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasPendentes($tipo)
    {
        $query = "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, emp.nome_empresa
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
                    GROUP BY emp.id
                    ;";
        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasMesCompetencia($tipo, $dataCompetencia)
    {
        $query = "SELECT
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
                        g.data_competencia = '$dataCompetencia'
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    // Com a nova alteraçã de em_conjunto = 0
    public function getNomeGuiasAnexo($dataCompetencia, $empresasId)
    {
        $query = "SELECT
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
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasGestorMesCompetencia()
    {
        $query = "SELECT
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
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasPresumidoContadorMesCompetencia()
    {
        $query = "SELECT
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
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getGuiasRhMesCompetenciaPendentes($paginacaoInicio, $itensPorPagina)
    {
        $query = "SELECT id, nome_empresa from empresas WHERE id NOT IN (
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
        $query = "SELECT id from empresas WHERE id NOT IN (
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
    public function __getGuiasRhMesCompetencia()
    {
        $query = "SELECT
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
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function _getGuiasSnRhMesCompetencia()
    {
        $query = "SELECT
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
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getTodasGuiasMesCompetenciaSemMovimentacao($regimeTributario, $vinculo, $quantidadeGuias)
    {
        $query = "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, g.data_competencia
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	emp.congelada = 0
                    AND
                    	emp.saiu = 0
                    AND
                        emp.regime_tributario = '$regimeTributario'
                    AND
                        emp.vinculo = '$vinculo'
                    AND
                    	g.sem_guia = 1
                    GROUP BY 
                        emp.id, g.data_competencia
                    HAVING 
                        COUNT(emp.id) = $quantidadeGuias;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getTodasGuiasMesCompetencia($regimeTributario, $vinculo, $quantidadeGuias)
    {
        $query = "SELECT
                    	COUNT(emp.id) as quantidade, emp.id, g.data_competencia
                    FROM
                    	empresas as emp
                    LEFT JOIN
                    	guias as g
                    ON
                    	g.empresas_id = emp.id
                    WHERE
                    	YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                    	emp.congelada = 0
                    AND
                    	emp.saiu = 0
                    AND
	                    emp.regime_tributario = '$regimeTributario'
                    AND
	                    emp.vinculo = '$vinculo'
                    AND
                        emp.id NOT IN (SELECT
                                    emp.id
                                FROM
                                    empresas as emp
                                LEFT JOIN
                                    guias as g
                                ON
                                    g.empresas_id = emp.id
                                WHERE
                                    YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                                AND
                                    MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                                AND
                                    emp.congelada = 0
                                AND
                                    emp.saiu = 0
                                AND
                                    emp.regime_tributario = '$regimeTributario'
                                AND
                                    emp.vinculo = '$vinculo'
                                AND
                                    g.sem_guia = 1
                                GROUP BY 
                                    emp.id, g.data_competencia
                                HAVING 
                                    COUNT(emp.id) = $quantidadeGuias)
                    GROUP BY 
                        emp.id, g.data_competencia
                    HAVING 
                        COUNT(emp.id) = $quantidadeGuias;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function __getTodasGuiasMesCompetencia($regimeTributario)
    {
        $query = "SELECT
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
        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getQuantidadeGuiaPendenteMesContador($usuariosId, $tipoGuia, $regimeTributario, $dataCompetencia)
    {
        $query = "SELECT
                        COUNT(emp.id) as quantidade
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
                    	g.data_competencia = '$dataCompetencia'
                    AND
                    	g.usuarios_id = $usuariosId
                    ;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeGuiaPendenteMesPorEmpresa($tipo, $emrpesaId)
    {
        $query = "SELECT
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

    public function getQuantidadeGuiaPendenteMes($tipo)
    {
        $query = "SELECT
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

    public function __getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas($tipo)
    {
        $query = "SELECT
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
                        emp.congelada = 0
                    AND
                        YEAR(g.data_competencia) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)
                    AND
                        MONTH(g.data_competencia) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)
                    ;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeGuiaPendenteMesEmpresasNaoCongeladas($tipo, $dataCompetencia = '2018-11-01')
    {
        $query = "SELECT
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
                        emp.congelada = 0
                    AND
                        emp.saiu = 0
                    AND
                        g.data_competencia = '$dataCompetencia'                    
                    ;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function getQuantidadeGuiaPendenteMesEmpresasNaoCongeladasFuncionarios($tipo, $dataCompetencia = '2018-11-01')
    {
        $query = "SELECT DISTINCT
                        count(1) as quantidade
                    FROM
                        empresas as emp
                    LEFT JOIN
                        guias as g
                    ON
                        g.empresas_id = emp.id
                    LEFT JOIN
                        funcionarios as f
                    ON
                        f.empresas_id = emp.id
                    WHERE
                        g.tipo NOT IN (SELECT DISTINCT empresas_id FROM guias WHERE tipo = 'HOLERITE')
                    AND 
                        emp.id IN (SELECT DISTINCT empresas_id FROM funcionarios);";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function insereSemGuia($empresasId, $usuariosId, $tipo, $dataCompetencia, $semGuia)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dataUpload = date('Y-m-d H:i:s');

        $dataCompetencia = str_replace('/', '-', $dataCompetencia);
        $dataCompetencia = '01-' . $dataCompetencia;
        $dataCompetencia = date('Y-m-d', strtotime($dataCompetencia));

        $query = "INSERT INTO guias (
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

    public function insereSemGuiaDomesticas($domesticaId, $usuariosId, $tipo, $dataCompetencia, $semGuia)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dataUpload = date('Y-m-d H:i:s');

        // $dataCompetencia = str_replace('/', '-', $dataCompetencia);
        // $dataCompetencia = '01-'.$dataCompetencia;
        // $dataCompetencia = date('Y-m-d', strtotime($dataCompetencia));

        $query = "INSERT INTO guias_domesticas (
                        domesticas_id, usuarios_id, tipo, data_competencia, data_upload, sem_guia
                    )
                    VALUES(
                        $domesticaId,
                        $usuariosId,
                        '{$tipo}',
                        '{$dataCompetencia}',
                        '{$dataUpload}',
                        $semGuia
                    );";

        return mysqli_query($this->conexao, $query);
    }

    public function insereGuia($empresasId, $tipo, $dataVencimento, $dataCompetencia, $usuariosId, $nomeGuia, $conjunto)
    {
        $emConjunto = ($conjunto == '') ? 'false' : 'true';

        $dataVencimento = ($dataVencimento == '') ? 'null' : "'" . $dataVencimento . "'";

        date_default_timezone_set('America/Sao_Paulo');
        $dataUpload = date('Y-m-d H:i:s');

        $dataCompetencia = str_replace('/', '-', $dataCompetencia);
        $dataCompetencia = '01-' . $dataCompetencia;
        $dataCompetencia = date('Y-m-d', strtotime($dataCompetencia));

        $query = "INSERT INTO guias (
                        empresas_id, tipo, data_vencimento, data_competencia, data_upload, usuarios_id, nome_guia, em_conjunto
                    )
                    VALUES(
                        $empresasId,
                        '{$tipo}',
                        $dataVencimento,
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

    public function insereGuiaDomesticas($domesticaId, $tipo, $dataVencimento, $dataCompetencia, $usuariosId, $nomeGuia, $conjunto)
    {
        $emConjunto = ($conjunto == '') ? 'false' : 'true';

        date_default_timezone_set('America/Sao_Paulo');
        $dataUpload = date('Y-m-d H:i:s');

        // $dataCompetencia = str_replace('/', '-', $dataCompetencia);
        // $dataCompetencia = '01-'.$dataCompetencia;
        // $dataCompetencia = date('Y-m-d', strtotime($dataCompetencia));

        $query = "INSERT INTO guias_domesticas (
                        domesticas_id, tipo, data_vencimento, data_competencia, data_upload, usuarios_id, nome_guia, em_conjunto
                    )
                    VALUES(
                        $domesticaId,
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

    public function getFuncionarioMesCompetencia($tipo, $dataCompetencia)
    {
        $query = "SELECT DISTINCT 
                        emp.id, emp.nome_empresa
                    FROM 
                        empresas as emp 
                    JOIN 
                        funcionarios as f
                    ON 
                        f.empresas_id = emp.id
                    WHERE NOT EXISTS 
                        (SELECT * FROM guias as g 
                        WHERE 
                            g.empresas_id = emp.id 
                        AND 
                            g.tipo = 'HOLERITE');";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }

    public function getFuncionarioMesCompetenciaAlt($tipo, $dataCompetencia)
    {
        $query = "SELECT
                        emp.id, emp.nome_empresa
                    FROM
                        empresas as emp
                    LEFT JOIN
                        guias as g
                    ON
                        g.empresas_id = emp.id
                    LEFT JOIN
                        funcionarios as f
                    ON
                        f.empresas_id = emp.id
                    WHERE
                        g.tipo = '$tipo'
                    AND
                        g.data_competencia = '$dataCompetencia'
                    AND 
                        f.empresas_id = emp.id;";

        $retorno = mysqli_query($this->conexao, $query);
        $guias = array();

        while ($guia = mysqli_fetch_assoc($retorno)) {
            $guias[] = $guia;
        }

        return $guias;
    }
}