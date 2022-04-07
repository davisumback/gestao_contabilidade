<?php
use App\View\ListaDeItensDeMenu;
use App\View\Menu;
use App\View\MenuN;

require_once('../../vendor/autoload.php');

$menu = new MenuN();

$listaDeItensDeMenu = new ListaDeItensDeMenu();
$listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-home', 'Home');
$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Cadastro'));
$listaDeItensDeMenu2 = new ListaDeItensDeMenu();
$listaDeItensDeMenu2->setItemMenuSimples('form-cnpj.php', 'menu-icon fas fa-building', 'Empresa');
$listaDeItensDeMenu2->setItemMenuSimples('ies.php', 'menu-icon fa fa-university', 'IES');
$listaDeItensDeMenu2->setItemMenuSimples('form-cliente.php', 'menu-icon fa fa-user', 'Cliente');
$listaDeItensDeMenu2->setItemMenuSimples('pis.php', 'menu-icon fas fa-id-card', 'PIS');
$listaDeItensDeMenu2->setItemMenuSimples('domestica.php', 'menu-icon fas fa-user-plus', 'Doméstica');
$listaDeItensDeMenu2->setItemMenuSimples('acesso.php', 'menu-icon fas fa-map-pin', 'Acessos');
$listaDeItensDeMenu2->setItemMenuSimples('servico-nfse.php', 'menu-icon fas fa-clipboard-check', 'Serviços NFSe');
$listaDeItensDeMenu2->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu2->getMenuSimples());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Empresa'));
$listaDeItensDeMenu3 = new ListaDeItensDeMenu();
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-search', 'empresa-pesquisa.php', 'Pesquisar');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-building', 'empresa-dados.php', 'Dados Cadastrais');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-file-alt', 'empresa-cnae.php', 'CNAE');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-folder-open', 'empresa-arquivos.php', 'Arquivos');
// $listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-file-alt', 'empresa-guias.php', 'Acessos');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-envelope-open', 'empresa-emails.php', 'Emails');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-money-check-alt', 'empresa-contabancaria.php', 'Conta Bancária');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fa fa-users', 'empresa-funcionario.php', 'Funcionarios');
// $listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-user-check', 'empresa-credenciamento.php', 'Credenciamento');
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