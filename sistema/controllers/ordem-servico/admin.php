<?php
use App\Controller\AdminOrdemServicoController;

include __DIR__ . '/../../../vendor/autoload.php';

$metodo = $_REQUEST['method'];

// echo '<pre>';
// print_r($_REQUEST);
// echo '</pre>';
// die();

$controller = new AdminOrdemServicoController();
$controller->$metodo($_REQUEST);