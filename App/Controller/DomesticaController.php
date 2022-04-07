<?php
namespace App\Controller;

class DomesticaController
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

        $domestica = new \App\Model\Domestica();
        $domestica->save($this->attributes);

        return 'Sucesso ao salvar doméstica.';
    }

    // public function update()
    // {
    //     $this->verificaParametros();

    //     $contaBancaria = new \App\Model\Empresa\EmpresaContaBancaria();
    //     $contaBancaria->updateContaBancaria($this->attributes);

    //     return 'Sucesso ao alterar conta bancária padrão.';
    // }

    // public function delete()
    // {
    //     $this->verificaParametros();

    //     $contaBancaria = new \App\Model\Empresa\EmpresaContaBancaria();
    //     $contaBancaria->delete($this->attributes);

    //     return 'Sucesso ao deletar conta bancária.';
    // }
}