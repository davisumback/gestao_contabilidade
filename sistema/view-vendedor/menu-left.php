<?php
use App\View\ListaDeItensDeMenu;
use App\View\MenuN;

require_once('../../vendor/autoload.php');

$menu = new MenuN();

$listaDeItensDeMenu = new ListaDeItensDeMenu();
$listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-home', 'Home');
// $listaDeItensDeMenu->setItemMenuSimples('cadastro-empresa.php', 'menu-icon fas fa-building', 'Cadastro Empresa');
$listaDeItensDeMenu->setItemMenuSimples('pre-cadastro.php', 'menu-icon fas fa-exclamation', 'Pré Cadastro');
$listaDeItensDeMenu->setItemMenuSimples('lista-cliente.php', 'menu-icon fas fa-users', 'Clientes');
$listaDeItensDeMenu->setItemMenuSimples('lista-empresa.php', 'menu-icon fas fa-building', 'Empresas');
$listaDeItensDeMenu->setItemMenuSimples('locais-trabalho.php', 'menu-icon fa fa-university', 'Locais de Trabalho');
$listaDeItensDeMenu->setItemMenuSimples('resposta-campanha.php', 'menu-icon fas fa-users', 'Palestras');
$listaDeItensDeMenu->setItemMenuSimples('contato.php', 'menu-icon fas fa-id-badge', 'Contatos');
$listaDeItensDeMenu->setItemMenuSimples('ies.php', 'menu-icon fa fa-university', 'IES');
$listaDeItensDeMenu->setItemMenuSimples('form-nota.php', 'menu-icon fa fa-sticky-note', 'Anotações');
$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());

$listaDeItensDeMenu2 = new ListaDeItensDeMenu();
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-stream', 'prospect.php', 'Prospects');
if ($_SESSION['id_usuario'] == 24) {
    $listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-stream', 'prospect-admin.php', 'Franqueados');
}
$listaDeItensDeMenu2->setMenuLiDropDown('Prospects', '#', 'menu-icon fas fa-address-book');
$menu->setItemMenu($listaDeItensDeMenu2->getMenuLiDropDown());

$listaDeItensDeMenu2 = new ListaDeItensDeMenu();
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-user-alt', 'pipedrive-clientes.php', 'Confirmações');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-users', 'pipedrive-socios.php', 'Sócios');
$listaDeItensDeMenu2->setMenuLiDropDown('Pipedrive', '#', 'menu-icon fab fa-product-hunt');
$menu->setItemMenu($listaDeItensDeMenu2->getMenuLiDropDown());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Simulador'));
$listaDeItensDeMenu2 = new ListaDeItensDeMenu();
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-search', 'consulta-simulacao.php', 'Buscar');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-chart-pie', 'form-simulador-com.php', 'Completa');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-chart-line', 'form-simulador-res.php"', 'Resumida');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-file-alt', 'form-simulador-ven.php', 'Venda');
$listaDeItensDeMenu2->setMenuLiDropDown('Simulações', '#', 'menu-icon fas fa-signature');
$menu->setItemMenu($listaDeItensDeMenu2->getMenuLiDropDown());
