<?php
namespace App\Model\Os;

class AlteracaoEndereco
{
    private $attributes;

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;      
    }

    public function saveOsAlteracaoEndereco()
    {
        // echo '<pre>';
        // print_r($this->attributes);
        // echo '</pre>';
        // die();

        $dao = new \App\DAO\EmpresaDAO();

        if ($dao->isEmpresa($this->attributes['empresasId']) == null) {
            throw new \Exception("Erro! Empresa não existente", 1);
        }

        if (! array_key_exists('novoEndereco', $this->attributes) || $this->attributes['novoEndereco']['error'] == 4) {
            throw new \Exception("Erro! Você precisa enviar o comprovante do novo endereço.", 1);
        }

        $dao = new \App\DAO\OrdemDeServicoDAO();
        $usuariosContrato = $dao->getUsuariosContrato();
        $retorno = $dao->insereOrdemDeServico('Alteração Contratual', $this->attributes['tipoOs']);
        $dao->insertItensOs($retorno['ordensDeServicosId'], $this->attributes['osItemId']); 
        $dao->insereUsuarioOsEmissao($retorno['ordensDeServicosId'], $this->attributes['usuariosId'], $this->attributes['empresasId']);
        $dao->insereUsuarioOsRecebe($retorno['ordensDeServicosId'], $this->attributes['empresasId'], $usuariosContrato['id']);
    }
}
