<?php

namespace App\Model\PegaPlantao;

class PegaPlantaoParceiro{

    private $id;
    private $codigo;
    private $nome;
    private $url;
    private $token;
    private $situacao;

    function setId($id){
        $this->id = $id;
        return $this;
    }

    function getId(){
        return $this->id;
    }

    function setCodigo($codigo){
    	$this->codigo = $codigo;
        return $this;
    }
    
    function getCodigo(){
    	return $this->codigo;
    }

    function setNome($nome){
    	$this->nome = $nome;
        return $this;
    }
    
    function getNome(){
    	return $this->nome;
    }

    function setUrl($url){
    	$this->url = $url;
        return $this;
    }
    
    function getUrl(){
    	return $this->url;
    }

    function setToken($token){
    	$this->token = $token;
        return $this;
    }
    
    function getToken(){
    	return $this->token;
    }

    function setSituacao($situacao){
    	$this->situacao = $situacao;
        return $this;
    }
    
    function getSituacao(){
    	return $this->situacao;
    }
}