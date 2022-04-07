<?php
namespace App\Controller;

class IesController
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("IES sem parametros!", 1);
        }
        $this->attributes = $attributes;
    }
    
    public function store()
    {
        $ies = new \App\Model\Ies();
        $ies->save($this->attributes);

        return 'Sucesso ao cadastrar o IES.';
    }

    public function delete()
    {
        $ies = new \App\Model\Ies();
        $ies->delete($this->attributes);

        return 'Sucesso ao deletar o IES.';
    }

    public function update()
    {
        $ies = new \App\Model\Ies();
        $ies->edit($this->attributes);

        return 'Sucesso ao editar o IES.';
    }
}
