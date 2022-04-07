<?php
use App\Controller\InconsistenciaController;

require_once('header.php');
require_once('menu-topo.php');
$menu_topo->setTituloNavegacao('Inconsistências :(');
require_once('menu-left.php');
require_once('../cabecalho.php');

$controller = new InconsistenciaController($_REQUEST['action']);
require_once('rodape.php');
require_once('../rodape.php');
