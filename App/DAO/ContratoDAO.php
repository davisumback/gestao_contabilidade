<?php

namespace App\DAO;
use App\Entidade\Contrato;
use App\Config\BancoConfig;

class ContratoDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    function insereContrato(Contrato $contrato){
        $primeiraMensalidade = ($contrato->getPrimeiraMensalidade() == '') ? 'null' : "'" .$contrato->getPrimeiraMensalidade(). "'";

        $query = "INSERT INTO contratos (dia_vencimento, primeira_mensalidade, empresas_id)
                    VALUES (
                        {$contrato->getDiaVencimento()},
                        $primeiraMensalidade,
                        {$contrato->getEmpresasId()}
                    );";

        $retorno['resultado'] = mysqli_query($this->conexao, $query);
        $retorno['contratos_id'] = mysqli_insert_id($this->conexao);

        return $retorno;
    }

    function getNumeroClientesPendentes(){
        $query = "SELECT COUNT(id) as quantidade FROM clientes WHERE cadastro_completo = 0;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    function getClientesPendentes(){
        $clientes = array();
        $query = "  SELECT
                        c.nome_completo, c.cpf, c.email, cliu.data_cadastro
                    FROM
                        clientes as c
                    LEFT JOIN
                        cliente_usuario as cliu
                    ON
                        c.id = cliu.clientes_id
                    WHERE
                        cadastro_completo = 0;";
        $retorno = mysqli_query($this->conexao, $query);

        while($cliente = mysqli_fetch_assoc($retorno)){
            array_push($clientes, $cliente);
        }

        return $clientes;
    }
}
