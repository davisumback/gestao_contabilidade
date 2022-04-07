<?php
namespace App\DAO;
use App\Config\BancoConfig;

class InconsistenciaDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
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

    public function isInconsistenciaEmpresa($empresasId, $tipo, $status)
    {
        $query = "SELECT * FROM inconsistencias WHERE empresas_id = $empresasId AND status = '$status' AND tipos_inconsistencias_id = $tipo;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }
}
