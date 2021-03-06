<?php
namespace App\Model\Email\Pipedrive;

use App\Html\Email\Pipedrive\ClienteExistente;
use App\Email\EnviaEmail;

class PendenciaClienteExistente
{
    private $userName;
    private $userEmail;
    private $personName;

    public function __construct($userName, $userEmail, $personName)
    {
        $this->userName = $userName;
        $this->userEmail = $userEmail;
        $this->personName = $personName;
    }

    public function enviaEmailPendencias()
    {
        $clienteExistente = new ClienteExistente();
        $corpoEmail = $clienteExistente->getCorpoEmail();

        $corpoEmail = str_replace('{{user}}', $this->userName, $corpoEmail);
        $corpoEmail = str_replace('{{person}}', $this->personName, $corpoEmail);

        // $retornoEmail = EnviaEmail::send($this->userEmail, $this->userName, 'PendĂȘncias | Cadastro Cliente', $corpoEmail);
        $retornoEmail = EnviaEmail::send('tthiagogaia@gmail.com', $this->userName, 'PendĂȘncias | Cadastro Cliente', $corpoEmail);

        return $retornoEmail;
    }
}
