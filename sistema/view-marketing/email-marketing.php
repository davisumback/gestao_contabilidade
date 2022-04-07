<?php
use App\Config\BancoConfig;

include __DIR__ . '/../../vendor/autoload.php';

$titulo = $_POST['titulo'];
$texto = $_POST['texto'];

$conexao = new BancoConfig();
$conecta = $conexao->conecta();

$query = "INSERT INTO email_marketing(titulo, conteudo) VALUES ('{$titulo}','{$texto}');";
mysqli_query($conecta, $query);
