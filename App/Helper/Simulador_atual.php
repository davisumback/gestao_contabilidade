<?php

namespace App\Helper;

class Simulador_atual{
    private $faturamento;
    private $prolabore;
    private $cpp;
    private $valores = array();

    function __construct($valores){
        //$this->faturamento = $faturamento;
        //$this->prolabore = $prolabore;
        //$this->cpp = $cpp;
        $this->valores = $valores;
    }

    public function getSn6(){
        return $this->valores[0] * 0.06;
    }

    public function getSn15(){
        return $this->valores[0] * 0.0155;
    }
}
