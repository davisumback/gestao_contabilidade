<?php

namespace App\View;

class Header{
    private $titulo;
    private $estilos = array();
    private $fonts = array();
    private $caminhos = array();
    private $logout;

    function __construct($titulo){
        $this->titulo = $titulo;
    }

    public function setScript($caminho, $integrity = ""){
        $aux = array();

        array_push($aux, $caminho);
        array_push($aux, $integrity);
        array_push($this->caminhos, $aux);
    }

    public function getScripts(){
        $saida = '';
        foreach ($this->caminhos as $script) {
            if($script[1] != ""){
                $saida .= "<script src=\"$script[0]\" integrity=\"$script[1]\" crossorigin=\"anonymous\"></script>";
            }else {
                $saida .= "<script src=\"$script[0]\"></script>";
            }
        }

        return $saida;
    }    

    public function getTitulo(){
        return $this->titulo;
    }

    public function setEstilo($caminho){
        array_push($this->estilos, $caminho);
    }

    public function getEstilos(){
        $saida = '';
        foreach ($this->estilos as $caminho ) {
            $saida .= "<link rel=\"stylesheet\" href=\"$caminho\">";
        }

        return $saida;
    }

    public function setFont($caminho){
        array_push($this->estilos, $caminho);
    }

    public function getFonts(){
        $saida = '';
        foreach ($this->fonts as $caminho ) {
            $saida .= "<link rel=\"stylesheet\" href=\"$caminho\"> type=\"text/css\"";
        }

        return $saida;
    }

    public function setCaminhotLogout($caminho){
        $this->caminho = $caminho;
    }

    public function getCaminhoLogout(){
        return $this->caminho;
    }
}
