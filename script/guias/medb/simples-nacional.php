<?php
use App\DAO\GuiaDAO;
use App\DAO\EmpresaGuiaEmailDAO;

require_once '../../../vendor/autoload.php';

$quantidadeGuiasSimplesNacional = 5;

if (array_key_exists('envio_forcado', $_POST) && $_POST['envio_forcado'] == "true") {
    session_start();
    $pasta = $_SESSION['pasta'];
}

$guiaDao = new GuiaDAO();

$empresasGuias = $guiaDao->getTodasGuiasMesCompetenciaSemMovimentacao('SN', 'MEDB', $quantidadeGuiasSimplesNacional);

if (!empty($empresasGuias)) {
    $dataCompetencia = $empresasGuias[0]['data_competencia'];
    $empresaGuiaDao = new EmpresaGuiaEmailDAO();
    
    //SAlVA O PRIMEIRO REGISTRO NA TABELA DAS EMPRESAS SEM MOVIMENTO
    foreach ($empresasGuias as $empresa) {
        $empresaGuiaDao->insereEmailGuiaSemMovimentacao($empresa['id'], $dataCompetencia);
    }
}

$empresasGuias = $guiaDao->getTodasGuiasMesCompetencia('SN', 'MEDB', $quantidadeGuiasSimplesNacional);

if (!empty($empresasGuias)) {
    $dataCompetencia = $empresasGuias[0]['data_competencia'];
    $empresaGuiaDao = new EmpresaGuiaEmailDAO();
    
    //SAlVA O PRIMEIRO REGISTRO NA TABELA DAS EMPRESAS APTAS PARA QUE SEJA ENVIADO O EMAIL
    foreach ($empresasGuias as $empresa) {
        $empresaGuiaDao->insereEmailGuia($empresa['id'], $dataCompetencia);
    }
}

// if (array_key_exists('envio_forcado', $_POST) && $_POST['envio_forcado'] == "true") {
//     $location = "Location: email-guia-pre.php?pasta=".$pasta."&envio_forcado=1&data_competencia=" . $_POST['data_competencia'];

//     header($location);
//     die();
// }