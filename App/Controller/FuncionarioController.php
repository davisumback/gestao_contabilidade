<?php
namespace App\Controller;

class FuncionarioController
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Sem parametros!", 1);
        }
        $this->attributes = $attributes;
    }
    
    public function store()
    {
        $funcionario = new \App\Model\Empresa\Funcionario();
        $funcionario->save($this->attributes);

        return 'Sucesso ao cadastrar o Funcionário.';
    }

    public function delete()
    {
        $funcionario = new \App\Model\Empresa\Funcionario();
        $funcionario->delete($this->attributes);

        return 'Sucesso ao deletar o Funcionário.';
    }

    public function edit()
    {
        $funcionario = new \App\Model\Empresa\Funcionario();
        $funcionario->edit($this->attributes);

        return 'Sucesso ao editar o Funcionário.';
    }
}
