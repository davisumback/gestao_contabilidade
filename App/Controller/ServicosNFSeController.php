<?php
namespace App\Controller;

class ServicosNFSeController
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
    
    public function storeServico()
    {
        $this->verificaParametros();

        $servicos = new \App\Model\ServicosNFSe();
        $servicos->save($this->attributes);

        return 'Sucesso ao cadastrar serviço.';
    }

    public function updateServico()
    {
        $this->verificaParametros();

        $servicos = new \App\Model\ServicosNFSe();
        $servicos->edit($this->attributes);

        return 'Sucesso ao editar o serviço.';
    }

    public function deleteServico()
    {
        $this->verificaParametros();

        $servicos = new \App\Model\ServicosNFSe();
        $servicos->delete($this->attributes);

        return 'Sucesso ao deletar o serviço.';
    }    
}
