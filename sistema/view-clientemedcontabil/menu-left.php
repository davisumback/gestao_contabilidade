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
$listaDeItensDeMenu->setItemMenuSimples('nota-fiscal.php', 'menu-icon fas fa-file-invoice', 'Notas Fiscais');
// $listaDeItensDeMenu->setItemMenuSimples('oportunidade.php', 'menu-icon fas fa-money-bill-wave', 'Oportunidades');
$listaDeItensDeMenu->setItemMenuSimples('envio-documentos.php', 'menu-icon fa fa-file-upload', 'Envio de Documentos');
$listaDeItensDeMenu->setItemMenuSimples('empresa-arquivos.php', 'menu-icon fas fa-folder-open', 'Arquivos');
$listaDeItensDeMenu->setItemMenuSimples('faturamento.php', 'menu-icon fas fa-chart-bar', 'Faturamentos');
// $listaDeItensDeMenu->setItemMenuSimples('nota-fiscal.php', 'menu-icon fas fa-handshake', 'Notas Fiscais');
$listaDeItensDeMenu->setItemMenuSimples('empresa-contabancaria.php', 'menu-icon fas fa-money-check-alt', 'Conta Bancária');
// $listaDeItensDeMenu->setItemMenuSimples('certificado.php', 'menu-icon fas fa-file-prescription', 'Certificado');
$listaDeItensDeMenu->setMenuSimmples('active');
$menu->setItemMenu($listaDeItensDeMenu->getMenuSimples());

// $listaDeItensDeMenu = new ListaDeItensDeMenu();
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-file-prescription', 'certificado.php', 'Certificado');
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-share-square', 'nota-fiscal.php', 'Emitir');
// $listaDeItensDeMenu->setMenuLiDropDown('NFSe', '#', 'menu-icon fas fa-file-invoice');
// $menu->setItemMenu($listaDeItensDeMenu->getMenuLiDropDown());

$menu->setItemMenu($listaDeItensDeMenu->setCategoriaMenuMedcontabil('Requisição de Serviços'));

$listaDeItensDeMenu3 = new ListaDeItensDeMenu();
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-user-alt', 'ordem-servico-lista.php?view=all&method=getAllEmitidasMedcontabil&view=all&tipoOs=all&status=all&periodo=30', 'Minhas O.S.');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-notes-medical', 'ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=1', 'Credenciamento');
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-hand-holding-usd', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=2', 'Faturamento');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-calendar-check', 'ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=3', 'Emissão Certidão');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fa fa-calculator', 'ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=4', 'Recálculo Guias');
// $listaDeItensDeMenu->setItemDropDownMenu('menu-icon fas fa-file-signature', 'ordem-servico-lista.php?method=getAllEmitidas&tipoOs=5', 'Alteração Contratual');
$listaDeItensDeMenu3->setItemDropDownMenu('menu-icon fas fa-hand-holding-usd', 'ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=7', 'Dec. Rendimentos');
$listaDeItensDeMenu->setItemDropDownMenu('menu-icon fa fa-comments', 'ordem-servico-lista.php?method=getAllEmitidasMedcontabil&tipoOs=6', 'Outros');
$listaDeItensDeMenu3->setMenuLiDropDown('Ordem de Serviço', '#', 'menu-icon fas fa-concierge-bell');
$menu->setItemMenu($listaDeItensDeMenu3->getMenuLiDropDown());