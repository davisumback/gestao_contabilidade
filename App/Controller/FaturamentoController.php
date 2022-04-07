<?php
namespace App\Controller;

class FaturamentoController
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

    public function storeFaturamentos()
    {
        $this->verificaParametros();

        $faturamentoObject = new \App\Model\Empresa\Faturamento();

        $faturamentos = $this->attributes['faturamentos'];

        foreach ($faturamentos as $faturamento) {
            $mes = '01/' . $faturamento["mes"];
            $mes = \App\Helper\Helpers::formataDataBd($mes);
            $faturamentoObject->isFaturamento($mes, $this->attributes['empresasId']);
        }

        foreach ($faturamentos as $faturamento) {
            $faturamento['empresasId'] = $this->attributes['empresasId'];
            $faturamentoObject->save($faturamento);
        }

        return 'Sucesso ao salvar os faturamentos.';
    }

    public function update()
    {
        $this->verificaParametros();

        $usuario = new \App\Model\Grupob\Usuario();
        $nomeUsuario = $usuario->getNomeUsuario($this->attributes["usuariosId"]);

        $prospect = new \App\Model\Empresa\Faturamento();
        $prospect->update($this->attributes);

        return 'Sucesso ao alterar o faturamento.';
    }

    public function delete()
    {
        $this->verificaParametros();

        $usuario = new \App\Model\Grupob\Usuario();
        $nomeUsuario = $usuario->getNomeUsuario($this->attributes["usuariosId"]);

        $prospect = new \App\Model\Empresa\Faturamento();
        $prospect->delete($this->attributes);

        return 'Sucesso ao deletar o faturamento.';
    }
}
