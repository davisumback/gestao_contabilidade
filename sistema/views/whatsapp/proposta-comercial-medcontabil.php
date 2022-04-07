<?php

use App\Helper\Helpers;
use App\Helper\HelperView;

include __DIR__ . '/../../../vendor/autoload.php';

$dao = new \App\DAO\ProspectDAO();
$proposta = $dao->getPropostaMedcontabil($_GET['proposal']);

if ($proposta == null)  {
    header('Location: https://www.medcontabil.com.br');
    die();
} else {
    $faturamentoMensal = HelperView::getValorFaixaPrecoMedcontabil($proposta['mensalidade_faixa']);

    $corpoEmail = file_get_contents('../email/proposta/proposta-comercial-medcontabil.php');
    $corpoEmail = str_replace('{{nomeContato}}', $proposta['aos_cuidados'], $corpoEmail);
    $corpoEmail = str_replace('{{nomeEmpresa}}', $proposta['empresa_nome'], $corpoEmail);
    $corpoEmail = str_replace('{{mensalidade}}', Helpers::formataMoedaView($proposta['mensalidade_faixa'] * 178), $corpoEmail);
    $corpoEmail = str_replace('{{quantidadeSocios}}', str_pad($proposta['socios'], 2, "0", STR_PAD_LEFT), $corpoEmail);
    $corpoEmail = str_replace('{{socios}}', Helpers::formataMoedaView($proposta['socios'] * 40), $corpoEmail);
    $corpoEmail = str_replace('{{quantidadeFuncionarios}}', str_pad($proposta['funcionarios'], 2, "0", STR_PAD_LEFT), $corpoEmail);
    $corpoEmail = str_replace('{{funcionarios}}', Helpers::formataMoedaView($proposta['funcionarios'] * 40), $corpoEmail);
    $corpoEmail = str_replace('{{total}}', Helpers::formataMoedaView($proposta['valor_total']), $corpoEmail);
    $corpoEmail = str_replace('{{totalEconomia}}', Helpers::formataMoedaView($proposta['economia_total']), $corpoEmail);
    $corpoEmail = str_replace('{{faturamentoMensal}}', $faturamentoMensal, $corpoEmail);
    $corpoEmail = str_replace('{{totalAtual}}', Helpers::formataMoedaView($proposta['total_atual']), $corpoEmail);
    $corpoEmail = str_replace('{{caminhoImagem}}', $proposta['caminho_imagem'], $corpoEmail);
    $corpoEmail = str_replace('{{emailUsuario}}', $proposta['email_usuario'], $corpoEmail);    
    $corpoEmail = str_replace('{{nomeUsuario}}', $proposta['nome_usuario'], $corpoEmail);
    
    if ($proposta['logradouro'] != null) {
        $corpoEmail = str_replace('{{logradouroNumero}}', $proposta['logradouro'] . ', ' . $proposta['numero'] . '.', $corpoEmail);
    } else {
        $corpoEmail = str_replace('{{logradouroNumero}}', '', $corpoEmail);
    }

    if ($proposta['complemento'] != null) {
        $corpoEmail = str_replace('{{complemento}}', $proposta['complemento'], $corpoEmail);
    } else {
        $corpoEmail = str_replace('{{complemento}}', '', $corpoEmail);
    }

    if ($proposta['cidade'] != null) {
        $corpoEmail = str_replace('{{cidadeUf}}', $proposta['cidade'] . '-' . $proposta['uf'], $corpoEmail);
    } else {
        $corpoEmail = str_replace('{{cidadeUf}}', '', $corpoEmail);
    }

    if ($proposta['telefone_usuario'] != null) {
        $corpoEmail = str_replace('{{telefoneUsuario}}', Helpers::mask($proposta['telefone_usuario'], '(##) # ####-####'), $corpoEmail);
    } else {
        $corpoEmail = str_replace('{{telefoneUsuario}}', '', $corpoEmail);
    }
    
    echo $corpoEmail;
}

