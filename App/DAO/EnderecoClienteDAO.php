<?php

namespace App\DAO;
use App\Entidade\EnderecoCliente;
use App\Config\BancoConfig;

class EnderecoClienteDAO{
    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    public function insereEnderecoCliente(EnderecoCliente $enderecoCliente){
        $complemento = ($enderecoCliente->getComplemento() == '') ? 'null' : "'" .$enderecoCliente->getComplemento(). "'";
        $iptu = ($enderecoCliente->getIptu() == '') ? 'null' : "'" .$enderecoCliente->getIptu(). "'";

        $query = "  INSERT INTO endereco_cliente (
                        clientes_id, iptu, cep, logradouro, numero, bairro, cidade, uf, complemento
                    )
                    VALUES (
                        {$enderecoCliente->getClientesId()},
                        $iptu,
                        '{$enderecoCliente->getCep()}',
                        '{$enderecoCliente->getLogradouro()}',
                        '{$enderecoCliente->getNumero()}',
                        '{$enderecoCliente->getBairro()}',
                        '{$enderecoCliente->getCidade()}',
                        '{$enderecoCliente->getUf()}',
                        $complemento
                    );";

        return mysqli_query($this->conexao, $query);
    }
}
