<?php
namespace App\Model\Nfse;

class Endereco
{
    public $tipoLogradouro;
    public $logradouro;
    public $numero;
    public $complemento;
    public $tipoBairro;
    public $bairro;
    public $codigoCidade;
    public $descricaoCidade;
    public $estado;
    public $cep;

    public function __construct($logradouro, $numero, $codigoCidade, $cep)
    {
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->codigoCidade = $codigoCidade;
        $this->cep = $cep;
    }

    public function setTipoLogradouro($tipoLogradouro)
    {
        $tiposLogradouro = [
            'Alameda', 'Avenida', 'Chácara', 'Colônia', 'Condomínio', 
            'Estância', 'Estrada', 'Fazenda', 'Praça', 'Prolongamento',
            'Rodovia', 'Rua', 'Sítio', 'Travessa', 'Vicinal'
        ];

        if (! in_array($tipoLogradouro, $tiposLogradouro)) {
            throw new Exception("Tipo logradouro não existente.", 1);            
        }

        $this->tipoLogradouro = $tipoLogradouro;

        return $this;
    }

    public function setTipoBairro($tipoBairro)
    {
        $tiposBairro = [
            'Bairro', 'Bosque', 'Chácara', 'Conjunto', 'Desmembramento', 'Distrito', 'Favela', 'Fazenda', 
            'Gleba', 'Horto', 'Jardim', 'Loteamento', 'Núcleo', 'Parque', 'Residencial', 'Sítio', 'Tropical', 
            'Vila', 'Zona', 'Centro', 'Setor'
        ];

        if (! in_array($tipoBairro, $tiposBairro)) {
            throw new Exception("Tipo bairro não existente.", 1);            
        }
        
        $this->tipoBairro = $tipoBairro;

        return $this;
    }

    /**
     * Get the value of bairro
     */ 
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set the value of bairro
     *
     * @return  self
     */ 
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get the value of descricaoCidade
     */ 
    public function getDescricaoCidade()
    {
        return $this->descricaoCidade;
    }

    /**
     * Set the value of descricaoCidade
     *
     * @return  self
     */ 
    public function setDescricaoCidade($descricaoCidade)
    {
        $this->descricaoCidade = $descricaoCidade;

        return $this;
    }

    public function setEstado($estado)
    {
        $estados = [
            'AC', 'AL', 'AM', 'AP', 'BA', 'CE',
            'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 
            'MT', 'PA', 'PB', 'PE', 'PI', 'PR', 
            'RJ', 'RN', 'RO', 'RR', 'RS', 'SC', 
            'SE', 'SP', 'TO'];

        if (! in_array($estado, $estados)) {
            throw new \Exception("Estado não existente.", 1);
        }

        $this->estado = $estado;

        return $this;
    }
}