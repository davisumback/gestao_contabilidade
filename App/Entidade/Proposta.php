<?php

namespace App\Entidade;

class Proposta{
    private $id;
    private $titulo;
    private $corpo;
    private $cpf;
    private $aceitou;
    private $proposta_padrao;

    function __construct($titulo, $corpo, $cpf){
        $this->titulo = $titulo;
        $this->corpo = $corpo;
        $this->cpf = $cpf;
    }

    function getAceitou(){
        return $this->aceitou;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getCorpo(){
        return $this->corpo;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getPropostaPadrao(){
        return $this->proposta_padrao;
    }
}
