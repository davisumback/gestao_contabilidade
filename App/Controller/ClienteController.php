<?php
namespace App\Controller;

class ClienteController
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Sem parametros!", 1);
        }
        $this->attributes = $attributes;
    }
    
    public function storeEmail()
    {
        $empresa = new \App\Model\Usuario\Cliente();
        $empresa->setId($this->attributes['clientesId']);
        $empresa->setEmail($this->attributes['email']);
        $empresa->saveEmail();

        return 'Sucesso ao cadastrar o email.';
    }
}