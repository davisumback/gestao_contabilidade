<?php

namespace App\Model\PegaPlantao;

class PegaPlantaoLog{

    private $id;
    private $descricao;
    private $createdAt;
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
    
    function setDescricao($descricao){
    	$this->descricao = $descricao;
        return $this;
    }
    
    function getDescricao(){
    	return $this->descricao;
    }

    function setCreatedAt($createdAt){
        $this->createdAt = $createdAt;
        return $this;
    }

    function getCreatedAt(){
        return $this->createdAt;
    }
}