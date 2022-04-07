<?php

namespace App\DAO;
use App\Config\BancoConfig;

class ApiDAO
{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getDadosApi($nome)
    {
        $query = "SELECT id, 
                    IF(ativo = 1, url, url_teste) as url,
                    IF(ativo = 1, token, token_teste) as token,
                    ativo
                FROM 
                    apis
                WHERE
                    nome = '$nome';";
                
        $retorno = \mysqli_query($this->conexao, $query);

        return \mysqli_fetch_assoc($retorno);
    }

    public function getInsercoesEmpresasEmails()
    {
        $query =    "SELECT
                    	cliemp.clientes_id as clientesId, cliemp.empresas_id as empresasId, ges.usuarios_id as gestoresId, cli.email
                    FROM
                    	clientes_empresas as cliemp
                    LEFT JOIN
                    	clientes as cli
                    ON
                    	cliemp.clientes_id = cli.id
                    LEFT JOIN
                    	gestores_empresas as ges
                    ON
                    	cliemp.empresas_id = ges.empresas_id
                    WHERE
                    	cliemp.socio_administrador = 1;";

        $retorno = mysqli_query($this->conexao, $query);
        $saida = [];

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $saida[] = $linha;
        }

        return $saida;
    }

    public function insertEmpresasEmails($empresasId, $usuariosId, $email)
    {
        $query = "INSERT INTO empresas_emails (empresas_id, usuarios_id, email) VALUES ($empresasId, $usuariosId, '$email');";

        return mysqli_query($this->conexao, $query);

    }

    public function getClientesComUmaEmpresa()
    {
        $query =    "SELECT id, socio_administrador from clientes WHERE id NOT IN (78, 79, 88, 93, 152, 153, 256, 276, 296, 297, 298, 578, 666)";
        $retorno = mysqli_query($this->conexao, $query);

        $saida = [];
        while ($linha = mysqli_fetch_assoc($retorno)) {
            $saida[] = $linha;
        }

        return $saida;
    }

    public function imprime()
    {
        $query =    "SELECT
                    	clientes_id
                    FROM
                    	clientes_empresas
                    group by
                    	clientes_id
                    having
                    	count(*) > 1;";

        $retorno = mysqli_query($this->conexao, $query);

        $saida = [];
        while ($linha = mysqli_fetch_assoc($retorno)) {
            $saida[] = $linha;
        }

        return $saida;
    }

    function teste()
    {
        $query = "SELECT
                	SUM(p.valor) as somatorio
                FROM
                	empresas as emp
                LEFT JOIN
                	empresas_planos as ep
                ON
                	emp.id = ep.empresas_id
                LEFT JOIN
                	planos as p
                ON
                	ep.planos_id = p.id
                WHERE
                	emp.congelada = 0
                GROUP BY emp.id";
        $retorno = mysqli_query($this->conexao, $query);

        $apis = array();
        while($api = mysqli_fetch_assoc($retorno)) {
            $apis[] = $api;
        }

        return $apis;
    }

    public function __salvaJson($json, $ganhou){

        $query = "INSERT INTO pipedrive_teste (json, ganhou, horario) VALUES ('$json', '$ganhou', NOW());";

        return mysqli_query($this->conexao, $query);
    }

    public function ativaDesativaApi($id, $status)
    {
        $query = "UPDATE apis SET ativo = $status WHERE id = $id;";

        return mysqli_query($this->conexao, $query);
    }

    public function getTodasApis()
    {
        $query = "SELECT * FROM apis;";
        $retorno = mysqli_query($this->conexao, $query);

        $apis = array();
        while($api = mysqli_fetch_assoc($retorno)) {
            $apis[] = $api;
        }

        return $apis;
    }

    public function getApi($nome)
    {
        $query = "SELECT * FROM apis WHERE nome = '$nome'";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
    }

    public function setQuantidadeRequisicoesRestantes($nomeApi, $quantidade)
    {
        $query = "UPDATE apis SET requisicoes_restantes = $quantidade WHERE nome = '$nomeApi';";

        return mysqli_query($this->conexao, $query);
    }
}
