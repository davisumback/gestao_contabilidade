<?php

namespace App\Usuario;

class Usuario{
    private $id;
    private $usuario;
    private $nome_completo;
    private $senha;
    private $tipo;
    private $data_criacao;
    private $ativo;
    private $email;
    private $avatar;

    function __construct($usuario, $nome_completo, $tipo, $data_criacao="", $ativo="", $email, $senha = "", $avatar = ""){
        $this->usuario = $usuario;
        $this->nome_completo = $nome_completo;
        $this->tipo = $tipo;
        $this->data_criacao = $data_criacao;
        $this->ativo = $ativo;
        $this->email = $email;
        $this->senha = $senha;
        $this->avatar = $avatar;
    }

    public function getAvatar(){
        return $this->avatar;
    }

  public function setId($id){
      $this->id = $id;

      return $this;
  }

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
   * Get the value of Usuario
   *
   * @return mixed
   */
  public function getUsuario()
  {
      return $this->usuario;
  }

  /**
   * Get the value of Nome Completo
   *
   * @return mixed
   */
  public function getNomeCompleto()
  {
      return $this->nome_completo;
  }

  /**
   * Get the value of Senha
   *
   * @return mixed
   */
  public function getSenha()
  {
      return $this->senha;
  }

  /**
   * Get the value of Tipo
   *
   * @return mixed
   */
  public function getTipo()
  {
      return $this->tipo;
  }

  /**
   * Get the value of Data Criacao
   *
   * @return mixed
   */
  public function getDataCriacao()
  {
      return $this->data_criacao;
  }

  /**
   * Get the value of Ativo
   *
   * @return mixed
   */
  public function getAtivo()
  {
      return $this->ativo;
  }

  /**
   * Get the value of Email
   *
   * @return mixed
   */
  public function getEmail()
  {
      return $this->email;
  }




}
