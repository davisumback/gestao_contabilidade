<?php

use App\Arquivo\CriaPasta;

require_once '../../../vendor/autoload.php';

session_start();
$pastaView = '../../' . $_SESSION['pasta'];

$_POST['nome_pasta'] = str_replace(" ", "_", $_POST['nome_pasta']);
$retorno = CriaPasta::criaPasta('../'.$_POST['diretorio_atual'].$_POST['nome_pasta']);

header('Location: ' . $pastaView . '/empresa-arquivos.php?dir='.$_POST['diretorio_atual']);
die();
