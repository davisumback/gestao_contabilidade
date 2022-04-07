<?php

namespace App\Entidade;

class Nota{
    private $id;
    private $titulo;
    private $texto;
    private $data_criacao;
    private $data_retorno;

    function __construct($titulo, $texto, $data_retorno = null){
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->data_retorno = $data_retorno;
    }

    public function getDataRetorno(){
        return $this->data_retorno;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getTexto(){
        return $this->texto;
    }

    public function setTexto($texto){
        $this->texto = $texto;
    }

    public function getDataCriacao(){
        return $this->data_criacao;
    }

    public function setDataCriacao($data_criacao){
        $this->data_criacao = $data_criacao;
    }
}
