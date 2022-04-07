<?php
use App\DAO\ClienteDAO;
use App\DAO\EmailMarketingCampanhaDAO;

include __DIR__ . '/../../vendor/autoload.php';

$emailMarketingDAO = new EmailMarketingCampanhaDAO();
$clientes = $emailMarketingDAO->getEmailsAEnviarIrpf();

foreach ($clientes  as $cliente) {
    $retorno = $emailMarketingDAO->insereEmails($cliente['id'], $cliente['email'], $cliente['nome_completo'], 'IRPF_2018');
}