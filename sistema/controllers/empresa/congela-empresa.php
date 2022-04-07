<?php

use App\DAO\EmpresaUsuarioCongDAO;
use App\DAO\EmpresaDAO;

require_once '../../../vendor/autoload.php';

$pasta = '../../' . $_POST['pasta'];

$dao = new EmpresaDAO();
$dao->setEmpresaCongelada($_POST['congelada'], $_POST['id_empresa']);

$dataCompetencia = '01/'. $_POST['data'];

$data = new DateTime();
$dataCompetencia = $data->createFromFormat('d/m/Y', $dataCompetencia);
$dataCompetencia = $dataCompetencia->format('Y-m-d');

$dao = new EmpresaUsuarioCongDAO();
$retorno = $dao->setCongelamento($_POST['id_empresa'], $_POST['id_usuario'], $_POST['congelada'], $dataCompetencia);

header('Location: ' . $pasta . '/empresa-dados.php');
die();
