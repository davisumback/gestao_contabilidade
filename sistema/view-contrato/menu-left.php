<?php
use App\View\ListaDeItensDeMenu;
use App\View\Menu;
use App\View\MenuN;

require_once('../../vendor/autoload.php');

//É preciso fazer a diferença entre menu simples e menu dropList, talvez em classes separadas.
$menu = new MenuN();

$listaDeItensDeMenu = new ListaDeItensDeMenu();
$listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-home', 'Home');
$listaDeItensDeMenu->setItemMenuSimples('direcionamento-ir.php', 'menu-icon fas fa-copy', 'Direcionamento IR');
$listaDeItensDeMenu->setItemMenuSimples('controle.php', 'menu-icon fas fa-tasks', 'Controle');
$listaDeItensDeMenu->setItemMenuSimples('certificado.php', 'menu-icon fas fa-file-prescription', 'Certificado');
$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());

// $menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Pre-Empresa'));
// $listaDeItensDeMenu = new ListaDeItensDeMenu();
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-search', 'pre-empresa-all.php', 'Pesquisar');
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-building', 'pre-empresa-dados.php', 'Dados Cadastrais');
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-folder-open', 'pre-empresa-arquivos.php', 'Arquivos');
// $listaDeItensDeMenu->setMenuLiDropDown('Pre-Empresa', '#', 'menu-icon fas fa-building');
// $menu->setItemMenu($listaDeItensDeMenu->getMenuLiDropDown());
