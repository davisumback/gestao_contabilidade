<?php

namespace App\DAO;
use App\Helper\Helpers;
use App\Config\BancoConfig;

class SimuladorDAO{
    private $conexao;

    function __construct(){
        $this->conexao = BancoConfig::conecta();
    }

    function deletaSimulacaoEmpresa($empresaNumero, $simulacaoId){
        $query = "DELETE FROM simulador_empresa WHERE simulacao_id = '{$simulacaoId}' AND empresa_numero = $empresaNumero; ";
        mysqli_query($this->conexao, $query);

        $query = "DELETE FROM simulador WHERE id_simulacao = '{$simulacaoId}';";
        return mysqli_query($this->conexao, $query);
    }

    function getSimulacaoEmpresa($empresaNumero){
        $simulacoes = array();
        $query = "  SELECT simulacao_id, empresa_numero, hora_simulacao FROM simulador_empresa
                    WHERE
                        empresa_numero = $empresaNumero
                    ;";
        $resultado = mysqli_query($this->conexao, $query);
        while($retorno = mysqli_fetch_assoc($resultado)){
            array_push($simulacoes, $retorno);
        }

        return $simulacoes;
    }

    function salvaSimulacao($simulacao_id, $empresa_numero){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');

        $query = "  INSERT INTO simulador_empresa (simulacao_id, empresa_numero, hora_simulacao)
                    VALUES (
                        '{$simulacao_id}',
                        $empresa_numero,
                        '{$data}'
                );";

        return mysqli_query($this->conexao, $query);
    }

    function insereValoresMensais($valores){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');

        $array_convertido = array();

        foreach ($valores as $valor) {
            array_push($array_convertido, $valor);
        }

        $array_convertido[1] = Helpers::formataMoedaBd($array_convertido[1]);
        $array_convertido[2] = Helpers::formataMoedaBd($array_convertido[2]);
        //$array_convertido[3] = Helpers::formataMoedaBd($array_convertido[3]); Era o cpp quando era recebido via INPUT

        $array_convertido[3] = strtoupper($array_convertido[3]);

        $query = "  INSERT INTO simulador (id_simulacao, faturamento, prolabore, mes, ano, hora_simulacao)
                    VALUES (
                        '{$array_convertido[0]}',
                        {$array_convertido[1]},
                        {$array_convertido[2]},
                        '{$array_convertido[3]}',
                        '{$array_convertido[4]}',
                        '{$data}'
                    );";

        return mysqli_query($this->conexao, $query);
    }

    function alteraValoresMensais($valores){

        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');

        $array_convertido = array();

        foreach ($valores as $valor) {
            array_push($array_convertido, $valor);
        }

        $array_convertido[1] = Helpers::formataMoedaBd($array_convertido[1]);
        $array_convertido[2] = Helpers::formataMoedaBd($array_convertido[2]);
        //$array_convertido[3] = Helpers::formataMoedaBd($array_convertido[3]); Era o cpp quando era recebido via INPUT

        $array_convertido[3] = strtoupper($array_convertido[3]);

        $query = "  UPDATE simulador
                    SET
                        faturamento = {$array_convertido[1]},
                        prolabore = {$array_convertido[2]},
                        hora_simulacao = '{$data}'
                    WHERE
                        id_simulacao =  '{$array_convertido[0]}'
                    AND
                        mes = '{$array_convertido[3]}'
                    AND
                        ano = '{$array_convertido[4]}'
                    ;";

        return mysqli_query($this->conexao, $query);
    }

    function getSimulacao($id_simulacao){
        $resultados = array();

        $query = "SELECT * FROM simulador WHERE id_simulacao = '{$id_simulacao}';";
        $retorno = mysqli_query($this->conexao, $query);

        while($resultado = mysqli_fetch_assoc($retorno)){
            array_push($resultados, $resultado);
        }

        return $resultados;
    }
}
