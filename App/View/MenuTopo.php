<?php

namespace App\View;

class MenuTopo{
    private $sair;
    private $titulo_navegacao;

    function __construct(){

    }

    public function getSair(){
        return $this->sair;
    }

    public function setSair($sair){
        $this->sair = $sair;
    }

    public function getTituloNavegacao(){
        return $this->titulo_navegacao;
    }

    public function setTituloNavegacao($titulo_navegacao){
        $this->titulo_navegacao = $titulo_navegacao;    
    }

}
