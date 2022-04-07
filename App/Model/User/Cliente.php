<?php

namespace App\Model\User;

class Cliente
{
    private $id;
    private $cpf;
    private $nome;
    private $nome_mae;
    private $sexo;
    private $situacao_cadastral;
    private $email;
    private $data_nascimento;
    private $crm;
    private $ies_id;
    private $telefone_comercial;
    private $telefone_celular;
    private $estado_civil;
    private $regime_casamento;
    private $profissao;
    private $socioAdministrador;

    public function __construct($cpf, $nome, $nome_mae = '', $sexo, $situacao_cadastral='',
                                $email = '', $data_nascimento, $crm = '', $ies_id='', $tel_com = '', $tel_cel,
                                $estado_civil, $regime_casamento = '', $profissao, $socioAdministrador = 0
                            )
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->nome_mae = $nome_mae;
        $this->sexo = $sexo;
        $this->situacao_cadastral = $situacao_cadastral;
        $this->email = $email;
        $this->data_nascimento = $data_nascimento;
        $this->crm = $crm;
        $this->ies_id = $ies_id;
        $this->telefone_comercial = $tel_com;
        $this->telefone_celular = $tel_cel;
        $this->estado_civil = $estado_civil;
        $this->regime_casamento = $regime_casamento;
        $this->profissao = $profissao;
        $this->socioAdministrador = $socioAdministrador;
    }

    public function getSocioAdministrador(){
        return $this->socioAdministrador;
    }

    public function getProfissao(){
        return $this->profissao;
    }

    public function getNomeMae(){
        return $this->nome_mae;
    }

    public function getSexo(){
        return $this->sexo;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setCadastroCompleto($completo){
        $this->cadastro_completo = $completo;
    }

    public function getCadastroCompleto(){
        return $this->cadastro_completo;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getSituacaoCadastral(){
        return $this->situacao_cadastral;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getDataNascimento(){
        return $this->data_nascimento;
    }

    public function getCrm(){
        return $this->crm;
    }

    public function getIesId(){
        return $this->ies_id;
    }

    public function getTelefoneComercial(){
        return $this->telefone_comercial;
    }

    public function getTelefoneCelular(){
        return $this->telefone_celular;
    }

    public function getPrimeiraMensalidade(){
        return $this->primeira_mensalidade;
    }

    /**
     * Get the value of Estado Civil
     *
     * @return mixed
     */
    public function getEstadoCivil()
    {
        return $this->estado_civil;
    }

    /**
     * Set the value of Estado Civil
     *
     * @param mixed estado_civil
     *
     * @return self
     */
    public function setEstadoCivil($estado_civil)
    {
        $this->estado_civil = $estado_civil;

        return $this;
    }

    /**
     * Get the value of Regime Casamento
     *
     * @return mixed
     */
    public function getRegimeCasamento()
    {
        return $this->regime_casamento;
    }

    /**
     * Set the value of Regime Casamento
     *
     * @param mixed regime_casamento
     *
     * @return self
     */
    public function setRegimeCasamento($regime_casamento)
    {
        $this->regime_casamento = $regime_casamento;

        return $this;
    }

}
