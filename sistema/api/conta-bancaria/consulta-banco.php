<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

// include __DIR__ . '/../../../vendor/autoload.php';
print_r($_GET);

$empresasId = ($_POST['empresasId']);


// $entrada = file_get_contents('php://input');

// $resultado = json_decode($entrada, true);

// echo json_encode($resultado['entrada']);
