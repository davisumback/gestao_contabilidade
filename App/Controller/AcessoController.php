<?php
namespace App\Controller;

use App\DAO\EmpresaDAO;

class AcessoController
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

    public function desativaEmpresa()
    {
        session_start();
        $this->verificaParametros();

        $dao = new EmpresaDAO();
        $dao->desativaEmpresa($this->attributes['empresasId']);

        unset($_SESSION['viewIdEmpresa']);
        unset($_SESSION['viewNomeEmpresa']);
        unset($_SESSION['infosEmpresa']);

        return 'Sucesso ao desativar a empresa';
    }

    public function storeAcessos()
    {
        $this->verificaParametros();

        $prospect = new \App\Model\Empresa\Acesso();
        $prospect->save($this->attributes);

        return 'Sucesso ao salvar o acesso.';
    }

    public function update()
    {
        $this->verificaParametros();

        $usuario = new \App\Model\Grupob\Usuario();
        $nomeUsuario = $usuario->getNomeUsuario($this->attributes["usuariosId"]);

        $prospect = new \App\Model\Empresa\Acesso();
        $prospect->update($this->attributes);

        return 'Sucesso ao alterar o faturamento.';
    }

    public function delete()
    {
        $this->verificaParametros();

        $usuario = new \App\Model\Grupob\Usuario();
        $nomeUsuario = $usuario->getNomeUsuario($this->attributes["usuariosId"]);

        $prospect = new \App\Model\Empresa\Acesso();
        $prospect->delete($this->attributes);

        return 'Sucesso ao deletar o faturamento.';
    }
}