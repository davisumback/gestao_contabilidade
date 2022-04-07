<?php

namespace App\DAO;
use App\Config\BancoConfig;

class ContatoSiteDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getQuantidadeContatos($usuariosId, $site, $isAntedido)
    {
        $query = "SELECT 
                    COUNT(id) as quantidade
                FROM
                    contatos_site
                WHERE
                    atendido = '$isAntedido'
                AND
                    site = '$site'
                AND
                    usuarios_id = $usuariosId
                GROUP BY atendido";     

        $retorno = \mysqli_query($this->conexao, $query);        
        $linha = \mysqli_fetch_assoc($retorno);

        if ($linha['quantidade'] == null) {
            return 0;
        }

        return $linha['quantidade'];
    }

    public function getContatosSite($usuariosId, $site, $isAntedido)
    {
        $query = "SELECT 
                    id, atendido, telefone_ddd, telefone_numero, created_at, updated_at
                FROM
                    contatos_site
                WHERE
                    usuarios_id = $usuariosId
                AND
                    atendido = '$isAntedido'
                AND
                    site = '$site';";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = array();
        
        while ($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function avisaAtendimento($attributes) {
        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "UPDATE contatos_site SET atendido = 'SIM', updated_at = '$now' WHERE id = {$attributes['contatosId']};";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new Exception("Erro ao avisar que esse contato foi atendido.", 1);            
        }
    }
}
