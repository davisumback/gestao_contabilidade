<?php
namespace App\Controller;

class Controller
{
    public function redirect($status, $mensagem, $caminho)
    {
        setcookie('insercaoOs', $status, time()+2, '/');
        setcookie('mensagemInsercaoOs', $mensagem, time()+2, '/');
        header('Location: ' . $caminho);
        die();
    }

    public function redirectErro($nomeCookie, $variavelMensagem, $mensagem, $caminho)
    {
        setcookie($nomeCookie, 'false', time()+2, '/');
        setcookie($variavelMensagem, $mensagem, time()+2, '/');
        header('Location: ' . $caminho);
        die();
    }

    public function redirectSucesso($nomeCookie, $variavelMensagem, $mensagem, $caminho)
    {
        setcookie($nomeCookie, 'true', time()+2, '/');
        setcookie($variavelMensagem, $mensagem, time()+2, '/');
        header('Location: ' . $caminho);
        die();
    }
}
