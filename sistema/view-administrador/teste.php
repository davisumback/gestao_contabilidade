<?php
use App\DAO\AdministradorDAO;
use App\DAO\EmpresaDAO;
use App\DAO\GuiaDAO;
use App\DAO\ApiDAO;
use App\Helper\Helpers;

require_once('header.php');
require_once('menu-topo.php');
require_once('menu-left.php');
require_once('../cabecalho.php');

$helper = new Helpers();
$teste = $helper->formataDataPeriodo('add', $_SESSION['dataCompetencia'], 'P1M', 'Y-m');

// $_SESSION['dataCompetencia']

echo $teste;

$arrayExplode = explode('-', $teste);

echo '<pre>';
print_r($arrayExplode);
echo '</pre>';
die();
?>