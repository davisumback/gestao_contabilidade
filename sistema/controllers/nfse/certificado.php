<?php
use App\Controller\Nfse\CertificadoController;

include __DIR__ . '/../../../vendor/autoload.php';

$method = $_REQUEST['method'];

$controller = new CertificadoController();
$controller->$method($_FILES, $_REQUEST);