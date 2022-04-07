<?php
namespace App\Controller;

class ContatoController
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Contato sem parametros!", 1);
        }
        $this->attributes = $attributes;
    }
    
    public function store()
    {
        $contato = new \App\Model\Contato();
        $contato->save($this->attributes);

        return 'Sucesso ao cadastrar o Contato.';
    }

    public function delete()
    {
        $contato = new \App\Model\Contato();
        $contato->delete($this->attributes);

        return 'Sucesso ao deletar o Contato.';
    }

    public function update()
    {
        $contato = new \App\Model\Contato();
        $contato->edit($this->attributes);

        return 'Sucesso ao editar o Contato.';
    }
}
