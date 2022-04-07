<?php
namespace App\Model\Inconsistencia;

use App\Config\BancoConfig;

class EmpresaCadastroInconsistencia
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getAll($condicao = '')
    {
        $query =    "SELECT
                        i.empresas_id, t.titulo, t.descricao, i.status, t.prioridade, t.cor, e.nome_empresa
                    FROM
                        inconsistencias as i
                    LEFT JOIN
                        tipos_inconsistencias as t
                    ON
                        i.tipos_inconsistencias_id = t.id
                    LEFT JOIN
                        empresas as e
                    ON
                        i.empresas_id = e.id
                    $condicao
                    ;";
        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }
    public function getQuantidadeInconsistencias()
    {
        $query = "SELECT COUNT(id) as quantidade FROM inconsistencias WHERE status = 'PENDENTE';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function insereInconsistenciaEmpresa($empresasId, $tipo, $status)
    {
        $retorno = $this->isInconsistenciaEmpresa($empresasId, $tipo, $status);

        if ($retorno != null) {
            return;
        }

        $query = "INSERT INTO inconsistencias (
                    empresas_id, tipos_inconsistencias_id, status, created_at
                ) VALUES (
                    $empresasId, $tipo, '$status', NOW()
                );";

        return mysqli_query($this->conexao, $query);
    }

    public function updateInconsistenciaEmpresa($empresasId, $tipo, $status)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $statusExistente = ($status == 'FINALIZADA') ? 'PENDENTE' : 'FINALIZADA';

        $retorno = $this->isInconsistenciaEmpresa($empresasId, $tipo, $statusExistente);

        if ($retorno == null) {
            return;
        }

        $query = "UPDATE inconsistencias SET status = '$status', updated_at = '$now' WHERE empresas_id = $empresasId AND tipos_inconsistencias_id = $tipo;";
        
        return mysqli_query($this->conexao, $query);
    }

    public function isInconsistenciaEmpresa($empresasId, $tipo, $status)
    {
        $query = "SELECT * FROM inconsistencias WHERE empresas_id = $empresasId AND status = '$status' AND tipos_inconsistencias_id = $tipo;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }
}
