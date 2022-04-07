<?php
namespace App\Controller;

class EmpresaController
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Sem parametros!", 1);
        }
        $this->attributes = $attributes;
    }

    public function verificaParametros()
    {
        if (empty($this->attributes)) {
            throw new \Exception("Você não pode acessar essa área do sistema diretamente!", 1);
        }
    }
    
    public function storeInscricaoMunicipal()
    {
        // $this->verificaParametros();

        $empresa = new \App\Model\Empresa\Empresa();
        $empresa->setId($this->attributes['empresasId']);
        $empresa->setInscricaoMunicipal($this->attributes['inscricaoMunicipal']);
        $empresa->save($this->attributes);

        return 'Sucesso ao cadastrar a inscrição municipal.';
    }

    public function isEmpresaNfse()
    {
        $empresa = new \App\Model\Empresa\Empresa();
        $retorno = $empresa->isEmpresa($this->attributes['empresasId']);
        \setcookie('empresasId', $this->attributes['empresasId'], time()+2, '/');
        \setcookie('regimeTributario', $retorno[0]['regime_tributario'], time()+2, '/');
    }
}