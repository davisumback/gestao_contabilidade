<?php

namespace App\DAO;
use App\Config\BancoConfig;

class ClienteUsuarioDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    public function insereClienteUsuario($clientesId, $usuariosId){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        $query = "INSERT INTO cliente_usuario (clientes_id, usuarios_id, data_cadastro) VALUES ($clientesId, $usuariosId, '{$data}');";

        $dados['resultado'] =  mysqli_query($this->conexao, $query);
        $dados['clienteUsuarioId'] =  mysqli_insert_id($this->conexao);

        return $dados;
    }
}
