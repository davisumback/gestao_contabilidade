<?php
use App\View\MenuTopo;

$auth = new \App\Model\Usuario\Auth();
$auth->isSessioExpired();

$menu_topo = new MenuTopo();
$menu_topo->setSair("../../login/logout.php");
$titulo = "Home - " . $_SESSION['nome_completo'];
$menu_topo->setTituloNavegacao($titulo);

$avatar = $_SESSION['avatar'];
