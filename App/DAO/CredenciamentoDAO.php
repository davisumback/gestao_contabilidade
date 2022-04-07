<?php

namespace App\DAO;
use App\Config\BancoConfig;

class CredenciamentoDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getDadosCredenciamento($ordensDeServicosId)
    {
        $query = "SELECT
                    c.empresas_id, c.ordens_de_servicos_id, c.pasta, c.edital, cp.valor, cp.descricao
                FROM
                    credenciamentos as c
                LEFT JOIN
                    credenciamentos_propostas as cp
                ON
                    c.id = cp.credenciamentos_id
                WHERE
                    c.ordens_de_servicos_id = $ordensDeServicosId;";

        $retorno = \mysqli_query($this->conexao, $query);
        $linhas = array();

        while($linha = \mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }

    public function insereCredencimaneto($empresasId, $ordensDeServicosId, $pasta, $edital)
    {
        $empresasId = ($empresasId == null) ? 'null' : $empresasId;
        $ordensDeServicosId = ($empresasId == null) ? 'null' : $ordensDeServicosId;

        $date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
        $now = $date->format('Y-m-d H:i:s');

        $query = "INSERT INTO credenciamentos (
                    empresas_id, ordens_de_servicos_id, pasta, edital, created_at
                ) VALUES (
                    $empresasId, 
                    $ordensDeServicosId,
                    '$pasta',
                    '$edital',
                    '$now'
                )";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro ao salvar o Credenciamento.", 1);
        }

        return \mysqli_insert_id($this->conexao);
    }
    
    public function inserePropostaCredenciamento($credenciamentosId, $valor, $descricao)
    {
        $query = "INSERT INTO credenciamentos_propostas (
                    credenciamentos_id, valor, descricao
                ) VALUES (
                    $credenciamentosId, 
                    $valor,
                    '$descricao'
                )";

        if (\mysqli_query($this->conexao, $query) == false) {
            throw new \Exception("Erro a(s) proposta(s) do Credenciamento.", 1);
        }
    }
}