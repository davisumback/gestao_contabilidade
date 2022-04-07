<?php

include __DIR__ . '/../../../vendor/autoload.php';

try {
    $cliente = new \App\Model\Usuario\Cliente();
    $cliente->setCpf($_REQUEST['cpf']);
    $cliente->setSenha($_REQUEST['senha']);
    $cliente->setVinculo($_REQUEST['vinculo']);
    $clienteLogin = new \App\Login\ClienteLogin();
    $session = $clienteLogin->tentaRealizarLogin($cliente);
} catch (\Throwable $th) {
    header('Location: https://www.medcontabil.com.br/controllers/login/franqueado.php?mensagem=' . $th->getMessage());
    die();
}

header('Location: ../../' . $session['pasta'] . '/index.php');
die();