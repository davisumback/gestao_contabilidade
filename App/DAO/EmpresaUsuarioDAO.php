<?php

namespace App\DAO;
use App\Config\BancoConfig;

class EmpresaUsuarioDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    public function insereEmpresaUsuario($empresasId, $usuariosId){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        $query = "INSERT INTO empresas_usuarios (empresas_id, usuarios_id, data_cadastro) VALUES ($empresasId, $usuariosId, '{$data}');";

        return mysqli_query($this->conexao, $query);
    }
}
