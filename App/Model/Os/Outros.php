<?php
namespace App\Model\Os;

class Outros
{
    private $attributes;

    public function setAttributes($attributes)
    {
        if (empty($attributes)) {
            throw new \Exception("Você não pode acessar essa parte do sistema diretamente.", 1);            
        }
        $this->attributes = $attributes;
    }

    public function saveOsOutros()
    {
        $dao = new \App\DAO\OrdemDeServicoDAO();
        $retorno = $dao->insereOrdemDeServicoSetor('Outros', $this->attributes['tipoOs'], $this->attributes['setor']);
        $dao->insertItensOsDescricao($retorno['ordensDeServicosId'], $this->attributes['osItemId'], $this->attributes['texto']); 
        $dao->insereUsuarioOsEmissaoSemEmpresa($retorno['ordensDeServicosId'], $this->attributes['usuariosId']);
        $dao->insereUsuarioOsRecebeSemEmpresa($retorno['ordensDeServicosId'], $this->attributes['usuariosId']);
    }

    public function atende()
    {
        $ordemDeServico = new \App\Model\Os\OrdemDeServico();
        $ordemDeServico->updateOs('FINALIZADA', $this->attributes['ordemDeServicoId']);
    }
}