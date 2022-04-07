<?php

namespace App\DAO;
use App\Config\BancoConfig;

class TipoUsuarioDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getUsuariosPorTipo($tipoUsuarioId)
    {
        $query = "SELECT 
                    u.id
                FROM 
                    tipo_usuario as tu
                LEFT JOIN
                    usuarios as u
                ON
                    tu.id = u.tipo
                WHERE
                    tu.tipo = $tipoUsuarioId
                AND
                    u.ativo = 1;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = [];

        while($perfil = mysqli_fetch_assoc($retorno)){
            $linhas [] = $perfil;
        }

        return $linhas;
    }

    public function getPerfis()
    {
        $perfis = array();
        $query = "SELECT * FROM tipo_usuario";
        $retorno = mysqli_query($this->conexao, $query);

        while($perfil = mysqli_fetch_assoc($retorno)){
            array_push($perfis, $perfil);
        }

        return $perfis;
    }
}
