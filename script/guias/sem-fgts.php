<?php

require_once '../../vendor/autoload.php';

$date = new DateTime();
$date->sub(new DateInterval('P1M'));
$competencia = $date->format('Y-m') . '-01';

$guiaDao = new \App\DAO\GuiaDAO();
$empresas = $guiaDao->getEmpresasSemFuncionario($competencia);

foreach ($empresas as $empresa) {
   $guiaDao->sistemaInsereSemGuia($empresa['empresas_id'], 'FGTS', $competencia);
}