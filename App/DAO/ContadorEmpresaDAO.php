<?php

namespace App\DAO;
use App\Config\BancoConfig;

class ContadorEmpresaDAO
{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function insereContadorEmpresa($empresasId, $usuariosId)
    {
        $query = "INSERT INTO contadores_empresas (empresas_id, usuarios_id) VALUES ($empresasId, $usuariosId);";

        $retorno['resultado'] = mysqli_query($this->conexao, $query);
        $retorno['contadores_empresas_id'] = mysqli_insert_id($this->conexao);

        return $retorno;
    }

    public function getContadorEmpresa($empresasId)
    {
        $query = "SELECT usuarios_id as contadorId FROM contadores_empresas WHERE empresas_id = $empresasId;";
        $retorno = \mysqli_query($this->conexao, $query);

        return \mysqli_fetch_assoc($retorno);
    }
}