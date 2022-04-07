<?php

namespace App\DAO;
use App\Config\BancoConfig;

class PlanoDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    public function alteraPlano($nome, $valor, $id){
        $query = "  UPDATE planos
                    SET
                        nome = '$nome',
                        valor = $valor
                    WHERE
                        id = $id;";

        return mysqli_query($this->conexao, $query);
    }

    public function deletaPlano($id){
        $query = "  DELETE FROM planos WHERE id = $id;";

        return mysqli_query($this->conexao, $query);
    }

    function getTodosPlanos(){
        $planos_array = array();
        $query = "SELECT * FROM planos;";
        $retorno = mysqli_query($this->conexao, $query);

        while ($plano = mysqli_fetch_assoc($retorno)) {
            array_push($planos_array, $plano);
        }

        return $planos_array;
    }

    function inserePlano($nomePlano, $valorPlano) {
        $query = "INSERT INTO planos (nome, valor) VALUES ('{$nomePlano}', $valorPlano);";
        echo $query;

        return mysqli_query($this->conexao, $query);
    }
}
