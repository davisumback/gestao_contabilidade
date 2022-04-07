<?php
use App\View\Header;

require_once('../../vendor/autoload.php');

$header = new Header("Medcontábil");

$header->setEstilo("../assets/css/bootstrap.min.css");
$header->setEstilo("../assets/css/themify-icons.css");
$header->setEstilo("../assets/scss/style.css");
$header->setEstilo("../assets/custom-css/medcontabil/index.css");
$header->setEstilo("../assets/custom-css/medcontabil/os.css");
$header->setEstilo("../assets/custom-css/medcontabil/cadastro.css");
$header->setEstilo("../assets/custom-css/anotacoes.css");
// $header->setEstilo("../assets/custom-css/cadastro.css");
$header->setEstilo("../assets/custom-css/medcontabil/loading.css");
$header->setEstilo("../assets/custom-css/simulador.css");
$header->setEstilo("../assets/custom-css/medcontabil/navegador-arquivos.css");
$header->setFont("https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800");