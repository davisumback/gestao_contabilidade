<?php

namespace App\Helper;
use App\Helper\Helpers;

class Simulador{

    private $valores_mensais = array();
    private $valores_a_calcular = array();
    private $calculos_mensais = array();
    private $chaves_mensais = array();
    private $array_sn = array();

    function __construct(){
        //$this->faturamento = $faturamento;
        //$this->prolabore = $prolabore;
        //$this->cpp = $cpp;
        //$this->valores = $valores;
    }

    public function setValoresMensais($valores){
        array_push($this->valores_mensais, $valores);
    }

    public function getValoresMensais(){
        return $this->valores_mensais;
    }

    private function converteValores(){
        $aux = array();

        foreach ($this->valores_mensais as $chave => $valor_array) {
            $valores = array();

            foreach ($valor_array as $chave_meses => $valor) {
                array_push($valores, $valor);
                array_push($this->chaves_mensais, $chave_meses);
            }

            array_push($aux, $valores);
        }

        $this->valores_a_calcular = $aux;
    }

    public function calculos(){
        $this->converteValores();
        echo '----------------';
        echo '<pre>';
        print_r($this->valores_a_calcular);
        echo '</pre>';

        foreach ($this->valores_a_calcular as $chave => $valor_array) {
            $aux = array();
            $sn6 = $this->getSn6(Helpers::formataStringMoeda($valor_array[0]));
            $sn15 = $this->getSn15(Helpers::formataStringMoeda($valor_array[0]));
            array_push($aux, $sn6);
            array_push($aux, $sn15);

            array_push($this->array_sn, $aux);
        }

        echo '----------------';
        echo '<pre>';
        print_r($this->array_sn);
        echo '</pre>';

        $this->fazAlgo();
    }

    public function fazAlgo(){
        $meses = array_chunk($this->chaves_mensais, 3, true);
        echo '----------------';
        echo '<pre>';
        print_r($meses);
        echo '</pre>';
    }

    public function getSn6($valor){
        return $valor * 0.06;
    }

    public function getSn15($valor){
        return $valor * 0.0155;
    }
}
