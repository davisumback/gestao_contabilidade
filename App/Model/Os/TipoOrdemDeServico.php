<?php
namespace App\Model\Os;

use App\Config\BancoConfig;

class TipoOrdemDeServico
{
    private $id;
    private $tipo;
    private $previsaMinima;
    private $fatorX;
    private $titulo;

    public function __construct()
    {
        $this->conexao = BancoConfig::conecta();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getDiasMinimo($id)
    {
        $query = "SELECT (dias_minimo * fator_x) as dias FROM tipos_os WHERE id = $id;";
        $retorno = \mysqli_query($this->conexao, $query);
        $retorno = \mysqli_fetch_assoc($retorno);

        return intVal($retorno['dias']);
    }

    public function getTipoTitulo($id)
    {
        $query =    "SELECT 
                        titulo
                    FROM 
                        tipos_os
                    WHERE
                        id = $id;";
        
        $retorno = mysqli_query($this->conexao, $query);
        $tipo = mysqli_fetch_assoc($retorno);
        
        return $tipo['titulo'];
    }

    public function getAll()
    {
        $query =    "SELECT 
                        *
                    FROM 
                        tipos_os
                    WHERE 
                        ativo = 1;";

        $retorno = mysqli_query($this->conexao, $query);
        $linhas = array();

        while ($linha = mysqli_fetch_assoc($retorno)) {
            $linhas[] = $linha;
        }

        return $linhas;
    }
}
