<?php

namespace App\Entidade;

class ClienteEmail{
    private $id;
    private $clientes_id;
    private $usuarios_id;
    private $data_hora;
    private $enviado;
    private $tipos_email_id;

    function __construct($clientes_id, $usuarios_id, $enviado, $tipos_email_id){
        $this->clientes_id = $clientes_id;
        $this->usuarios_id = $usuarios_id;        
        $this->enviado = $enviado;
        $this->tipos_email_id = $tipos_email_id;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getClientesId(){
        return $this->clientes_id;
    }

    public function getUsuariosId(){
        return $this->usuarios_id;
    }


    public function getDataHora(){
        return $this->data_hora;
    }

    public function getEnviado(){
        return $this->enviado;
    }

    public function getTiposEmailId(){
        return $this->tipos_email_id;
    }

}
