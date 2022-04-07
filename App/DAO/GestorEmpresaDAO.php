<?php

namespace App\DAO;
use App\Config\BancoConfig;

class GestorEmpresaDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    public function insereGestorEmpresa($empresasId, $usuariosId){
        $query = "INSERT INTO gestores_empresas (empresas_id, usuarios_id) VALUES ($empresasId, $usuariosId);";

        $retorno['resultado'] = mysqli_query($this->conexao, $query);
        $retorno['gestores_empresas_id'] = mysqli_insert_id($this->conexao);

        return $retorno;
    }

    public function getGestorIdEmpresa($empresasId)
    {
        $query = "SELECT usuarios_id FROM gestores_empresas WHERE empresas_id = $empresasId;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }
}
