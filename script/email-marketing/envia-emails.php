<?php
use App\DAO\EmailMarketingCampanhaDAO;
use App\Model\Email\Campanha\EnviaCampanha;

include __DIR__ . '/../../vendor/autoload.php';

$dao = new EmailMarketingCampanhaDAO();
$contatos = $dao->getEmailsPendentes('IRPF_2018');

$enviaCampanha = new EnviaCampanha($contatos);
$enviaCampanha->enviaEmailIrpf2018();