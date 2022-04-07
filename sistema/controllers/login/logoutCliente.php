<?php

include __DIR__ . '/../../../vendor/autoload.php';

$clienteLogin = new \App\Login\ClienteLogin();
$clienteLogin->logout();

header('Location: https://www.medcontabil.com.br/login');
die();