<?php
session_start();

if($_SESSION['id_usuario'] == null) {
    setcookie('retorno_sessao', 'true', time()+2, '/');
    setcookie('mensagem_sessao', 'Você não pode acessar diretamente o sistema sem fazer login', time()+2, '/');
    header("Location: ../../index.php");
}

use App\View\MenuTopo;

require_once('../../vendor/autoload.php');
$menu_topo = new MenuTopo();
$menu_topo->setSair("../controllers/login/logoutFranqueado.php");
$titulo = "Home - " . $_SESSION['nome_completo'];
$menu_topo->setTituloNavegacao($titulo);