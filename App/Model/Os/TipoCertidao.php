<?php
namespace App\Model\Os;

use App\Config\BancoConfig;

class TipoCertidao
{    
    private $id;
    private $nome;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function all()
    {
        $query = "SELECT * FROM tipos_certidoes;";
        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = [];

        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas [] = $linha;
        }

        return $linhas;
    }

    public function getTipoCertidao($id)
    {
        $query = "SELECT nome, descricao_emissao FROM tipos_certidoes WHERE id = $id;";
        $retorno = \mysqli_query($this->conexao, $query);

        return \mysqli_fetch_assoc($retorno);
    }

}