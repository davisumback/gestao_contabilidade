<?php

namespace App\DAO;

use App\Config\BancoConfig;

class EmpresaGuiaEmailDAO
{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function updateReenvioEmailGuia($dataCompetencia, $empresasId)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dataHora = date('Y-m-d H:i:s');

        $query = "UPDATE
                    	empresas_emails_guias_reenvio
                    SET
                    	data_hora = '$dataHora',
                        email_enviado = 1
                    WHERE
                    	data_competencia = '$dataCompetencia'
                    AND
                    	empresas_id = $empresasId
                    ;";

        return mysqli_query($this->conexao, $query);
    }

    public function getEmpresasEmails($dataCompetencia)
    {
        $query = "SELECT
                    	eeg.empresas_id, eeg.data_hora, eeg.data_competencia, eeg.email_enviado, emp.nome_empresa
                    FROM
                    	empresas_emails_guias as eeg
                    LEFT JOIN
                    	empresas as emp ON emp.id = eeg.empresas_id
                    WHERE
                        eeg.data_competencia = '$dataCompetencia'
                    AND
                       eeg.sem_movimento IS NULL
                    ORDER BY
                        eeg.empresas_id
                    ASC
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresas = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function getEmpresasPendetesDeEmail($dataCompetencia)
    {
        $query = "SELECT
                    	empresas_id
                    FROM
                    	empresas_emails_guias
                    WHERE
                    	email_enviado = 0
                    AND
                        sem_movimento IS NULL
                    AND
                    	data_competencia = '$dataCompetencia'
                    LIMIT 5;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresas = array();

        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function __getEmpresasPendetesDeEmail($dataCompetencia)
    {
        $query = "SELECT eeg.empresas_id, eeg.data_competencia, cli.email, cli.nome_completo, u.email as email_gestor
                    FROM
                    	empresas_emails_guias as eeg
                    LEFT JOIN
                    	clientes_empresas as cliemp
                    ON
                    	cliemp.empresas_id = eeg.empresas_id
                    LEFT JOIN
                    	clientes as cli
                    ON
                    	cli.id = cliemp.clientes_id
                    LEFT JOIN
                    	gestores_empresas as ge
                    ON
                    	ge.empresas_id = eeg.empresas_id
                    LEFT JOIN
                    	usuarios as u
                    ON
                    	u.id = ge.usuarios_id
                    WHERE
                    	eeg.email_enviado = 0
                    AND
                    	eeg.data_competencia = '$dataCompetencia'
                    AND
                        eeg.sem_movimento IS NULL
                    AND
                    	cli.socio_administrador = 1
                    LIMIT 5;";

        $retorno = mysqli_query($this->conexao, $query);
        $empresas = array();
        while ($empresa = mysqli_fetch_assoc($retorno)) {
            $empresas[] = $empresa;
        }

        return $empresas;
    }

    public function updateEmailGuia($dataCompetencia, $empresasId)
    {
        date_default_timezone_set('America/Sao_Paulo');
        $dataHora = date('Y-m-d H:i:s');

        $query = "UPDATE
                    	empresas_emails_guias
                    SET
                    	data_hora = '$dataHora',
                        email_enviado = 1
                    WHERE
                    	data_competencia = '$dataCompetencia'
                    AND
                    	empresas_id = $empresasId
                    ;";

        return mysqli_query($this->conexao, $query);
    }

    public function insereEmailGuia($empresasId, $dataCompetencia)
    {
        $query = "  SELECT
                        empresas_id, data_competencia
                    FROM
                        empresas_emails_guias
                    WHERE
                        empresas_id = $empresasId
                    AND
                        data_competencia = '$dataCompetencia'
                    ;";

        $retorno = mysqli_query($this->conexao, $query);

        if (mysqli_fetch_assoc($retorno)) {
            return false;
        } else {
            $query = "INSERT INTO empresas_emails_guias (empresas_id, data_competencia) VALUES ($empresasId, '$dataCompetencia');";

            return mysqli_query($this->conexao, $query);
        }
    }

    public function insereEmailGuiaSemMovimentacao($empresasId, $dataCompetencia)
    {
        $query = "  SELECT
                        empresas_id, data_competencia
                    FROM
                        empresas_emails_guias
                    WHERE
                        empresas_id = $empresasId
                    AND
                        data_competencia = '$dataCompetencia'
                    ;";

        $retorno = mysqli_query($this->conexao, $query);

        if (mysqli_fetch_assoc($retorno)) {

            return false;
        } else {
            $query = "INSERT INTO empresas_emails_guias (empresas_id, data_competencia, sem_movimento) VALUES ($empresasId, '$dataCompetencia', 1);";

            return mysqli_query($this->conexao, $query);
        }
    }
}
