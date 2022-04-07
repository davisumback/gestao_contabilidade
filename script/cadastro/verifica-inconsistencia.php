<?php
use App\DAO\HelperDAO;
use App\DAO\InconsistenciaDAO;

include __DIR__ . '/../../vendor/autoload.php';

$helperDao = new HelperDAO();
$empresasSemEmail = $helperDao->verificaEmpresaSemEmail();

$inconsistenciaDao = new InconsistenciaDAO();

foreach ($empresasSemEmail as $empresa) {
    $inconsistenciaDao->insereInconsistenciaEmpresa($empresa['id'], 1, 'PENDENTE');
}

// echo '<pre>';
// print_r($retorno);
// echo '</pre>';
// die();

// verificar se tem email cadastrado
// verificar se tem sócio administrador
// salvar na tabela a inconsistência
