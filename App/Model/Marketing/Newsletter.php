<?php
namespace App\Model\Marketing;

use App\Config\BancoConfig;

class Newsletter
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getAll()
    {
        $query = "SELECT * FROM contatos_newsletter;";
        $clientes = array();
        $retorno = \mysqli_query($this->conexao, $query);

        while ($cliente = \mysqli_fetch_assoc($retorno)) {
            $clientes [] = $cliente;
        }

        return $clientes;
    }
    
    public function getAllQtd()
    {
        $query = "SELECT count(id) as quantidade FROM contatos_newsletter;";
        $retorno = \mysqli_query($this->conexao, $query);
        return mysqli_fetch_assoc($retorno);
    } 
}