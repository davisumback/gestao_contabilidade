<?php

namespace App\DAO;
use App\Config\BancoConfig;

class EmpresaUsuarioCongDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    public function setCongelamento($empresasID, $usuariosId, $congelamento, $dataCompetencia){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');

        $congelamento = ($congelamento) ? 0 : 1;

        $query = "  INSERT INTO empresas_usuarios_cong (
                        empresas_id, usuarios_id, congelada, data_congelamento, data_competencia
                    )
                    VALUES (
                        $empresasID,
                        $usuariosId,
                        $congelamento,
                        '{$data}',
                        '{$dataCompetencia}'
                    );";

        return mysqli_query($this->conexao, $query);
    }

    public function isEmpresaCongelada($idEmpresa){
        $query = "SELECT * FROM empresas_usuarios_cong WHERE empresas_id = $idEmpresa ORDER BY data_competencia DESC LIMIT 1;";
        $retorno = mysqli_query($this->conexao, $query);
        $resultado = mysqli_fetch_assoc($retorno);

        return $resultado['congelada'];
    }


    public function OLDsetCongelamento($empresasID, $usuariosId, $congelamento){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');

        $query = " SELECT COUNT(*) as existe FROM empresas_usuarios_cong WHERE empresas_id = $empresasID";
        $retorno = mysqli_query($this->conexao, $query);
        $resultado = mysqli_fetch_assoc($retorno);

        $congelamento = ($congelamento) ? 0 : 1;

        if($resultado['existe'] == 1){

            $query = "  UPDATE empresas_usuarios_cong
                        SET
                            congelada = $congelamento,
                            data = '{$data}'
                        WHERE
                            empresas_id = $empresasID
                        ;";
        }else {
            $query = "  INSERT INTO empresas_usuarios_cong (
                            empresas_id, usuarios_id, congelada, data
                        )
                        VALUES (
                            $empresasID,
                            $usuariosId,
                            $congelamento,
                            '{$data}'
                        );";
        }

        return mysqli_query($this->conexao, $query);
    }

    public function OLDisEmpresaCongelada($idEmpresa){
        $query = "SELECT * FROM empresas_usuarios_cong WHERE empresas_id = $idEmpresa ORDER BY data_competencia DESC LIMIT 1;";
        $retorno = mysqli_query($this->conexao, $query);
        $resultado = mysqli_fetch_assoc($retorno);

        return $resultado['congelada'];
    }

}
