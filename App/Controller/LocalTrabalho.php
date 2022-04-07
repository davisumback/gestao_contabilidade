<?php
namespace App\Controller;

class LocalTrabalho
{
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
        $ies = new \App\Model\LocalTrabalho();
        $ies->save($this->attributes);

        return 'Sucesso ao cadastrar o local de trabalho.';
    }
    // public function delete()
    // {
    //     $ies = new \App\Model\LocalTrabalho();
    //     $ies->delete($this->attributes);

    //     return 'Sucesso ao deletar o IES.';
    // }
    // public function update()
    // {
    //     $ies = new \App\Model\LocalTrabalho();
    //     $ies->edit($this->attributes);

    //     return 'Sucesso ao editar o IES.';
    // }
}
