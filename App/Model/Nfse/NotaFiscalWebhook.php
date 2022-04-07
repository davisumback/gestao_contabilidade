<?php
namespace App\Model\Nfse;

class NotaFiscalWebhook
{
    public $idTecnospeed;
    private $id;
    private $empresasId;
    private $valor;
    private $situacao;
    private $prestador;
    private $tomador;
    private $numeroNfse;
    private $serie;
    private $lote;
    private $dataAutorizacao;
    private $mensagemRetorno;
    private $codigoVerificacao;
    private $emissao;
    private $pdf;
    private $arquivo;
    private $cancelamento;

    const CAMINHO_BASE = '../../grupobfiles/empresas';

    public function getCancelar()
    {
        if ($this->situacao == 'CONCLUIDO') {
            echo '<button data-toggle="modal" data-target="#substituiNota" class="d-inline-block btn btn-padrao btn-sm btn-info">Substituir</button>
            <button data-nota-fiscal-id="' . $this->idTecnospeed .'" data-toggle="modal" data-target="#cancelaNota" class="d-inline-block ml-1 btn btn-padrao btn-sm btn-danger">Cancelar</button>';
        }
    }

    public function getCorStatus()
    {
        switch ($this->getSituacao()) { 
            case 'PROCESSANDO':
                return 'warning';
            case 'CONCLUIDO':
                return 'success';
            case 'AGENDADO':
                return 'dark';
            case 'CANCELADO':
                return 'info';
            case 'REJEITADO':
                return 'danger';
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSituacaoConvertida()
    {
        switch ($this->getSituacao()) {
            case 'AGENDADO':
                return 'Agendado';
            case 'PROCESSANDO':
                return 'Processando';
            case 'CONCLUIDO':
                return 'Concluído';
            case 'CANCELADO':
                return 'Cancelado';
            case 'REJEITADO':
                return 'Rejeitado';
            default:
                return 'Desconhecido';
                break;
        }
    }

    public function getSituacao()
    {
        return $this->situacao;
    }

    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    /**
     * Get the value of prestador
     */ 
    public function getPrestador()
    {
        return $this->prestador;
    }

    /**
     * Set the value of prestador
     *
     * @return  self
     */ 
    public function setPrestador($prestador)
    {
        $this->prestador = $prestador;

        return $this;
    }

    /**
     * Get the value of tomador
     */ 
    public function getTomador()
    {
        return $this->tomador;
    }

    /**
     * Set the value of tomador
     *
     * @return  self
     */ 
    public function setTomador($tomador)
    {
        $this->tomador = $tomador;

        return $this;
    }

    /**
     * Get the value of numeroNfse
     */ 
    public function getNumeroNfse()
    {
        return $this->numeroNfse;
    }

    /**
     * Set the value of numeroNfse
     *
     * @return  self
     */ 
    public function setNumeroNfse($numeroNfse)
    {
        $this->numeroNfse = $numeroNfse;

        return $this;
    }

    /**
     * Get the value of serie
     */ 
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set the value of serie
     *
     * @return  self
     */ 
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }

    /**
     * Get the value of lote
     */ 
    public function getLote()
    {
        return $this->lote;
    }

    /**
     * Set the value of lote
     *
     * @return  self
     */ 
    public function setLote($lote)
    {
        $this->lote = $lote;

        return $this;
    }

    /**
     * Get the value of dataAutorizacao
     */ 
    public function getDataAutorizacao()
    {
        return $this->dataAutorizacao;
    }

    /**
     * Set the value of dataAutorizacao
     *
     * @return  self
     */ 
    public function setDataAutorizacao($dataAutorizacao)
    {
        $this->dataAutorizacao = \App\Helper\Helpers::formataDataBd($dataAutorizacao);
    }

    /**
     * Get the value of mensagemRetorno
     */ 
    public function getMensagemRetorno()
    {
        return $this->mensagemRetorno;
    }

    /**
     * Set the value of mensagemRetorno
     *
     * @return  self
     */ 
    public function setMensagemRetorno($mensagemRetorno)
    {
        $this->mensagemRetorno = $mensagemRetorno;

        return $this;
    }

    /**
     * Get the value of codigoVerificacao
     */ 
    public function getCodigoVerificacao()
    {
        return $this->codigoVerificacao;
    }

    /**
     * Set the value of codigoVerificacao
     *
     * @return  self
     */ 
    public function setCodigoVerificacao($codigoVerificacao)
    {
        $this->codigoVerificacao = $codigoVerificacao;

        return $this;
    }

    /**
     * Get the value of emissao
     */ 
    public function getEmissao()
    {
        return $this->emissao;
    }

    /**
     * Set the value of emissao
     *
     * @return  self
     */ 
    public function setEmissao($emissao)
    {
        $this->emissao = \App\Helper\Helpers::formataDataBd($emissao);

        return $this;
    }

    /**
     * Get the value of valor
     */ 
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set the value of valor
     *
     * @return  self
     */ 
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get the value of pdf
     */ 
    public function getPdf()
    {
        if ($this->pdf == null) return '';

        $caminho = self::CAMINHO_BASE . '/' . $this->empresasId . '/nota-fiscal/' . $this->pdf;

        $html = '<a href="'.$caminho.'" target="_blank">' .
                    '<i class="fas fa-file-pdf"></i>' .
                '</a>';

        return $html;
    }

    /**
     * Set the value of pdf
     *
     * @return  self
     */ 
    public function setPdf($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Get the value of empresasId
     */ 
    public function getEmpresasId()
    {
        return $this->empresasId;
    }

    /**
     * Set the value of empresasId
     *
     * @return  self
     */ 
    public function setEmpresasId($empresasId)
    {
        $this->empresasId = $empresasId;

        return $this;
    }

    /**
     * Get the value of arquivo
     */ 
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set the value of arquivo
     *
     * @return  self
     */ 
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;

        return $this;
    }

    /**
     * Get the value of cancelamento
     */ 
    public function getCancelamento()
    {
        return $this->cancelamento;
    }

    /**
     * Set the value of cancelamento
     *
     * @return  self
     */ 
    public function setCancelamento($cancelamento)
    {
        $this->cancelamento = \App\Helper\Helpers::formataDataBd($cancelamento);

        return $this;
    }
}