<?php
use App\View\ListaDeItensDeMenu;
use App\View\Menu;
use App\View\MenuN;

require_once('../../vendor/autoload.php');

//É preciso fazer a diferença entre menu simples e menu dropList, talvez em classes separadas.
$menu = new MenuN();

$listaDeItensDeMenu = new ListaDeItensDeMenu();
$listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-home', 'Home');
$listaDeItensDeMenu->setItemMenuSimples('campanha.php', 'menu-icon fas fa-envelope', 'Campanhas');
$listaDeItensDeMenu->setItemMenuSimples('cliente-lista.php', 'menu-icon fas fa-users', 'Clientes');
$listaDeItensDeMenu->setItemMenuSimples('direcionamento-ir.php', 'menu-icon fas fa-address-card', 'Direcionamento IR');
$listaDeItensDeMenu->setItemMenuSimples('prospect.php', 'menu-icon fas fa-users', 'Prospects');
$listaDeItensDeMenu->setItemMenuSimples('resposta-campanha.php', 'menu-icon fas fa-users', 'Palestras');
$listaDeItensDeMenu->setItemMenuSimples('lista-newsletter.php', 'menu-icon fas fa-newspaper', 'Newsletter');
$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());
