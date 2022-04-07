<?php
use App\View\Header;

require_once('../../vendor/autoload.php');

$header = new Header("GrupoB | Admin");

$header->setEstilo("../assets/css/normalize.css");
$header->setEstilo("../assets/css/bootstrap.min.css");
$header->setEstilo("../assets/css/themify-icons.css");
$header->setEstilo("../assets/scss/style.css");
$header->setEstilo("../assets/custom-css/index.css");
$header->setEstilo("../assets/custom-css/cpf-form.css");
$header->setEstilo("../assets/custom-css/cadastro.css");
$header->setEstilo("../assets/custom-css/navegador-arquivos.css");
$header->setEstilo("../assets/custom-css/loading.css");
$header->setEstilo("../assets/custom-css/os.css");

$header->setFont("https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800");
