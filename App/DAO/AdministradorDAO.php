<?php

namespace App\DAO;
use App\Config\BancoConfig;

class AdministradorDAO{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    function getNumeroPreCadastrados()
    {
        $query = "SELECT * FROM cliente_usuario;";

        $retorno = mysqli_query($this->conexao, $query);
        return mysqli_num_rows($retorno);
    }

    function getNumeroTodasNotas()
    {
        $query = "SELECT COUNT(id) as quantidade FROM notas;";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    function getNumeroNotasPorData($data)
    {
        $query = "SELECT COUNT(id) as quantidade FROM notas WHERE data_retorno = '$data';";

        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    // public function getNumeroNotas($vendedor_id){
    //     $query = "SELECT * FROM notas WHERE usuarios_id = $vendedor_id;";
    //
    //     $retorno = mysqli_query($this->conexao, $query);  
    //
    //     return mysqli_num_rows($retorno);
    // }

    function getClientesCadastrados($vendedor_id)
    {
        $clientes_array = array();
        $query = "  SELECT c.id, c.cpf, c.nome_completo, cliu.data_cadastro, p.aceitou FROM cliente_usuario as cliu
                    LEFT JOIN
                        clientes as c
                    ON
                        cliu.clientes_id = c.id
                    LEFT JOIN
                        propostas as p
                    ON
                        c.cpf = p.cpf_cliente
                    WHERE
                        cliu.usuarios_id = $vendedor_id;
                    ;";

        $retorno = mysqli_query($this->conexao, $query);
        while($cliente = mysqli_fetch_assoc($retorno)){
            array_push($clientes_array, $cliente);
        }

        return $clientes_array;
    }
}
