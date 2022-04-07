<?php

namespace App\View;

class Rodape{
    private $caminhos = array();

    public function getScripts(){
        $saida = '';
        foreach ($this->caminhos as $script) {
            if($script[1] != ""){
                $saida .= "<script type=\"text/javascript\" src=\"$script[0]\" integrity=\"$script[1]\" crossorigin=\"anonymous\"></script>";
            }else {
                $saida .= "<script type=\"text/javascript\" src=\"$script[0]\"></script>";
            }
        }

        return $saida;
    }

    public function setScript($caminho, $integrity = ""){
        $aux = array();

        array_push($aux, $caminho);
        array_push($aux, $integrity);
        array_push($this->caminhos, $aux);
    }

}
