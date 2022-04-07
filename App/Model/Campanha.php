<?php
namespace App\Model;

use App\Config\BancoConfig;

class Campanha
{
    private $conexao;

    function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getDadosClienteCampanha($campanha = null)
    {
        $query =    "SELECT 
                        * 
                    FROM 
                        form_cliente as fc
                    LEFT JOIN
                        form_redes_sociais as fr
                    ON
                        fc.id_form_cliente = fr.cliente_id
                    ;";
        $retorno = \mysqli_query($this->conexao, $query);
        $dados = [];

        while ($dado = \mysqli_fetch_assoc($retorno)) {
            $dados [] = $dado;
        }

        return $dados;
    }

    public function getDadosClienteCampanhaQtd($campanha = null)
    {
        $query = "SELECT 
                    COUNT(id) as quantidade 
                FROM 
                    form_cliente as fc
                LEFT JOIN
                    form_redes_sociais as fr
                ON
                    fc.id_form_cliente = fr.cliente_id
                ;";
        $retorno = mysqli_query($this->conexao, $query);

        return mysqli_fetch_assoc($retorno);
        // return $retorno;
    }
}
