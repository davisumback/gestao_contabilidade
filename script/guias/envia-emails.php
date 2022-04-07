<?php
use App\DAO\GuiaDAO;
use App\DAO\EmpresaGuiaEmailDAO;
use App\DAO\EmpresaEmailDAO;
use App\System\EnviaGuiasMesNovo;
use App\System\EnviaGuiasMedcontabil;
use App\Email\TemplateEmailGuias;
use App\Email\TemplateEmailGuiasMedcontabil;

require_once '../../vendor/autoload.php';

$guiaDao = new GuiaDAO();
$empresaGuiaDao = new EmpresaGuiaEmailDAO();

$date = new \DateTime('', new \DateTimeZone('America/Sao_Paulo'));
$now = $date->format('d/m/Y');

$dataCompetencia = \App\Helper\Helpers::formataDataPeriod('sub', $now, 'P1M', 'Y-m');
$dataCompetencia .= '-01';

$empresasPendentes = $empresaGuiaDao->getEmpresasPendetesDeEmail($dataCompetencia); // Aqui que possivelmente tem que ser colocado o limite

foreach ($empresasPendentes as $empresaArray) {
    $empresaEmailDao = new EmpresaEmailDAO();
    $empresaEmail = $empresaEmailDao->getEmpresaEmail($empresaArray['empresas_id']);

    if (! empty($empresaEmail)) {
        $vinculo = $empresaEmail[0]['vinculo'];

        $emails = array();

        foreach ($empresaEmail as $empresa) {
            $emails[] = $empresa['email'];
        }

        if ($vinculo == 'MEDB') {
            $guiaMes = new EnviaGuiasMesNovo($guiaDao, $empresaEmail[0], $dataCompetencia);
            $guias = $guiaDao->getNomeGuiasAnexo($dataCompetencia, $empresaEmail[0]['empresas_id']);
            $templateEmail = new TemplateEmailGuias($empresaEmail[0]['nome_completo'], $guias);
            $resultado = $guiaMes->enviaEmail($templateEmail->getCorpoEmail(), $emails);

        } else {
            $guiaMes = new EnviaGuiasMedcontabil($guiaDao, $empresaEmail[0], $dataCompetencia);
            $guias = $guiaDao->getNomeGuiasAnexo($dataCompetencia, $empresaEmail[0]['empresas_id']);
            $templateEmail = new TemplateEmailGuiasMedcontabil($empresaEmail[0]['nome_completo'], $guias);        
            $resultado = $guiaMes->enviaEmail($templateEmail->getCorpoEmail(), $emails);
        }

        if ($resultado) {
            $empresaGuiaDao->updateEmailGuia($dataCompetencia, $empresaEmail[0]['empresas_id']);
        }
    }
}