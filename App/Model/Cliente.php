<?php
namespace App\Model;

use App\Config\BancoConfig;

class Cliente
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getAll()
    {
        $query = "SELECT nome_completo, cpf, email, telefone_comercial, telefone_celular FROM clientes;";
        $clientes = array();
        $retorno = \mysqli_query($this->conexao, $query);

        while ($cliente = \mysqli_fetch_assoc($retorno)) {
            $clientes [] = $cliente;
        }

        return $clientes;
    }        
}