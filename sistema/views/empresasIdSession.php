<?php
session_start();
$_SESSION['viewIdEmpresa'] = $_GET['empresasId'];
$_SESSION['viewNomeEmpresa'] = $_GET['empresaNome'];
$pasta = $_SESSION['pasta'];

echo $_SESSION['viewNomeEmpresa'];

$caminho = '../' . $pasta . '/' . $_GET['caminho'];

header('Location: ' . $caminho);
die();
