<?php
use App\DAO\GuiaDAO;
use App\Helper\Helpers;
use App\DAO\EmpresaDAO;

require_once __DIR__ . '/../../../../vendor/autoload.php';

session_start();

$tipoGuia = $_GET['tipo'];
$dataCompetencia = $_SESSION['dataCompetencia'];
$dataCompetenciaView = $_SESSION['dataCompetenciaView'];

$competenciaAnterior = Helpers::formataDataPeriodo('sub', $dataCompetencia, 'P1M', 'Y-m-d');
$competenciaAnteriorView = Helpers::formataDataPeriodo('sub', $dataCompetencia, 'P1M', 'm/Y');

if (!array_key_exists('enviadas', $_GET)) {
    $guiaDao = new GuiaDAO();
    $empresas = $guiaDao->listaGuiasPendentesRh($competenciaAnterior, $dataCompetencia, $tipoGuia);
} else {
    $guiaDao = new GuiaDAO();
    $empresas = $guiaDao->getGuiasEnviadas($tipoGuia, $dataCompetencia);
}

$linhasTabela = '';

if (!array_key_exists('enviadas', $_GET)) {
    foreach ($empresas as $empresa) {
        $classProplaboreAnterior = ($empresa['updatedAt'] == null) ? 'text-success' : 'text-danger';
//        $classProplaboreAtual = ($empresa['updated_at'] == null) ? 'text-success' : 'text-danger';
        $classProplaboreAtual = 'text-success';

        $empresa['prolaboreAnterior'] = ($empresa['regime_tributario'] == 'Presumido') ? 'Presumido' : $empresa['prolaboreAnterior'];
        $empresa['prolabore'] = ($empresa['regime_tributario'] == 'Presumido') ? 'Presumido' : $empresa['prolabore'];

        $linhasTabela .=
            '<tr>' .
            '<td>' . $empresa['id'] . '</td>' .
            '<td>' . $empresa['nome_empresa'] . '</td>' .
            '<td class="' . $classProplaboreAnterior . '">' . $empresa['prolaboreAnterior'] . '</td>' .
            '<td class="' . $classProplaboreAtual . '">' . $empresa['prolabore'] . '</td>' .
            '</tr>';
    }
    $html = file_get_contents('lista-guia-pendentes.html');
    $html = str_replace('{{competenciaAnteriorView}}', $competenciaAnteriorView, $html);
    $html = str_replace('{{dataCompetenciaView}}', $dataCompetenciaView, $html);

} else {
    foreach ($empresas as $empresa) {
        $linhasTabela .=
            '<tr>' .
            '<td>' . $empresa['id'] . '</td>' .
            '<td>' . $empresa['nome_empresa'] . '</td>' .
            '<td>' . Helpers::formataDataView($empresa['data_vencimento']) . '</td>' .
            '<td>' . Helpers::formataDataCompetenciaView($empresa['data_competencia']) . '</td>' .
            '<td>' . Helpers::formataDataView($empresa['data_upload']) . '</td>' .
            '<td>' . $empresa['nome_guia'] . '</td>' .
            '</tr>';
    }
    $html = file_get_contents('lista-guia.html');
}


$html = str_replace('{{linhasTabela}}', $linhasTabela, $html);

echo $html;