<?php

include __DIR__ . '/../../../../vendor/autoload.php';

$dataPesquisa = $_GET['dataPesquisa'];

$date = DateTime::createFromFormat('d/m/Y', $dataPesquisa);

if ($date == false ) {
    echo 'Você digitou uma data inválida!';
    die();
}

$dao = new \App\DAO\EmpresasLiberacoesDAO();
$liberacoes = $dao->getEmpresasLiberadasEProlabores($date->format('Y-m-d'));

$dataEmissao = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

if (empty($liberacoes)) {
    $html = file_get_contents('sem-liberacoes.html');
    $html = str_replace('{{horarioEmissao}}', $dataEmissao->format('d/m/Y') . ' às ' . $dataEmissao->format('H:i:s'), $html);
    echo $html;
    die();
}

$html = file_get_contents('liberadas.html');



$html = str_replace('{{horarioEmissao}}', $dataEmissao->format('d/m/Y') . ' às ' . $dataEmissao->format('H:i:s'), $html);
$html = str_replace('{{competenciaAnterior}}', $liberacoes[0]->competenciaAnterior, $html);
$html = str_replace('{{competencia}}', $liberacoes[0]->competencia, $html);

foreach ($liberacoes as $liberacao) {
    $linhasTabela .=
        '<tr>' .
            '<td>' . $liberacao->empresas_id . '</td>' .
            '<td>' . $liberacao->nome_empresa . '</td>' .
            '<td>' . $liberacao->prolaboreAnterior . '</td>' .
            '<td>' . $liberacao->prolaboreCompetencia . '</td>' .
        '</tr>';
}

$html = str_replace('{{linhas}}', $linhasTabela, $html);

echo $html;