<?php

namespace App\DAO;
use App\Config\BancoConfig;

class GuiaDataPadraoDAO{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getDataPadraoGuia($guia)
    {
        $query = "SELECT * FROM guias_datas_padrao WHERE tipo = '$guia';";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function updateDataGuia($tipo, $dataVencimento)
    {
        $query = "  UPDATE
                        guias_datas_padrao
                    SET
                        dia_vencimento = $dataVencimento
                    WHERE
                        tipo = '$tipo'
                    ;";

        return mysqli_query($this->conexao, $query);
    }
}
