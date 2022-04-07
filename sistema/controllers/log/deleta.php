<?php

include __DIR__ . '/../../../vendor/autoload.php';

session_start();
$pasta = '../../' . $_SESSION['pasta'];
$caminho = $pasta . '/logs.php';

$retorno = unlink('../../../../logs/' . $_POST['log']);

header('Location: ' . $caminho);
die();