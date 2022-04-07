<?php

include __DIR__ . '/../../../vendor/autoload.php';

try {
    $fraqueadoLogin = new \App\Login\FranqueadoLogin();
    $session = $fraqueadoLogin->tentaRealizarLogin($_REQUEST);    
} catch (\Throwable $th) {   
    header('Location: https://www.medcontabil.com.br/controllers/login/franqueado.php?mensagem=' . $th->getMessage());
    die();
}

header('Location: ../../' . $session['pasta'] . '/index.php');
die();