<?php
namespace App\Controller;

class DescontoController
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Descontos sem parametros!", 1);
        }
        $this->attributes = $attributes;
    }
    
    public function store()
    {
        $desconto = new \App\Model\Grupob\Desconto();
        $desconto->save($this->attributes);

        return 'Sucesso ao cadastrar o Descontos.';
    }

    public function delete()
    {
        $desconto = new \App\Model\Grupob\Desconto();
        $desconto->delete($this->attributes);

        return 'Sucesso ao deletar o Desconto.';
    }

    public function update()
    {
        $desconto = new \App\Model\Grupob\Desconto();
        $desconto->edit($this->attributes);

        return 'Sucesso ao editar o Desconto.';
    }
}
