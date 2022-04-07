<?php
use App\View\ListaDeItensDeMenu;
use App\View\Menu;
use App\View\MenuN;

//É preciso fazer a diferença entre menu simples e menu dropList, talvez em classes separadas.
$menu = new MenuN();

$listaDeItensDeMenu = new ListaDeItensDeMenu();
$listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-home', 'Home');
$listaDeItensDeMenu->setItemMenuSimples('empresa-pesquisa.php', 'menu-icon fas fa-search', 'Pesquisar Empresa');
$listaDeItensDeMenu->setItemMenuSimples('email-sistema.php', 'menu-icon fas fa-at', 'Emails Guias');
$listaDeItensDeMenu->setItemMenuSimples('reenvio-email.php', 'menu-icon fas fa-envelope', 'Reenvio Email');
// $listaDeItensDeMenu->setItemMenuSimples('cliente-lista.php', 'menu-icon fas fa-users', 'Clientes');
$listaDeItensDeMenu->setItemMenuSimples('nota-fiscal.php', 'menu-icon fas fa-file-invoice', 'Nota Fiscal');
$listaDeItensDeMenu->setItemMenuSimples('conta-bancaria.php', 'menu-icon fas fa-money-check-alt', 'Conta Bancária');
$listaDeItensDeMenu->setItemMenuSimples('inscricao-municipal.php', 'menu-icon fas fa-pen-alt', 'Insc Municipal');
$listaDeItensDeMenu->setItemMenuSimples('alvara.php', 'menu-icon fas fa-file-signature', 'Alvará');
$listaDeItensDeMenu->setItemMenuSimples('acesso.php', 'menu-icon fas fa-map-pin', 'Acessos');
$listaDeItensDeMenu->setItemMenuSimples('cnae.php', 'menu-icon fas fa-file-alt', 'CNAE');
$listaDeItensDeMenu->setItemMenuSimples('cliente-email.php', 'menu-icon fas fa-envelope-open', 'Email');
$listaDeItensDeMenu->setItemMenuSimples('faturamento.php', 'menu-icon fas fa-chart-bar', 'Faturamento');
$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Empresa'));
$listaDeItensDeMenu3 = new ListaDeItensDeMenu();
// $listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-search', 'empresa-pesquisa.php', 'Pesquisar');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-building', 'empresa-dados.php', 'Dados Cadastrais');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-folder-open', 'empresa-arquivos.php', 'Arquivos');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-envelope-open', 'empresa-emails.php', 'Emails');
// $listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-chart-line', 'empresa-faturamento.php', 'Faturamento');
$listaDeItensDeMenu3->setMenuLiDropDown('Empresa', '#', 'menu-icon fas fa-building');
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

$listaDeItensDeMenu = new ListaDeItensDeMenu();

// $listaDeItensDeMenu->setMenuLiDropDown('NFSe', '#', 'menu-icon fas fa-file-invoice');
// $menu->setItemMenu($listaDeItensDeMenu->getMenuLiDropDown());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Simulador'));
$listaDeItensDeMenu2 = new ListaDeItensDeMenu();
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-search', 'consulta-simulacao.php', 'Buscar');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-chart-pie', 'form-simulador-com.php', 'Completa');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-chart-line', 'form-simulador-res.php"', 'Resumida');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-file-alt', 'form-simulador-ven.php', 'Venda');
$listaDeItensDeMenu2->setMenuLiDropDown('Simulação', '#', 'menu-icon fas fa-signature');
$menu->setItemMenu($listaDeItensDeMenu2->getMenuLiDropDown());