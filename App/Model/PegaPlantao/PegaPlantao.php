<?php

namespace App\Model\PegaPlantao;

class PegaPlantao{

    private $id;
    private $profissionalDePlantao;
    private $inicio;
    private $fim;
    private $valor;
    private $descricao;
    private $codigoProfissionalFixo;
    private $codigoProfissionalDePlantao;
    private $parceiro;

    function setId($id){
        $this->id = $id;
        return $this;
    }

    function getId(){
        return $this->id;
    }

    function setParceiro($parceiro){
        $this->parceiro = $parceiro;
        return $this;
    }

    function getParceiro(){
        return $this->parceiro;
    }

    function setProfissionalDePlantao($profissionalDePlantao){
    	$this->profissionalDePlantao = $profissionalDePlantao;
        return $this;
    }

    function getProfissionalDePlantao(){
    	return $this->profissionalDePlantao;
    }

    function setInicio($inicio){
    	$this->inicio = $inicio;
        return $this;
    }
    
    function getInicio(){
    	return $this->inicio;
    }

    function setFim($fim){
    	$this->fim = $fim;
        return $this;
    }
    
    function getFim(){
    	return $this->fim;
    }

    function setValor($valor){
    	$this->valor = $valor;
        return $this;
    }
    
    function getValor(){
    	return $this->valor;
    }

    function setDescricao($descricao){
    	$this->descricao = $descricao;
        return $this;
    }
    
    function getDescricao(){
    	return $this->descricao;
    }

    function setCodigoProfissionalFixo($codigoProfissionalFixo){
    	$this->codigoProfissionalFixo = $codigoProfissionalFixo;
        return $this;
    }
    
    function getCodigoProfissionalFixo(){
    	return $this->codigoProfissionalFixo;
    }

    function setCodigoProfissionalDePlantao($codigoProfissionalDePlantao){
    	$this->codigoProfissionalDePlantao = $codigoProfissionalDePlantao;
        return $this;
    }
    
    function getCodigoProfissionalDePlantao(){
    	return $this->codigoProfissionalDePlantao;
    }
}