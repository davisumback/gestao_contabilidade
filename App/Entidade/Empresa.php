<?php

namespace App\Entidade;

class Empresa{
    private $id;
    private $tipoSocietario;
    private $nomeEmpresa;
    private $nomeUm;
    private $nomeDois;
    private $nomeTres;
    private $regimeTributario;
    private $cnpj;
    private $dataViabilidade;
    private $objeto;
    private $capitalSocial;
    private $pagamentoIrpjCsll;
    private $atividadePrincipal;
    private $inicioAtividades;
    private $dataSn;
    private $porte;
    private $vinculo;

    // function __construct($tipoSocietario, $nomeEmpresa, $nomeUm, $nomeDois, $nomeTres, $regimeTributario, $cnpj,
    // $dataViabilidade = "", $objeto,$capitalSocial, $pagamentoIrpjCsll){
    //     $this->tipoSocietario = $tipoSocietario;
    //     $this->nomeEmpresa = $nomeEmpresa;
    //     $this->nomeUm = $nomeUm;
    //     $this->nomeDois = $nomeDois;
    //     $this->nomeDois = $nomeTres;
    //     $this->regimeTributario = $regimeTributario;
    //     $this->cnpj = $cnpj;
    //     $this->dataViabilidade = $dataViabilidade;
    //     $this->objeto = $objeto;
    //     $this->capitalSocial = $capitalSocial;
    //     $this->pagamentoIrpjCsll = $pagamentoIrpjCsll;
    // }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Tipo Societario
     *
     * @return mixed
     */
    public function getTipoSocietario()
    {
        return $this->tipoSocietario;
    }

    /**
     * Set the value of Tipo Societario
     *
     * @param mixed tipoSocietario
     *
     * @return self
     */
    public function setTipoSocietario($tipoSocietario)
    {
        $this->tipoSocietario = $tipoSocietario;

        return $this;
    }

    /**
     * Get the value of Nome Empresa
     *
     * @return mixed
     */
    public function getNomeEmpresa()
    {
        return $this->nomeEmpresa;
    }

    /**
     * Set the value of Nome Empresa
     *
     * @param mixed nomeEmpresa
     *
     * @return self
     */
    public function setNomeEmpresa($nomeEmpresa)
    {
        $this->nomeEmpresa = $nomeEmpresa;

        return $this;
    }

    /**
     * Get the value of Nome Um
     *
     * @return mixed
     */
    public function getNomeUm()
    {
        return $this->nomeUm;
    }

    /**
     * Set the value of Nome Um
     *
     * @param mixed nomeUm
     *
     * @return self
     */
    public function setNomeUm($nomeUm)
    {
        $this->nomeUm = $nomeUm;

        return $this;
    }

    /**
     * Get the value of Nome Dois
     *
     * @return mixed
     */
    public function getNomeDois()
    {
        return $this->nomeDois;
    }

    /**
     * Set the value of Nome Dois
     *
     * @param mixed nomeDois
     *
     * @return self
     */
    public function setNomeDois($nomeDois)
    {
        $this->nomeDois = $nomeDois;

        return $this;
    }

    /**
     * Get the value of Nome Tres
     *
     * @return mixed
     */
    public function getNomeTres()
    {
        return $this->nomeTres;
    }

    /**
     * Set the value of Nome Tres
     *
     * @param mixed nomeTres
     *
     * @return self
     */
    public function setNomeTres($nomeTres)
    {
        $this->nomeTres = $nomeTres;

        return $this;
    }

    /**
     * Get the value of Regime Tributario
     *
     * @return mixed
     */
    public function getRegimeTributario()
    {
        return $this->regimeTributario;
    }

    /**
     * Set the value of Regime Tributario
     *
     * @param mixed regimeTributario
     *
     * @return self
     */
    public function setRegimeTributario($regimeTributario)
    {
        $this->regimeTributario = $regimeTributario;

        return $this;
    }

    /**
     * Get the value of Cnpj
     *
     * @return mixed
     */
    public function getCnpj()
    {
        return $this->cnpj;
    }

    /**
     * Set the value of Cnpj
     *
     * @param mixed cnpj
     *
     * @return self
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;

        return $this;
    }

    /**
     * Get the value of Data Viabilidade
     *
     * @return mixed
     */
    public function getDataViabilidade()
    {
        return $this->dataViabilidade;
    }

    /**
     * Set the value of Data Viabilidade
     *
     * @param mixed dataViabilidade
     *
     * @return self
     */
    public function setDataViabilidade($dataViabilidade)
    {
        $this->dataViabilidade = $dataViabilidade;

        return $this;
    }

    /**
     * Get the value of Objeto
     *
     * @return mixed
     */
    public function getObjeto()
    {
        return $this->objeto;
    }

    /**
     * Set the value of Objeto
     *
     * @param mixed objeto
     *
     * @return self
     */
    public function setObjeto($objeto)
    {
        $this->objeto = $objeto;

        return $this;
    }

    /**
     * Get the value of Capital Social
     *
     * @return mixed
     */
    public function getCapitalSocial()
    {
        return $this->capitalSocial;
    }

    /**
     * Set the value of Capital Social
     *
     * @param mixed capitalSocial
     *
     * @return self
     */
    public function setCapitalSocial($capitalSocial)
    {
        $this->capitalSocial = $capitalSocial;

        return $this;
    }

    /**
     * Get the value of Pagamento Irpj Csll
     *
     * @return mixed
     */
    public function getPagamentoIrpjCsll()
    {
        return $this->pagamentoIrpjCsll;
    }

    /**
     * Set the value of Pagamento Irpj Csll
     *
     * @param mixed pagamentoIrpjCsll
     *
     * @return self
     */
    public function setPagamentoIrpjCsll($pagamentoIrpjCsll)
    {
        $this->pagamentoIrpjCsll = $pagamentoIrpjCsll;

        return $this;
    }

    /**
     * Get the value of Atividade Principal
     *
     * @return mixed
     */
    public function getAtividadePrincipal()
    {
        return $this->atividadePrincipal;
    }

    /**
     * Set the value of Atividade Principal
     *
     * @param mixed atividadePrincipal
     *
     * @return self
     */
    public function setAtividadePrincipal($atividadePrincipal)
    {
        $this->atividadePrincipal = $atividadePrincipal;

        return $this;
    }

    /**
     * Get the value of Inicio Atividades
     *
     * @return mixed
     */
    public function getInicioAtividades()
    {
        return $this->inicioAtividades;
    }

    /**
     * Set the value of Inicio Atividades
     *
     * @param mixed inicioAtividades
     *
     * @return self
     */
    public function setInicioAtividades($inicioAtividades)
    {
        $this->inicioAtividades = $inicioAtividades;

        return $this;
    }

    /**
     * Get the value of Data Sn
     *
     * @return mixed
     */
    public function getDataSn()
    {
        return $this->dataSn;
    }

    /**
     * Set the value of Data Sn
     *
     * @param mixed dataSn
     *
     * @return self
     */
    public function setDataSn($dataSn)
    {
        $this->dataSn = $dataSn;

        return $this;
    }

    /**
     * Get the value of Porte
     *
     * @return mixed
     */
    public function getPorte()
    {
        return $this->porte;
    }

    /**
     * Set the value of Porte
     *
     * @param mixed porte
     *
     * @return self
     */
    public function setPorte($porte)
    {
        $this->porte = $porte;

        return $this;
    }

    public function getVinculo()
    {
        return $this->vinculo;
    }

    public function setVinculo($vinculo)
    {
        $this->vinculo = $vinculo;

        return $this;
    }

}
