<?php
namespace App\Controller;

class CnaeController
{
    private $attributes;

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    public function verificaParametros()
    {
        if (empty($this->attributes)) {
            throw new \Exception("Você não pode acessar essa área do sistema diretamente!", 1);
        }
    }

    public function store()
    {
        $this->verificaParametros();

        $cnae = new \App\Model\Empresa\EmpresaCnae();
        $cnae->save($this->attributes);

        return 'Sucesso ao salvar CNAE.';
    }

    public function update()
    {
        $this->verificaParametros();

        $cnae = new \App\Model\Empresa\EmpresaCnae();
        $cnae->update($this->attributes);
        
        return 'Sucesso ao alterar CNAE.';
    }

    public function delete()
    {
        $this->verificaParametros();

        $cnae = new \App\Model\Empresa\EmpresaCnae();
        $cnae->delete($this->attributes);

        return 'Sucesso ao deletar CNAE.';
    }
}
