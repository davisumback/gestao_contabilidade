<?php
use App\DAO\GuiaDAO;
use App\DAO\EmpresaGuiaEmailDAO;

require_once '../../../vendor/autoload.php';

$quantidadeGuiasPresumido = 9;

$guiaDao = new GuiaDAO();

$empresasGuias = $guiaDao->getTodasGuiasMesCompetenciaSemMovimentacao('Presumido', 'MEDCONTABIL', $quantidadeGuiasPresumido);

if (!empty($empresasGuias)) {
    $dataCompetencia = $empresasGuias[0]['data_competencia'];
    $empresaGuiaDao = new EmpresaGuiaEmailDAO();

    //SAlVA O PRIMEIRO REGISTRO NA TABELA DAS EMPRESAS APTAS PARA QUE SEJA ENVIADO O EMAIL
    foreach ($empresasGuias as $empresa) {
        $empresaGuiaDao->insereEmailGuiaSemMovimentacao($empresa['id'], $dataCompetencia);
    }
}

$empresasGuias = $guiaDao->getTodasGuiasMesCompetencia('Presumido', 'MEDCONTABIL', $quantidadeGuiasPresumido);

if (!empty($empresasGuias)) {
    $dataCompetencia = $empresasGuias[0]['data_competencia'];
    $empresaGuiaDao = new EmpresaGuiaEmailDAO();

    //SAlVA O PRIMEIRO REGISTRO NA TABELA DAS EMPRESAS APTAS PARA QUE SEJA ENVIADO O EMAIL
    foreach ($empresasGuias as $empresa) {
        $empresaGuiaDao->insereEmailGuia($empresa['id'], $dataCompetencia);
    }
}

// if(array_key_exists('envio_forcado', $_GET) && $_GET['envio_forcado'] == 1) {
//     $location = "Location: ../../sistema/" . $_GET['pasta'] . '/email-sistema.php?data_competencia=' . $_GET['data_competencia'];
//     // $location = "Location: ../" . $_GET['pasta'] . '/email-sistema.php';
//     header($location);
//     die();
// }