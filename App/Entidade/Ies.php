<?php

namespace App\Entidade;

class Ies{
    private $id;
    private $nome;
    private $cidade;

    function __construct($nome, $cidade){
        $this->nome = $nome;
        $this->cidade = $cidade;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }
}
