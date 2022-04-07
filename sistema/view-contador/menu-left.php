<?php
use App\View\ListaDeItensDeMenu;
use App\View\Menu;
use App\View\MenuN;

require_once('../../vendor/autoload.php');

$menu = new MenuN();

$listaDeItensDeMenu = new ListaDeItensDeMenu();
$listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-home', 'Home');
$listaDeItensDeMenu->setItemMenuSimples('email-sistema.php', 'menu-icon fas fa-at', 'Emails Guias');
$listaDeItensDeMenu->setItemMenuSimples('empresas-liberadas.php', 'menu-icon fas fa-file-invoice', 'Empresas Liberadas');
$listaDeItensDeMenu->setItemMenuSimples('direcionamento-ir.php', 'menu-icon fas fa-copy', 'Direcionamento IR');
$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Empresa'));
$listaDeItensDeMenu3 = new ListaDeItensDeMenu();
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-search', 'empresa-pesquisa.php', 'Pesquisar');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-building', 'empresa-dados.php', 'Dados Cadastrais');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-folder-open', 'empresa-arquivos.php', 'Arquivos');
// $listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-folder-open', 'empresa-arquivos.php?dir=../../grupobfiles/empresas/' . $_SESSION['viewIdEmpresa'] . '/upload-contabilidade/', 'Arquivos Contab.');
// $listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-folder-open', 'empresa-arquivos.php', 'Arquivos Contab.');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-file-alt', 'empresa-guias.php', 'Guias');
$listaDeItensDeMenu3->setMenuLiDropDown('Perfil', '#', 'menu-icon fas fa-building');
$menu->setItemMenu($listaDeItensDeMenu3->getMenuLiDropDown());

$listaDeItensDeMenu3 = new ListaDeItensDeMenu();
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-user-alt', 'ordem-servico-lista.php?method=getAllEmitidas&view=all&tipoOs=all&status=all&periodo=30', 'Minhas O.S.');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-notes-medical', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=1', 'Credenciamento');
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-hand-holding-usd', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=2', 'Faturamento');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-calendar-check', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=3', 'Emissão Certidão');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fa fa-calculator', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=4', 'Recálculo Guias');
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-file-signature', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=5', 'Alteração Contratual');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-hand-holding-usd', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=7', 'Dec. Rendimentos');
$listaDeItensDeMenu->setItemDropDownMenu('menu-icon fa fa-comments', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=6', 'Outros');
$listaDeItensDeMenu3->setMenuLiDropDown('Ordem de Serviço', '#', 'menu-icon fas fa-concierge-bell');
$menu->setItemMenu($listaDeItensDeMenu3->getMenuLiDropDown());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Simulador'));
$listaDeItensDeMenu3 = new ListaDeItensDeMenu();
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-search', 'consulta-simulacao.php', 'Buscar');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-chart-pie', 'form-simulador-com.php', 'Completa');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-chart-line', 'form-simulador-res.php"', 'Resumida');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-file-alt', 'form-simulador-ven.php', 'Venda');
$listaDeItensDeMenu3->setMenuLiDropDown('Simulação', '#', 'menu-icon fas fa-signature');
$menu->setItemMenu($listaDeItensDeMenu3->getMenuLiDropDown());