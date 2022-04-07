<?php
use App\View\ListaDeItensDeMenu;
use App\View\MenuN;

require_once('../../vendor/autoload.php');

$menu = new MenuN();

$listaDeItensDeMenu = new ListaDeItensDeMenu();
$listaDeItensDeMenu->setItemMenuSimples('index.php', 'menu-icon fa fa-home', 'Home');
$listaDeItensDeMenu->setItemMenuSimples('empresa-pesquisa.php', 'menu-icon fas fa-search', 'Pesquisar Empresa');
$listaDeItensDeMenu->setItemMenuSimples('cliente-lista.php', 'menu-icon fas fa-users', 'Clientes');
$listaDeItensDeMenu->setItemMenuSimples('form-usuario.php', 'menu-icon fa fa-user', 'Usuários');
$listaDeItensDeMenu->setItemMenuSimples('contato.php', 'menu-icon fas fa-id-badge', 'Contatos');
$listaDeItensDeMenu->setItemMenuSimples('form-api.php', 'menu-icon fas fa-rocket', 'API');
$listaDeItensDeMenu->setItemMenuSimples('api-pega-plantao-log.php', 'menu-icon fas fa-cogs', 'Pega Plantão');
$listaDeItensDeMenu->setItemMenuSimples('empresa-arquivos.php', 'menu-icon fas fa-file-upload', 'Upload Arquivos');
$listaDeItensDeMenu->setItemMenuSimples('form-nota.php', 'menu-icon fa fa-sticky-note', 'Anotações');

$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());

$listaDeItensDeMenuVendedor = new ListaDeItensDeMenu();
$listaDeItensDeMenuVendedor->setItemDropDownMenu('menu-icon fas fa-users', 'resposta-campanha.php', 'Palestras');
$listaDeItensDeMenuVendedor->setItemDropDownMenu('menu-icon fas fa-exclamation', 'pre-cadastro.php', 'Pré-Cadastro');
$listaDeItensDeMenuVendedor->setItemDropDownMenu('menu-icon fas fa-address-book', 'prospect.php', 'Prospects');
$listaDeItensDeMenuVendedor->setItemDropDownMenu('menu-icon fa fa-university', 'locais-trabalho.php', 'Locais de Trabalho');
$listaDeItensDeMenuVendedor->setMenuLiDropDown('Vendedor', '#', 'menu-icon fas fa-user-check');
$menu->setItemMenu($listaDeItensDeMenuVendedor->getMenuLiDropDown());

$listaDeItensDeMenuContrato = new ListaDeItensDeMenu();
$listaDeItensDeMenuContrato->setItemDropDownMenu('menu-icon fas fa-file-invoice', 'direcionamento-ir.php', 'Direcionamento IR');
$listaDeItensDeMenuContrato->setItemDropDownMenu('menu-icon fas fa-tasks', 'controle.php', 'Controle');
$listaDeItensDeMenuContrato->setItemDropDownMenu('menu-icon fas fa-file-prescription', 'certificado.php', 'Certificado');
$listaDeItensDeMenuContrato->setMenuLiDropDown('Contrato', '#', 'menu-icon fas fa-address-card');
$menu->setItemMenu($listaDeItensDeMenuContrato->getMenuLiDropDown());

$listaDeItensDeMenuContador = new ListaDeItensDeMenu();
$listaDeItensDeMenuContador->setItemDropDownMenu('menu-icon fas fa-copy', 'empresas-liberadas.php', 'Empresas&nbsp;Liberadas');
$listaDeItensDeMenuContador->setItemDropDownMenu('menu-icon fas fa-exclamation-circle', 'lista-liberacoes.php', 'Pendentes&nbsp;Liberações');
$listaDeItensDeMenuContador->setMenuLiDropDown('Contador', '#', 'menu-icon fas fa-calculator');
$menu->setItemMenu($listaDeItensDeMenuContador->getMenuLiDropDown());

$listaDeItensDeMenuCadastro = new ListaDeItensDeMenu();
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-money-check-alt', 'conta-bancaria.php', 'Conta&nbsp;Bancária');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-user-plus', 'domestica.php', 'Dométicas');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-pen-alt', 'inscricao-municipal.php', 'Insc Municipal');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-file-signature', 'alvara.php', 'Alvará');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-envelope-open', 'cliente-email.php', 'Email');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-chart-bar', 'faturamento.php', 'Faturamento');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-map-pin', 'acesso.php', 'Acessos');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-clipboard-check', 'servico-nfse.php', 'Serviços NFSe');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-university', 'ies.php', 'IES');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-money-check', 'form-plano.php', 'Planos');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-hand-holding-usd', 'desconto.php', 'Descontos');
$listaDeItensDeMenuCadastro->setItemDropDownMenu('menu-icon fas fa-file-alt', 'cnae.php', 'CNAE');
$listaDeItensDeMenuCadastro->setMenuLiDropDown('Cadastro', '#', 'menu-icon fas fa-file-signature');
$menu->setItemMenu($listaDeItensDeMenuCadastro->getMenuLiDropDown());

$listaDeItensDeMenuGestor = new ListaDeItensDeMenu();
$listaDeItensDeMenuGestor->setItemDropDownMenu('menu-icon fas fa-file-invoice', 'nota-fiscal.php', 'Nota Fiscal');
$listaDeItensDeMenuGestor->setItemDropDownMenu('menu-icon fas fa-at', 'email-sistema.php', 'Emails Guias');
$listaDeItensDeMenuGestor->setMenuLiDropDown('Gestor', '#', 'menu-icon fas fa-user');
$menu->setItemMenu($listaDeItensDeMenuGestor->getMenuLiDropDown());

$listaDeItensDeMenuMarketing = new ListaDeItensDeMenu();
$listaDeItensDeMenuMarketing->setItemDropDownMenu('menu-icon fas fa-newspaper', 'lista-newsletter.php', 'Newsletter');
$listaDeItensDeMenuMarketing->setItemDropDownMenu('menu-icon fas fa-envelope', 'campanha.php', 'Campanhas');
$listaDeItensDeMenuMarketing->setMenuLiDropDown('Marketing', '#', 'menu-icon fas fa-user');
$menu->setItemMenu($listaDeItensDeMenuMarketing->getMenuLiDropDown());

// *********************************************************************************************************************

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenu('Empresa'));
$listaDeItensDeMenu3 = new ListaDeItensDeMenu();
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-search', 'empresa-pesquisa.php', 'Pesquisar');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-building', 'empresa-dados.php', 'Dados Cadastrais');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-file-alt', 'empresa-cnae.php', 'CNAE');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-folder-open', 'empresa-arquivos.php', 'Arquivos');
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
$listaDeItensDeMenu2 = new ListaDeItensDeMenu();
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-search', 'consulta-simulacao.php', 'Buscar');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-chart-pie', 'form-simulador-com.php', 'Completa');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-chart-line', 'form-simulador-res.php"', 'Resumida');
$listaDeItensDeMenu2->setItemDropDownMenu('menu-icon fas fa-file-alt', 'form-simulador-ven.php', 'Venda');
$listaDeItensDeMenu2->setMenuLiDropDown('Simulação', '#', 'menu-icon fas fa-signature');
$menu->setItemMenu($listaDeItensDeMenu2->getMenuLiDropDown());
