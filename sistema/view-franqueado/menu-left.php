<?php
use App\View\ListaDeItensDeMenu;
use App\View\Menu;
use App\View\MenuN;

require_once('../../vendor/autoload.php');

//É preciso fazer a diferença entre menu simples e menu dropList, talvez em classes separadas.
$menu = new MenuN();

$listaDeItensDeMenu = new ListaDeItensDeMenu();
// $listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-user', 'Meu Perfil', 'opcao-perfil');
// $listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-key', 'Alterar Senha', 'opcao-alterar-senha');
$listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-home', 'Home');
$listaDeItensDeMenu->setItemMenuSimples('prospect.php', 'menu-icon fas fa-address-book', 'Prospect');
$listaDeItensDeMenu->setItemMenuSimples('form-nota.php', 'menu-icon fas fa-sticky-note', 'Anotações');
$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Simulador'));
$listaDeItensDeMenu = new ListaDeItensDeMenu();
$listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-search', 'consulta-simulacao.php', 'Buscar');
$listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-chart-pie', 'form-simulador-com.php', 'Completa');
$listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-chart-line', 'form-simulador-res.php"', 'Resumida');
$listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-file-alt', 'form-simulador-ven.php', 'Venda');
$listaDeItensDeMenu->setMenuLiDropDown('Simulação', '#', 'menu-icon fas fa-signature');
$menu->setItemMenu($listaDeItensDeMenu->getMenuLiDropDown());

