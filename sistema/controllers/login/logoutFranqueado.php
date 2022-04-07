<?php

include __DIR__ . '/../../../vendor/autoload.php';

$fraqueadoLogin = new \App\Login\FranqueadoLogin();
$fraqueadoLogin->logout();

header('Location: https://www.medcontabil.com.br/login');
die();