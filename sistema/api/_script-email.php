<?php

use App\DAO\EmpresaDAO;
use App\DAO\GuiaDAO;
use App\DAO\EmpresaGuiaEmailDAO;
use App\System\VerificaGuiasSn;
use App\System\EnviaGuiasMes;
use App\Email\TemplateEmailSn;

require_once '../../vendor/autoload.php';

$guiaDao = new GuiaDAO();
$empresasGuias = $guiaDao->getTodasGuiasMesCompetencia('SN');
$dataCompetencia = $empresasGuias[0]['data_competencia'];

$obj = new VerificaGuiasSn($empresasGuias);
$empresasAptas = $obj->getEmpresasAptasParaEmail();

//SAlVA O PRIMEIRO REGISTRO NA TABELA DAS EMPRESAS APTAS PARA QUE SEJA ENVIADO O EMAIL
$empresaGuiaDao = new EmpresaGuiaEmailDAO();
foreach($empresasAptas as $empresa) {
    $retorno = $empresaGuiaDao->insereEmailGuia($empresa, $dataCompetencia);
}

$empresasPendentes = $empresaGuiaDao->getEmpresasPendetesDeEmail($dataCompetencia);// Aqui que possivelmente tem que ser colocado o limite

foreach($empresasPendentes as $empresa) {
    $guiaMes = new EnviaGuiasMes($guiaDao, $empresa);
    $guias = $guiaDao->getNomeGuiasAnexo($empresa['data_competencia'], $empresa['empresas_id']);
    $templateEmail = new TemplateEmailSn($empresa['nome_completo'], $guias);
    $resultado = $guiaMes->enviaEmail($templateEmail->getCorpoEmail());
    if($resultado) {
        $empresaGuiaDao->updateEmailGuia($empresa['data_competencia'], $empresa['empresas_id']);
    }
}

if(array_key_exists('envio_forcado', $_POST) && $_POST['envio_forcado'] == "true") {
    $location = "Location: email-guia-pre.php?pasta=".$_POST['pasta']."&envio_forcado=1";
    //$location = "Location: ../" . $_POST['pasta'] . '/email-sistema.php';
    header($location);
    die();
}
