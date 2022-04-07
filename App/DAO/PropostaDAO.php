<?php

namespace App\DAO;
use App\Entidade\Proposta;

class PropostaDAO{
    private $conexao;

    function __construct($conexao){
        $this->conexao = $conexao;
    }

    function verificaAceiteProposta($id){
        $id_cliente = mysqli_real_escape_string($this->conexao, $id);
        $query = "  SELECT
                        p.cpf_cliente, p.aceitou, c.data_nascimento, c.nome_completo, c.email
                    FROM
                        propostas as p
                    LEFT JOIN
                        clientes as c
                    ON
                        c.cpf=p.cpf_cliente
                    WHERE
                        c.id = {$id_cliente}
                    ;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    function alteraAceiteProposta($aceite, $cpf){
        $query = "UPDATE propostas SET aceitou = $aceite WHERE cpf_cliente = '{$cpf}';";

        return mysqli_query($this->conexao, $query);
    }

    function insereProposta(Proposta $proposta){
        $query = "  INSERT INTO propostas (
                        titulo, corpo, cpf_cliente, padrao
                    )
                    VALUES (
                        '{$proposta->getTitulo()}',
                        '{$proposta->getCorpo()}',
                        '{$proposta->getCpf()}',
                        0
                    );";

        return mysqli_query($this->conexao, $query);
    }

    function getPropostaPadrao($id_proposta){
        $query = "SELECT * FROM propostas WHERE id = '{$id_proposta}'";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    function getProposta($cpf){
        $query = "SELECT * FROM propostas WHERE cpf_cliente = '{$cpf}'";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }
}
