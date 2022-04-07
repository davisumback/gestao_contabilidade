<?php

namespace App\DAO;
use App\Config\BancoConfig;

class GuiaRecalculoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function insereRecalculoGuia($empresasId, $guiaTipo, $dataVencimento, $dataCompetencia, $usuariosId, $guiaNome, $ordensDeServicosId = null)
    {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO guias_recalculos (
            empresas_id, tipo, data_vencimento, data_competencia, data_upload, usuarios_id, nome_guia, ordens_de_servicos_id
        ) VALUES (
            $empresasId,
            '$guiaTipo',
            '$dataVencimento',
            '$dataCompetencia',
            '$now',
            $usuariosId,
            '$guiaNome',
            $ordensDeServicosId
        );";

        return \mysqli_query($this->conexao, $query);
    }   
}
