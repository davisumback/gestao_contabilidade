<?php

namespace App\DAO;
use App\Config\BancoConfig;

class TesteDAO{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function ativaDesativaApi($id, $status)
    {
        $query = "UPDATE apis SET ativo = $status WHERE id = $id;";

        return mysqli_query($this->conexao, $query);
    }   
}
