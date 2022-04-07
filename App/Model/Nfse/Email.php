<?php
namespace App\Model\Nfse;

class Email
{
    private $envio;

    public function __construct($envio = false)
    {
        $this->envio = $envio;
    }

    public function getEnvio()
    {
        return $this->envio;
    }
}