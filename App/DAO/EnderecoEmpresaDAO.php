<?php

namespace App\DAO;
use App\Entidade\EnderecoEmpresa;
use App\Entidade\EnderecoCliente;
use App\Config\BancoConfig;

class EnderecoEmpresaDAO{
    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    public function getEnderecoEmpresa($numeroEmpresa){
        $query = "SELECT * FROM endereco_empresa WHERE empresas_id = $numeroEmpresa;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function setEnderecoEmpresa(EnderecoEmpresa $enderecoEmpresa){
        $complemento = ($enderecoEmpresa->getComplemento() == '') ? 'null' : "'" .$enderecoEmpresa->getComplemento(). "'";

        $query = "  INSERT INTO endereco_empresa (
                        iptu, cep, logradouro, numero, bairro, cidade, uf, complemento, empresas_id
                    )
                    VALUES (
                        '{$enderecoEmpresa->getIPTU()}',
                        '{$enderecoEmpresa->getCep()}',
                        '{$enderecoEmpresa->getLogradouro()}',
                        '{$enderecoEmpresa->getNumero()}',
                        '{$enderecoEmpresa->getBairro()}',
                        '{$enderecoEmpresa->getCidade()}',
                        '{$enderecoEmpresa->getUf()}',
                        $complemento,
                        {$enderecoEmpresa->getEmpresasId()}
                    );";

        $dados['resultado'] =  mysqli_query($this->conexao, $query);
        $dados['endereco_empresa_id'] =  mysqli_insert_id($this->conexao);

        return $dados;
    }

    public function insereEnderecoEmpresa(EnderecoCliente $enderecoCliente, $empresaNumero){
        $complemento = ($enderecoCliente->getComplemento() == '') ? 'null' : "'" .$enderecoCliente->getComplemento(). "'";

        $query = "  INSERT INTO endereco_empresa (
                        iptu, cep, logradouro, numero, bairro, cidade, uf, complemento, empresas_id
                    )
                    VALUES (
                        '{$enderecoCliente->getIPTU()}',
                        '{$enderecoCliente->getCep()}',
                        '{$enderecoCliente->getLogradouro()}',
                        '{$enderecoCliente->getNumero()}',
                        '{$enderecoCliente->getBairro()}',
                        '{$enderecoCliente->getCidade()}',
                        '{$enderecoCliente->getUf()}',
                        $complemento,
                        $empresaNumero
                    );";

        $dados['resultado'] =  mysqli_query($this->conexao, $query);
        $dados['enderecoEmpresaId'] =  mysqli_insert_id($this->conexao);

        return $dados;
    }
}
