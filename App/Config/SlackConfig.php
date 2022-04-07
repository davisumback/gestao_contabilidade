<?php
namespace App\Config;

class SlackConfig
{
    const NOME = 'slack';
    private $url;
    private $token;
    private $ativo;

    public function __construct()
    {
        $dao = new \App\DAO\ApiDAO();
        $retorno = $dao->getDadosApi(self::NOME);
        $this->url = $retorno['url'];
        $this->token = $retorno['token'];
        $this->ativo = $retorno['ativo'];
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getAtivo()
    {
        return $this->ativo;
    }
}