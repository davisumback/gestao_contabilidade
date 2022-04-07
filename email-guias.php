<?php
use App\DAO\GuiaDAO;

include __DIR__ . '/vendor/autoload.php';

$dao = new GuiaDAO();

$guias = ["INSS", 'FGTS', 'IRRF', 'DAS', 'PIS', 'COFINS', 'IRPJ', 'CSLL', 'ISS', 'HONORARIOS'];

foreach ($guias as $tipoGuia) {
    $retorno = $dao->isGuiasDuplicadas($tipoGuia, '2019-01-01');
    if (!empty($retorno)) {
        echo $tipoGuia . '<br>';
        echo '<pre>';
        print_r($retorno);
        echo '</pre>';
    }
}
